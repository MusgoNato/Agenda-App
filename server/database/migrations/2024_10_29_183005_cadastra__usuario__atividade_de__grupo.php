<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\RequestMatcher\SchemeRequestMatcher;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('Cadastra_Usuario_Atividade_de_Grupo', function(Blueprint $table){
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('Cadastra_Usuario_Atividade_de_Grupo_id')->constrained('Cadastra_Usuario_Atividade_de_Grupo')->onDelete('cascade'); 
            $table->foreignId('Grupo_id')->constrained('Grupo')->onDelete('cascade');                
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('Cadastra_Usuario_Atividade_de_Grupo');
    }
};
