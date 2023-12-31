<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'area';
    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->area_code = IdGenerator::generate(['table' => 'area', 'field' => 'area_code', 'length' => 3, 'prefix' => 'A']);
        });
    }

    function question()
    {
        return $this->hasMany(Question::class, 'area_id', 'id');
    }
    function dailyInspection()
    {
        return $this->hasMany(DailyInspection::class, 'area_id', 'id');
    }
}
