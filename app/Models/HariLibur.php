<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HariLibur extends Model
{
    use HasFactory;

    protected $table = 'ms_holiday';
    protected $primaryKey = 'id';

    protected $guarded = ['id'];
}
