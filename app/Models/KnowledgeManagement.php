<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KnowledgeManagement extends Model
{
    use HasFactory;

    protected $table = 'ms_knowledge_management';
    protected $primaryKey = 'id';

    protected $guarded = ['id'];
}
