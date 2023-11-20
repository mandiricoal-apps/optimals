<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;
    protected $table = "issue";
    protected $guarded = ['id'];

    function summary()
    {
        return $this->belongsTo(DailyInspectionSummary::class, 'sumary_id', 'id');
    }
}
