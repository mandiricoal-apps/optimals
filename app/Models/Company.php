<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\SoftDeletes;


class Company extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'companies';

    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->comp_id = IdGenerator::generate(['table' => 'companies', 'field' => 'comp_id', 'length' => 6, 'prefix' => 'C-']);
        });
    }
}
