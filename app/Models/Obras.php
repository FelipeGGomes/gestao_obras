<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obras extends Model
{
    protected $fillable = [
        'user_id',
        'nome_obra',
        'descricao',
        'data_inicio',
        'data_fim',
        'fim_real',
        'status',
    ];
}
