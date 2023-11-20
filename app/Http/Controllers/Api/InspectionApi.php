<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\DailyInspection;
use App\Models\DailyInspectionSummary;
use App\Models\DataLocation;
use App\Models\Issue;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use function PHPSTORM_META\map;

class InspectionApi extends Controller
{
    function sync()
    {
        $area = Area::with(['question', 'question.answer'])->get();

        return response()->json(['area' => $area]);
    }

    function create(Request $request)
    {

        $data = $request->all();
        $daily_inspection = $data;
        $summary_daily_inspection = $data['summary'];
        $data_location = $data['location'];
        // return response()->json($data['location']);
        $validator = Validator::make($data, $this->setValidator($data['area_id']));

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }
        $daily_inspection['create_by'] = Auth::user()->id;

        DB::beginTransaction();
        try {
            //create daily inspection
            $save_daily_inspection = DailyInspection::create($daily_inspection);
            $inspection_id = $save_daily_inspection->id;

            //crate data location
            $data_location['inspection_id'] = $inspection_id;
            DataLocation::create($data_location);

            //create summary daily inspection
            $date = date(now());
            $summary_daily_inspection = array_map(function ($item) use ($inspection_id, $date) {
                $item['inspection_id'] = $inspection_id;
                $item['created_at'] = $date;
                $item['updated_at'] = $date;
                $saveSummary = DailyInspectionSummary::create($item);
                if (array_key_exists('issue', $item)) {
                    $tempIssue = $item['issue'];
                    $tempIssue['sumary_id'] = $saveSummary->id;
                    Issue::create($tempIssue);
                }

                return $item;
            }, $summary_daily_inspection);
            DB::commit();
            return response()->json(['message' => $save_daily_inspection->id], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }


    function setValidator($area_id): array
    {
        $validator = [
            'area_id' => 'required',
            'summary' => 'required',
            'total_score' => 'required',
            'summary.*.question_id' => 'required',
            'summary.*.answer_id' => 'required',
            'summary.*.score' => 'required',
            'location' => 'required',
            'location.image' => 'required'
        ];
        switch ($area_id) {
            case 3:
                $validator = array_merge($validator, [
                    'location.disposal' => 'required',
                    'location.blok_start' => 'required|min:1|max:1000|numeric',
                    'location.blok_end' => 'required|min:1|max:1000|numeric',
                    'location.strip_start' => 'required|min:1|max:1000|numeric',
                    'location.strip_end' => 'required|min:1|max:1000|numeric',
                    'location.rl' => 'required|min:-20|max:20|numeric',

                ]);
                break;
            case 4:
                $validator = array_merge($validator, [
                    'location.sump' => 'required',
                ]);
                break;
            case 5:
                $validator = array_merge($validator, [
                    'location.nama_jalan' => 'required',
                    'location.segmen' => 'required',
                ]);
                break;
            default:
                $validator = array_merge($validator, [
                    'location.pit' => 'required',
                    'location.blok_start' => 'required|min:1|max:1000|numeric',
                    'location.blok_end' => 'required|min:1|max:1000|numeric',
                    'location.strip_start' => 'required|min:1|max:1000|numeric',
                    'location.strip_end' => 'required|min:1|max:1000|numeric',
                    'location.seam' => 'required',
                    'location.rl' => 'required|min:-20|max:20|numeric',
                    'location.no_unit' => 'required',
                ]);
                break;
        }

        return $validator;
    }

    function uploadImage(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'image_file' => 'required|image|mimes:jpg,jpeg,png|max:10240',
            'type' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }

        if ($request->file('image_file')) {
            $image = $request->file('image_file');
            $filename = $image->getClientOriginalName();
            if ($request->type == "location") {
                $folder = "location_photo";
            } else if ($request->type == "issue") {
                $folder = "issue_photo";
            } else {
                $folder = "photo";
            }
            $image->storeAs($folder, $filename, ['disk' => 'public']);

            return response()->json(['message' => 'File ' . $filename . ' berhasil di-upload'], 200);
        } else {
            return response()->json(['message' => 'File gagal di-upload'], 400);
        }
    }
}
