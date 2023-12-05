<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataLocation extends Model
{
    use HasFactory;
    protected $table = "data_location";
    protected $guarded = ['id'];


    function inspection()
    {
        return $this->belongsTo(DailyInspection::class, 'inspection_id', 'id');
    }
}
