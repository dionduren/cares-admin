<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupTechnical extends Model
{
    use HasFactory;

    protected $table = 'ms_technical_group';
    protected $primaryKey = 'id';

    protected $guarded = ['id'];

    public function team_lead()
    {
        return $this->user(User::class, 'id_team_lead', 'id');
    }
}
