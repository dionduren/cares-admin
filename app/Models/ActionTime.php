<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionTime extends Model
{
    use HasFactory;

    protected $table = 'tr_action_time';
    protected $primaryKey = 'id';

    protected $guarded = ['id'];
}
