<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitKerja extends Model
{
    use HasFactory;

    protected $table = 'ms_unit_kerja';
    protected $primaryKey = 'id';

    protected $guarded = ['id'];
}
