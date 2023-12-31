<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressIssue extends Model
{
    use HasFactory;
    protected $table = 'progress_issue';
    protected $guarded = ['id'];
    public $timestamps = false;

    function userProgress()
    {
        return $this->belongsTo(User::class, 'progress_by', 'id')->withTrashed();
    }
    function userClosed()
    {
        return $this->belongsTo(User::class, 'closed_by', 'id')->withTrashed();
    }
    function userRejected()
    {
        return $this->belongsTo(User::class, 'rejected_by', 'id')->withTrashed();
    }
    function issue()
    {
        return $this->belongsTo(Issue::class, 'issue_id', 'id');
    }
}
