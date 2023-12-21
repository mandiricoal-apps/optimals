<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotificationEmail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'notification_email';
    protected $guarded = ['id'];
}
