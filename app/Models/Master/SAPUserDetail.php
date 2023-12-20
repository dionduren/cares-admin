<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SAPUserDetail extends Model
{
    use HasFactory;

    protected $table = 'user_login_detail';
    protected $primaryKey = 'id';

    protected $guarded = ['id'];
}
