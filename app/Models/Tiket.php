<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tiket extends Model
{
    use HasFactory;

    protected $table = 'tr_tiket';
    protected $primaryKey = 'id';

    protected $guarded = ['id'];

    public function parent_tiket()
    {
        return $this->hasOne(Tiket::class, 'id_tiket_prev', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id_creator');
    }
}
