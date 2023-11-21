<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\DailyInspection;
use Illuminate\Http\Request;
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
        $dailyInspection = DB::table('daily_inspections')
            ->join('users', 'daily_inspections.create_by', '=', 'users.id')

            ->where('area_id', '=', $area->id);


        if ($status == "approved") {
            $dailyInspection = $dailyInspection->where("approved_at", "IS NOT", NULL);
        } else {
            $dailyInspection = $dailyInspection->where("approved_at", "=", NULL);
        }
        $dailyInspection = $dailyInspection->get(['daily_inspections.*', 'users.name', 'users.nik', 'users.id as user_id']);


        $data['daily_inspections'] = $dailyInspection;

        return view('dashboard.daily_inspection_perarea', $data);
    }

    function detailDailyInspection(Request $request, DailyInspection $dailyInspection)
    {
        $data['title'] = 'Daily Inspection ' . $dailyInspection->code;
        $data['breadcrumb'] = 'detail_daily_inspection';
        $dailyInspection->load('summary', 'location', 'summary.question', 'summary.answer', 'summary.issue');

        $data['dailyInspection'] = $dailyInspection;

        return view('dashboard.detail_daily_inspection', $data);
    }
}
