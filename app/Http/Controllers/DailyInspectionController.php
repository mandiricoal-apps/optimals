<?php

namespace App\Http\Controllers;

use App\Mail\updateScore;
use App\Models\Area;
use App\Models\DailyInspection;
use App\Models\LogScore;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class DailyInspectionController extends Controller
{
    function index()
    {

        $data['title'] = 'Daily Inspection';
        $data['breadcrumb'] = 'daily_inspection';

        $areas = Area::withCount([
            'dailyInspection' => function (Builder $query) {
                $accesbilityData = Auth::user()->roles[0]->accesbility_data;
                if ($accesbilityData == 'user_company') {
                    $query->whereHas('location', function ($q) {
                        return $q->where('data_location.pit', '=', Auth::user()->company);
                    });
                }
                $query->where(function ($querys) {
                    $querys->where('approved_at', '=', NULL)
                        ->whereRaw('NOW() < DATE_ADD(
                        LAST_DAY(daily_inspections.created_at) + INTERVAL 3 DAY,
                        INTERVAL 0 DAY
                )');
                });
            },
        ]);
        $areas = $areas->get();
        $areas->load('question');


        $data['areas'] = $areas;
        return view('dashboard.daily_inspection', $data);
    }

    function perArea(Request $request, Area $area)
    {
        $accesbilityData = Auth::user()->roles[0]->accesbility_data;
        $status = "not-approved";
        if ($request->status) {
            $status = $request->status;
        }

        if ($request->start) {
            $title_date =  date("d F Y", strtotime($request->start)) . " - " . date("d F Y", strtotime($request->end));
        } else {
            $title_date = date('F Y');
        }


        $data['status'] = $status;
        $data['title'] = ($status == "not-approved" ? 'Open' : 'Close') . ' Daily Inspection in ' . $area->area_name . ' (' . $area->area_code . ')' . '<br><small>' . $title_date . '</small></br>';
        $data['breadcrumb'] = 'daily_inspection_perarea';
        $data['area_name'] = $area->area_name;
        $data['area_id'] = $area->id;
        $dailyInspection = DB::table('daily_inspections')->selectRaw('daily_inspections.*, users.name, users.nik, users.id as user_id, COUNT(DISTINCT issue.id) issue, data_location.pit as comp')
            ->join('users', 'daily_inspections.create_by', '=', 'users.id')
            ->join('daily_inspection_summary', 'daily_inspection_summary.inspection_id', '=', 'daily_inspections.id')
            ->leftJoin('issue', 'issue.sumary_id', '=', 'daily_inspection_summary.id')
            ->join('data_location', 'data_location.inspection_id', '=', 'daily_inspections.id')
            ->orderByDesc('created_at')

            ->where('daily_inspections.area_id', '=', $area->id);
        if ($accesbilityData == 'user_company') {
            $dailyInspection = $dailyInspection->where('data_location.pit', '=', Auth::user()->company);
        }

        if ($request->start) {
            $dailyInspection = $dailyInspection->where('daily_inspections.created_at', '>=', $request->start . ' 00:00:00');
        } else {
            $dailyInspection = $dailyInspection->where('daily_inspections.created_at', '>=', date('Y-m-d', strtotime('first day of this month', time())) . ' 00:00:00');
        }

        if ($request->end) {
            $dailyInspection = $dailyInspection->where('daily_inspections.created_at', '<=', $request->end . ' 23:59:59');
        } else {
            $dailyInspection = $dailyInspection->where('daily_inspections.created_at', '<=', date('Y-m-d', strtotime('last day of this month', time())) . ' 23:59:59');
        }

        if ($status == "approved") {
            $dailyInspection = $dailyInspection->where(function ($query) {
                $query->where("approved_at", "IS NOT", NULL)->orWhereRaw('NOW() > DATE_ADD(
                    LAST_DAY(daily_inspections.created_at) + INTERVAL 3 DAY,
                    INTERVAL 0 DAY
            )');
            });
        } else {
            $dailyInspection = $dailyInspection->where("approved_at", "=", NULL)->whereRaw('NOW() < DATE_ADD(
                LAST_DAY(daily_inspections.created_at) + INTERVAL 3 DAY,
                INTERVAL 0 DAY
        )');
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
        $dailyInspection->load([
            'summary',
            'location',
            'summary.question' => function ($query) {
                $query->withTrashed();
            },
            'summary.answer' => function ($query) {
                $query->withTrashed();
            },
            'summary.issue',
            'user' => function ($query) {
                $query->withTrashed();
            }
        ]);
        $location = $dailyInspection->location;
        $dataLocation = [];
        switch ($dailyInspection->area_id) {
            case 4:
                $dataLocation = [
                    'PT' => $location->pit,
                    'DISPOSAL' => $location->disposal,
                    'BLOK' => $location->blok_start . ($location->blok_end ? ' s/d ' . $location->blok_end : ''),
                    'STRIP' => $location->strip_start . ($location->strip_end ? ' s/d ' . $location->strip_end : ''),
                    'RL' => $location->rl . ($location->rl_end ? ' s/d ' . $location->rl_end : ''),
                ];
                break;
            case 3:
                $dataLocation = [
                    'PT' => $location->pit,
                    'SUMP' => $location->sump,
                ];
                break;
            case 5:
                $dataLocation = [
                    'PT' => $location->pit,
                    'NAMA JALAN' => $location->nama_jalan,
                    'SEGMEN' => $location->segmen,
                ];
                break;

            default:
                $dataLocation = [
                    'PIT' => $location->pit,
                    'BLOK' => $location->blok_start . ($location->blok_end ? ' s/d ' . $location->blok_end : ''),
                    'STRIP' => $location->strip_start . ($location->strip_end ? ' s/d ' . $location->strip_end : ''),
                    'SEAM' => $location->seam,
                    'RL' => $location->rl . ($location->rl_end ? ' s/d ' . $location->rl_end : ''),
                    'NO. UNIT' => $location->no_unit,
                ];
                break;
        }

        $data['dailyInspection'] = $dailyInspection;
        $data['dataLocation'] = $dataLocation;
        $data['logScore'] = LogScore::with(['user'])->where('inspection_id', $dailyInspection->id)->get();

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

        //create log score
        LogScore::create([
            'inspection_id' => $dailyInspection->id,
            'score' => $dailyInspection->total_score,
            'description' => $request->reason_score,
            'created_by' => Auth::user()->id,

        ]);

        if ($dailyInspection->save()) {
            $email = $dailyInspection->user->email;
            if ($email != '' || $email != null) {
                Mail::to($email)->send(new updateScore($dailyInspection));
            }
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
