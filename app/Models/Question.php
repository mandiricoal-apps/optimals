<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'question';
    protected $guarded = ['id'];

    function area()
    {
        return $this->belongsTo(Area::class, 'area_id', 'id');
    }
}
