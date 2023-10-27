<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeSLA extends Model
{
    use HasFactory;

    protected $table = 'ms_tipe_sla';
    protected $primaryKey = 'id';

    protected $guarded = ['id'];
}
