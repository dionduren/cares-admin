<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;


    protected $table = 'ms_role';
    protected $primaryKey = 'id';

    protected $guarded = ['id'];

    public function user()
    {
        return $this->hasMany(User::class, 'id', 'role_id');
    }
}
