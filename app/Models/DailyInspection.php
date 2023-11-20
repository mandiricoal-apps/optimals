<?php

namespace App\Models;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailyInspection extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'daily_inspections';
    protected $guarded = ['id', 'code'];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $prefix = date('y') . 'DI' . $model->area->area_code;
            $model->code = IdGenerator::generate(['table' => 'daily_inspections', 'field' => 'code', 'length' => 12, 'prefix' => $prefix, 'reset_on_prefix_change' => true]);
        });
    }

    function area()
    {
        return $this->belongsTo(Area::class, 'area_id', 'id');
    }

    function summary()
    {
        return $this->hasMany(DailyInspectionSummary::class, 'inspection_id', 'id');
    }
    function location()
    {
        return $this->hasOne(DataLocation::class, 'inspection_id', 'id');
    }
    function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
