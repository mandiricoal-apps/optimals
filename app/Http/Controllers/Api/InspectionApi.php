<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\DailyInspection;
use App\Models\DailyInspectionSummary;
use App\Models\DataLocation;
use App\Models\Issue;
use App\Models\LogScore;
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

        $validator = Validator::make($data, $this->setValidator($data['area_id']));

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }
        $daily_inspection['create_by'] = Auth::user()->id;
        if (isset($daily_inspection['created_at'])) {
            $daily_inspection['updated_at'] = $daily_inspection['created_at'];
        }

        DB::beginTransaction();
        try {
            //create daily inspection
            $save_daily_inspection = DailyInspection::create($daily_inspection);
            $inspection_id = $save_daily_inspection->id;

            //create log score
            LogScore::create([
                'inspection_id' => $inspection_id,
                'score' => $daily_inspection['total_score'],
                'description' => 'First Score',
                'created_by' => $daily_inspection['create_by'],
                'created_at' => $save_daily_inspection->created_at,
                'updated_at' => $save_daily_inspection->created_at,
            ]);


            //crate data location
            $data_location['inspection_id'] = $inspection_id;
            DataLocation::create($data_location);

            //create summary daily inspection
            if (isset($daily_inspection['created_at'])) {

                $date = $daily_inspection['created_at'];
            } else {
                $date = date(now());
            }
            $summary_daily_inspection = array_map(function ($item) use ($inspection_id, $date) {
                $item['inspection_id'] = $inspection_id;
                $item['created_at'] = $date;
                $item['updated_at'] = $date;
                $saveSummary = DailyInspectionSummary::create($item);
                if (array_key_exists('issue', $item['issue'])) {
                    $tempIssue = $item['issue'];
                    $tempIssue['sumary_id'] = $saveSummary->id;
                    $tempIssue['created_at'] = $date;
                    $tempIssue['updated_at'] = $date;
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
                    'location.blok_start' => 'nullable|min:1|max:1000|numeric',
                    'location.blok_end' => 'nullable|min:1|max:1000|numeric',
                    'location.strip_start' => 'nullable|min:1|max:1000|numeric',
                    'location.strip_end' => 'nullable|min:1|max:1000|numeric',
                    'location.rl' => 'required|min:-300|max:150|numeric',

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
                    // 'location.segmen' => 'required',
                ]);
                break;
            default:
                $validator = array_merge($validator, [
                    'location.pit' => 'required',
                    'location.blok_start' => 'nullable|min:1|max:1000|numeric',
                    'location.blok_end' => 'nullable|min:1|max:1000|numeric',
                    'location.strip_start' => 'nullable|min:1|max:1000|numeric',
                    'location.strip_end' => 'nullable|min:1|max:1000|numeric',
                    'location.seam' => 'required',
                    'location.rl' => 'required|min:-300|max:150|numeric',
                    // 'location.no_unit' => 'required',
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

    function uploadMultipleImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image_file.*' => 'required|image|mimes:jpg,jpeg,png|max:10240',
            'type' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }

        if ($request->file('image_file')) {
            foreach ($request->file('image_file') as $key => $value) {
                // $image = $request->file('image_file');
                $filename = $value->getClientOriginalName();
                if ($request->type == "location") {
                    $folder = "location_photo";
                } else if ($request->type == "issue") {
                    $folder = "issue_photo";
                } else {
                    $folder = "photo";
                }
                $value->storeAs($folder, $filename, ['disk' => 'public']);
            }

            return response()->json(['message' => 'Semua file berhasil di-upload'], 200);
        } else {
            return response()->json(['message' => 'File gagal di-upload'], 400);
        }
    }

    function getDailyInspectionByUser(Request $request, $user_id)
    {
        $offset = 0;
        $limit = 10;
        if ($request->offset) {
            $offset = $request->offset;
        }
        if ($request->limit) {
            $limit = $request->limit;
        }
        $dailyInspections = DailyInspection::with(['summary', 'location', 'summary.question', 'summary.answer', 'summary.issue', 'summary.issue.progressIssue', 'summary.issue.progressIssue.userProgress', 'summary.issue.progressIssue.userClosed', 'summary.issue.progressIssue.userRejected'])
            ->where('create_by', '=', $user_id);
        if ($request->start) {
            $dailyInspections = $dailyInspections->where('daily_inspections.created_at', '>=', $request->start . ' 00:00:00');
        }
        if ($request->end) {
            $dailyInspections = $dailyInspections->where('daily_inspections.created_at', '<=', $request->end . ' 23:59:59');
        }
        if ($request->area) {
            $dailyInspections = $dailyInspections->where('daily_inspections.area_id', '=', $request->area);
        }
        $dailyInspections = $dailyInspections->skip($offset)->take($limit)->orderByDesc('created_at');
        $dailyInspections = $dailyInspections->get();

        return response()->json(['message' => 'Daily Inspections', 'data' => $dailyInspections], 200);
    }
    function getOneDailyInspection($id)
    {
        $dailyInspections = DailyInspection::with(['summary', 'location', 'summary.question', 'summary.answer', 'summary.issue', 'summary.issue.progressIssue', 'summary.issue.progressIssue.userProgress', 'summary.issue.progressIssue.userClosed', 'summary.issue.progressIssue.userRejected'])
            ->find($id);
        return response()->json(['message' => 'Daily Inspections', 'data' => $dailyInspections], 200);
    }

    function countInspection(Request $request, $idUser)
    {
        $type = $request->type;
        $inspection = DailyInspection::where('create_by', $idUser);
        $issue = DB::table("issue")
            ->join('daily_inspection_summary', 'daily_inspection_summary.id', '=', 'issue.sumary_id')
            ->join('daily_inspections', 'daily_inspection_summary.inspection_id', '=', 'daily_inspections.id')->where('daily_inspections.create_by', $idUser);
        if ($type == "day") {
            $inspection = $inspection->whereDate('created_at', date('Y-m-d'));
            $issue = $issue->whereDate('issue.created_at', date('Y-m-d'));
        } else if ($type == "month") {
            $inspection = $inspection->whereMonth('created_at', date('m'))
                ->whereYear('created_at', date('Y'));
            $issue = $issue->whereMonth('issue.created_at', date('m'))
                ->whereYear('issue.created_at', date('Y'));
        }
        return response()->json([
            'message' => 'Daily Inspection Total',
            'data' => [
                'daily_inspection' => $inspection->count(),
                'issue' => $issue->count(),
            ]
        ]);
    }
}
