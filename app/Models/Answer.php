<?php

namespace App\Models;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'answer';
    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $prefix = 'A' . $model->question->area->area_code;
            $model->code = IdGenerator::generate(['table' => 'answer', 'field' => 'code', 'length' => 9, 'prefix' => $prefix]);
        });
    }

    function question()
    {
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }
}
