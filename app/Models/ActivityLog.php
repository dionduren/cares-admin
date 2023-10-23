<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $table = 'tr_activity_log';
    protected $primaryKey = 'id';

    protected $guarded = ['id'];
}
