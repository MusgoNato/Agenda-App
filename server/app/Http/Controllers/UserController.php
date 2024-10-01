<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function store(Request $request)
    {
        // Criação da validação personalizada
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        // Se a validação falhar, você pode personalizar o que acontece
        if ($validator->fails()) {
            // Aqui você pode retornar uma mensagem personalizada
            return response()->json([
                'success' => false,
                'message' => 'Dados inválidos',
                'errors' => $validator->errors() // Ou você pode retornar os erros específicos
            ], 400);
        }

        // Se passar na validação, você continua o processo de criação do usuário
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Usuário criado com sucesso!',
            'user' => $user
        ], 201);
    }
}
