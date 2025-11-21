<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etapas extends Model
{
    protected $fillable = [
        'user_id',
        'obra_id',
        'nome_etapa',
        'data_inicio',
        'data_fim',
        'fim_real',
        'status',
    ];
}
