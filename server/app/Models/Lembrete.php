<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lembrete extends Model
{
    use HasFactory;

    protected $table = 'lembretes';

    protected $fillable = [
        'atividade_prioridade_id',
    ];

    /**
     * Relacionamento com o model AtividadePrioridade.
     */
    public function atividadePrioridade()
    {
        return $this->belongsTo(AtividadePrioridade::class, 'atividade_prioridade_id');
    }
}
