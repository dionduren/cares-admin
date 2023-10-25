<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JamKerja extends Model
{
    use HasFactory;

    protected $table = 'ms_jam_kerja';
    protected $primaryKey = 'id';

    protected $guarded = ['id'];
}
