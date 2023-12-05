<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogScore extends Model
{
    use HasFactory;
    protected $table = "log_score";
    protected $guarded = ['id'];

    function DailyInspection()
    {
        return $this->belongsTo(DailyInspection::class, 'inspection_id', 'id');
    }
    function User()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
