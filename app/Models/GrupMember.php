<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupMember extends Model
{
    use HasFactory;

    protected $table = 'ms_group_member';
    protected $primaryKey = 'id';

    protected $guarded = ['id'];
}
