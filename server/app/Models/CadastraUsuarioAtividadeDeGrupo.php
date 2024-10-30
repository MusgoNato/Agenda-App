<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CadastraUsuarioAtividadeDeGrupo extends Model
{
    use HasFactory;

    protected $table = 'Cadastra_Usuario_Atividade_de_Grupo';

    public $timestamps = false;

    protected $fillable = [
        'user_id', 
        'Cadastra_Usuario_Atividade_de_Grupo_id', 
        'Grupo_id'
    ];

    /**
     * Relacionamento com o model User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relacionamento com o próprio model para referenciar a atividade de grupo.
     */
    public function atividadeDeGrupo()
    {
        return $this->belongsTo(self::class, 'Cadastra_Usuario_Atividade_de_Grupo_id');
    }

    /**
     * Relacionamento com o model Grupo.
     */
    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'Grupo_id');
    }
}
