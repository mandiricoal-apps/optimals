<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\DailyInspection;
use App\Models\Issue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    function index(Request $request)
    {
        $from = ($request->from ?? date('Y-m-01')) . " 00:00:01";
        $to = ($request->to ?? date("Y-m-d", strtotime('last day of this month'))) . " 23:59:59";

        if ($request->from) {
            $data['title_date'] =  date("d F Y", strtotime($from)) . " - " . date("d F Y", strtotime($to));
        }


        $daily_inspection_percomp_count = DB::table('daily_inspections')
            ->join('users', 'users.id', '=', 'daily_inspections.create_by')
            ->selectRaw('users.company as company, COUNT(daily_inspections.id) as total')
            ->where('daily_inspections.created_at', '>=', $from)
            ->where('daily_inspections.created_at', '<=', $to);

        if ($request->company && $request->company != "all") {
            $daily_inspection_percomp_count = $daily_inspection_percomp_count->where('users.company', '=', $request->company);
        }


        $daily_inspection_percomp_count = $daily_inspection_percomp_count->groupBy('users.company')->get();


        $data['MKP'] = 0;
        $data['MIP'] = 0;
        $data['RML'] = 0;
        $total_all = 0;
        foreach ($daily_inspection_percomp_count as  $value) {
            $data[$value->company] = $value->total;
            $total_all += $value->total;
        }


        $daily_inspection_perarea = DB::table('area')
            ->selectRaw('area.* ,AVG(daily_inspections.total_score) as total_score')
            ->leftJoin('daily_inspections', 'daily_inspections.area_id', '=', 'area.id')
            ->leftJoin('users', 'users.id', '=', 'daily_inspections.create_by')
            ->where('daily_inspections.created_at', '>=', $from)
            ->where('daily_inspections.created_at', '<=', $to)
            ->whereNull('area.deleted_at');
        if ($request->company && $request->company != "all") {
            $daily_inspection_perarea = $daily_inspection_perarea->where('users.company', '=', $request->company);
        }
        $daily_inspection_perarea = $daily_inspection_perarea->groupBy('area.id')->get();

        $issue = DB::table('issue')->selectRaw('COUNT(issue.id) as total, status')
            ->join('daily_inspection_summary', 'daily_inspection_summary.id', '=', 'issue.sumary_id')
            ->join('daily_inspections', 'daily_inspections.id', '=', 'daily_inspection_summary.inspection_id')
            ->join('users', 'users.id', '=', 'daily_inspections.create_by')
            ->where('issue.created_at', '>=', $from)
            ->where('issue.created_at', '<=', $to);

        if ($request->company && $request->company != "all") {
            $issue = $issue->where('users.company', '=', $request->company);
        }
        $issue = $issue->groupBy('status')->get();


        $lastIssue = DB::table('issue')->selectRaw('issue.*')
            ->join('daily_inspection_summary', 'daily_inspection_summary.id', '=', 'issue.sumary_id')
            ->join('daily_inspections', 'daily_inspections.id', '=', 'daily_inspection_summary.inspection_id')
            ->join('users', 'users.id', '=', 'daily_inspections.create_by')
            ->where('issue.created_at', '>=', $from)
            ->where('issue.created_at', '<=', $to);

        if ($request->company && $request->company != "all") {
            $lastIssue = $lastIssue->where('users.company', '=', $request->company);
        }
        $lastIssue = $lastIssue->take(5)->orderByDesc('updated_at')->get();

        $counCompany = DB::table('daily_inspections')
            ->selectRaw('COUNT(daily_inspections.id) as count,users.company as company')
            ->leftJoin('users', 'users.id', '=', 'daily_inspections.create_by')
            ->whereDate('daily_inspections.created_at', '=', date('Y-m-d'))
            ->groupBy('users.company')->get();





        $data['per_area'] = $daily_inspection_perarea;
        $data['area'] = Area::get();
        $data['total_all'] = $total_all;
        $data['issue'] = $issue;
        $data['lastIssue'] = $lastIssue;
        $data['countCompany'] = $counCompany;

        return view('dashboard/dashboard', $data);
    }
}
