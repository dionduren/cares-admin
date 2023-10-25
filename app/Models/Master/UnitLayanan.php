<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitLayanan extends Model
{
    use HasFactory;

    protected $table = 'ms_unit_layanan';
    protected $primaryKey = 'id';

    protected $guarded = ['id'];
}
