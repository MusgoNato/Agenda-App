<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifica extends Model
{
    use HasFactory;

    protected $table = 'notifica';

    protected $fillable = [
        'user_id', 
        'lembrete_id',
    ];

    /**
     * Relacionamento com o model User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relacionamento com o model Lembrete.
     */
    public function lembrete()
    {
        return $this->belongsTo(Lembrete::class, 'lembrete_id');
    }
}
