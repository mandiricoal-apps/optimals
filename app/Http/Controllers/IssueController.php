<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IssueController extends Controller
{
    function index(Request $request)
    {
        $data['breadcrumb'] = "issue";
        $status = 'open';
        if ($request->status) {
            $status = $request->status;
        }
        $data['status'] = $status;
        $data['title'] = ucfirst($status) . " Issue";

        $issues = DB::table('issue')
            ->join('daily_inspection_summary', 'daily_inspection_summary.id', '=', 'issue.sumary_id')
            ->join('daily_inspections', 'daily_inspections.id', '=', 'daily_inspection_summary.inspection_id')
            ->join('users', 'users.id', '=', 'daily_inspections.create_by')
            ->join('area', 'area.id', '=', 'daily_inspections.area_id')
            ->where('issue.status', '=', $status)
            ->orderBy('issue.created_at', 'desc')
            ->get(['issue.created_at', 'issue.status', 'issue.code as issue_code', 'issue.id as issue_id', 'daily_inspections.id as inspections_id', 'daily_inspections.code as inspection_code', 'area.area_name', 'users.name', 'users.id as user_id', 'users.nik']);
        $data['issues'] = $issues;

        return view('dashboard.issue', $data);
    }
}
