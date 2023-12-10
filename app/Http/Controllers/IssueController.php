<?php

namespace App\Http\Controllers;

use App\Mail\updateStatusIssue;
use App\Models\Issue;
use App\Models\ProgressIssue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class IssueController extends Controller
{
    function index(Request $request)
    {
        $accesbilityData = Auth::user()->roles[0]->accesbility_data;
        $data['breadcrumb'] = "issue";
        $status = 'open';
        if ($request->status) {
            $status = $request->status;
        }
        $data['status'] = $status;
        $data['title'] = issue()[$status] . " Issue";

        $issues = DB::table('issue')
            ->join('daily_inspection_summary', 'daily_inspection_summary.id', '=', 'issue.sumary_id')
            ->join('daily_inspections', 'daily_inspections.id', '=', 'daily_inspection_summary.inspection_id')
            ->join('users', 'users.id', '=', 'daily_inspections.create_by')
            ->join('area', 'area.id', '=', 'daily_inspections.area_id')
            ->join('data_location', 'data_location.inspection_id', '=', 'daily_inspections.id')
            ->where('issue.status', '=', $status);

        if ($request->start) {
            $issues = $issues->where('issue.created_at', '>=', $request->start . ' 00:00:00');
        }
        if ($request->end) {
            $issues = $issues->where('issue.created_at', '<=', $request->end . ' 23:59:59');
        }
        $issues =  $issues->orderBy('issue.created_at', 'desc');
        if ($accesbilityData == 'user_company') {
            $issues->where('data_location.pit', '=', Auth::user()->company);
        }
        $issues = $issues->get(['issue.created_at', 'issue.status', 'issue.issue as issue', 'issue.code as issue_code', 'issue.id as issue_id', 'daily_inspections.id as inspections_id', 'daily_inspections.code as inspection_code', 'area.area_name', 'users.name', 'users.id as user_id', 'users.nik', 'data_location.pit as company']);
        $data['issues'] = $issues;

        return view('dashboard.issue', $data);
    }

    function detail(Issue $issue)
    {
        $data['breadcrumb'] = "detail_issue";
        $data['title'] = "Issue " . $issue->code;
        $data['issue'] = $issue;
        $issue->load(['summary.inspection.user' => function ($query) {
            $query->withTrashed();
        }]);

        if ($issue->status == 'progress') {
            $color = 'primary';
        } else if ($issue->status == 'close') {
            $color = 'success';
        } else if ($issue->status == 'reject') {
            $color = 'danger';
        } else {
            $color = 'warning';
        }
        $data['color'] = $color;

        return view('dashboard.detail_issue', $data);
    }

    function changeStatus(Request $request, Issue $issue)
    {
        $credentials = $request->validate([
            'status' => 'required',
            'closed_file' => 'max:10240|mimes:png,jpg,doc,docs,pdf,xlsx,docx',
        ]);

        DB::beginTransaction();
        try {
            $issue->status = $request->status;
            $issue->updated_by = Auth::user()->id;
            if (ProgressIssue::where('issue_id', '=', $issue->id)->count() > 0) {
                $progressIssue = $issue->progressIssue;
            } else {
                $progressIssueNew = ProgressIssue::create(['issue_id' => $issue->id]);
                $progressIssue = ProgressIssue::find($progressIssueNew->id);
            }

            if ($request->status == 'progress') {
                $progressIssue->progress_at = date(now());
                $progressIssue->progress_by = Auth::user()->id;
                $progressIssue->progress_reason = $request->reason;
            } else if ($request->status == 'close') {
                $progressIssue->closed_at = date(now());
                $progressIssue->closed_by = Auth::user()->id;
                $progressIssue->closed_reason = $request->reason;
                if ($request->file('closed_file')) {
                    $image = $request->file('closed_file');
                    $filename = 'ATTCH' . date('ymdhis') . $image->getClientOriginalName();
                    $folder = "attach_file";

                    $image->storeAs($folder, $filename, ['disk' => 'public']);
                    $progressIssue->closed_file = $filename;
                }
            } else if ($request->status == 'reject') {
                $progressIssue->rejected_at = date(now());
                $progressIssue->rejected_by = Auth::user()->id;
                $progressIssue->rejected_reason = $request->reason;
            }

            $issue->save();
            $progressIssue->save();

            DB::commit();
            $email = $issue->summary->inspection->user->email;
            Mail::to($email)->send(new updateStatusIssue($issue));
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withErrors([
                'issue' => $th->getMessage(),
            ]);
        }

        return back()->with("meesage", "Issue status changed successfully");
    }
}
