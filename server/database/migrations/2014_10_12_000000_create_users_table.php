<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // Necessário para a inserção de dados

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('status')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamp('authenticated_at')->nullable();
        });

        // Insere o usuário "master" logo após a criação da tabela
        DB::table('users')->insert([
            'name' => 'Master User',
            'email' => 'master@example.com',
            'password' => bcrypt('master123'), // Criptografa a senha "master123"
            'status' => 'active', // Definindo status como ativo, por exemplo
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
