<?php

namespace App\Models;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'question';
    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $prefix = 'Q' . $model->area->area_code;
            $model->code = IdGenerator::generate(['table' => 'question', 'field' => 'code', 'length' => 7, 'prefix' => $prefix, 'reset_on_prefix_change' => true]);
        });
    }


    function area()
    {
        return $this->belongsTo(Area::class, 'area_id', 'id');
    }

    function answer()
    {
        return $this->hasMany(Answer::class, 'question_id', 'id');
    }
}
