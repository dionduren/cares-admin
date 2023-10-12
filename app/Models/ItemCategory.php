<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemCategory extends Model
{
    use HasFactory;

    protected $table = 'ms_item_kategori';
    protected $primaryKey = 'id';

    protected $guarded = ['id'];

    public function subkategori()
    {
        return $this->hasOne(Subkategori::class, 'id_subkategori', 'id');
    }
}
