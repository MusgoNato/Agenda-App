<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtividadePrioridade extends Model
{
    use HasFactory;

    protected $table = 'atividade_prioridade';

    public $timestamps = false;

    protected $fillable = [
        'descricao',
        'titulo',
        'data',
    ];
}
