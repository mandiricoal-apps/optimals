<?php

namespace App\Models;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;
    protected $table = "issue";
    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $prefix = date('y') . 'IL' . $model->summary->inspection->area->area_code;
            $model->code = IdGenerator::generate(['table' => 'issue', 'field' => 'code', 'length' => 12, 'prefix' => $prefix, 'reset_on_prefix_change' => true]);
        });
    }


    function summary()
    {
        return $this->belongsTo(DailyInspectionSummary::class, 'sumary_id', 'id');
    }

    function progressIssue()
    {
        return $this->hasOne(ProgressIssue::class, 'issue_id', 'id');
    }
}
