<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyInspectionSummary extends Model
{
    use HasFactory;

    protected $table = 'daily_inspection_summary';
    protected $guarded = ['id'];

    function inspection()
    {
        return $this->belongsTo(DailyInspection::class, 'inspection_id', 'id');
    }
    function question()
    {
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }
    function answer()
    {
        return $this->belongsTo(Answer::class, 'answer_id', 'id');
    }
    function issue()
    {
        return $this->hasOne(Issue::class, 'sumary_id', 'id');
    }
}
