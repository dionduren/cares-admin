<?php

namespace App\Models;

use App\Models\Kategori;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subkategori extends Model
{
    use HasFactory;

    protected $table = 'ms_subkategori';
    protected $primaryKey = 'id';

    protected $guarded = ['id'];

    public function kategori()
    {
        return $this->hasOne(Kategori::class, 'id_kategori', 'id');
    }
}
