<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusTiket extends Model
{
    use HasFactory;

    protected $table = 'ms_status_tiket';
    protected $primaryKey = 'id';

    protected $guarded = ['id'];
}
