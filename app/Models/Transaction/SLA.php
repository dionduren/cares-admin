<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SLA extends Model
{
    use HasFactory;

    protected $table = 'tr_sla';
    protected $primaryKey = 'id';

    protected $guarded = ['id'];
}
