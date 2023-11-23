<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\DailyInspection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DailyInspectionController extends Controller
{
    function index()
    {
        $data['title'] = 'Daily Inspection';
        $data['breadcrumb'] = 'daily_inspection';
        $data['areas'] = Area::get();
        return view('dashboard.daily_inspection', $data);
    }

    function perArea(Request $request, Area $area)
    {
        $status = "not-approved";
        if ($request->status) {
            $status = $request->status;
        }
        $data['status'] = $status;
        $data['title'] = ($status == "not-approved" ? 'Open' : 'Close') . ' Daily Inspection in ' . $area->area_name . ' (' . $area->area_code . ')';
        $data['breadcrumb'] = 'daily_inspection_perarea';
        $data['area_name'] = $area->area_name;
        $data['area_id'] = $area->id;
        $dailyInspection = DB::table('daily_inspections')->selectRaw('daily_inspections.*, users.name, users.nik, users.id as user_id, COUNT(DISTINCT issue.id) issue')
            ->join('users', 'daily_inspections.create_by', '=', 'users.id')
            ->join('daily_inspection_summary', 'daily_inspection_summary.inspection_id', '=', 'daily_inspections.id')
            ->leftJoin('issue', 'issue.sumary_id', '=', 'daily_inspection_summary.id')
            ->orderByDesc('created_at')
            ->where('area_id', '=', $area->id);


        if ($status == "approved") {
            $dailyInspection = $dailyInspection->where("approved_at", "IS NOT", NULL);
        } else {
            $dailyInspection = $dailyInspection->where("approved_at", "=", NULL);
        }
        $dailyInspection = $dailyInspection->groupBy('daily_inspections.id');
        $dailyInspection = $dailyInspection->get();


        $data['daily_inspections'] = $dailyInspection;

        return view('dashboard.daily_inspection_perarea', $data);
    }

    function detailDailyInspection(Request $request, DailyInspection $dailyInspection)
    {
        $data['title'] = 'Daily Inspection ' . $dailyInspection->code;
        $data['breadcrumb'] = 'detail_daily_inspection';
        $dailyInspection->load('summary', 'location', 'summary.question', 'summary.answer', 'summary.issue');
        $location = $dailyInspection->location;
        $dataLocation = [];
        switch ($dailyInspection->area_id) {
            case 3:
                $dataLocation = [
                    'DISPOSAL' => $location->disposal,
                    'BLOK' => $location->blok_start . '-' . $location->blok_end,
                    'STRIP' => $location->strip_start . '-' . $location->strip_end,
                    'RL' => $location->rl,
                ];
                break;
            case 4:
                $dataLocation = [
                    'SUMP' => $location->sump,
                ];
                break;
            case 5:
                $dataLocation = [
                    'NAMA JALAN' => $location->nama_jalan,
                    'SEGMEN' => $location->segmen,
                ];
                break;

            default:
                $dataLocation = [
                    'PIT' => $location->pit,
                    'BLOK' => $location->blok_start . '-' . $location->blok_end,
                    'STRIP' => $location->strip_start . '-' . $location->strip_end,
                    'SEAM' => $location->seam,
                    'RL' => $location->rl,
                    'NO. UNIT' => $location->no_unit,
                ];
                break;
        }

        $data['dailyInspection'] = $dailyInspection;
        $data['dataLocation'] = $dataLocation;

        return view('dashboard.detail_daily_inspection', $data);
    }

    function editScore(Request $request, DailyInspection $dailyInspection)
    {

        $credentials = $request->validate([
            'score' => 'required|numeric',
            'reason_score' => 'required',
        ]);
        $dailyInspection->total_score = $request->score;
        $dailyInspection->reason_score = $request->reason_score;
        $dailyInspection->score_update_by = Auth::user()->id;

        if ($dailyInspection->save()) {
            return redirect("/daily-inspection-detail/$dailyInspection->id")->with('message', 'Berhasil mengubah score');
        }
        return back();
    }

    function approve(DailyInspection $dailyInspection)
    {
        $dailyInspection->approved_at = date(now());
        $dailyInspection->approved_by = Auth::user()->id;

        if ($dailyInspection->save()) {
            return redirect("/daily-inspection-detail/$dailyInspection->id")->with('message', 'Daily Inspection berhasil di-approve');
        }
        return back();
    }
}
