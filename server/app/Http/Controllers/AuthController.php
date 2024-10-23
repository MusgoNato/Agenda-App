<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{
    // /**
    //  * Create a new AuthController instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['login']]);
    // }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        $redisKey = "user:{$credentials['email']}:token"; 
        $existingToken = Redis::get($redisKey); 
    
        if ($existingToken) {
            return response()->json([
                'success' => false,
                'token' => $existingToken, 
                'message' => 'Voce ja esta logado em outro aparelho!'
            ], 401);
        }
    
        // Verifica as credenciais do usuário
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if($user->status==="not authenticated")
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Verifique Sua Conta Primeiro!'
                ], 401);
            }
            $token = JWTAuth::fromUser($user);
    
            // Armazena o token no Redis com uma expiração (ex: 1 hora)
            Redis::set($redisKey, $token, 'EX', 3600); // Define o token com expiração de 1 hora
    
            return response()->json([
                'success' => true,
                'message' => 'Logado com Sucesso',
                'token' => $token,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email
                ]
            ], 200);
        }
    
        return response()->json([
            'success' => false,
            'message' => 'Credenciais inválidas'
        ], 401);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(Request $request)
    {
        $token = $request->input('token'); // Pega o token do corpo da requisição

        try {
            // Decodifica o token para obter os dados do payload
            $payload = JWTAuth::setToken($token)->payload();
    
            // Verifica se o token é válido
            if (!$payload) {
                return response()->json(['error' => 'Token inválido ou expirado'], 401);
            }
    
            // Obtém a data de expiração do token
            $exp = $payload['exp'];
            $expirationTime = Carbon::createFromTimestamp($exp); // Cria um objeto Carbon
            $remainingTime = $expirationTime->diffInSeconds(Carbon::now()); // Calcula o tempo restante em segundos
    
            // Tenta obter o usuário a partir do token
            $user = JWTAuth::setToken($token)->authenticate();
            
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token inválido ou expirado'], 401);
        }
    
        if (!$user) {
            return response()->json(['error' => 'Usuário não encontrado'], 404);
        }
    
        return response()->json([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email
            ],
            'token_expires_in' => $remainingTime
        ]);
    }

 
/**
 * Log the user out (Invalidate the token).
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\JsonResponse
 */
public function logout(Request $request)
{
    $token = $request->input('token'); // Pega o token do corpo da requisição
    $userEmail = null;
    try {
        $user = JWTAuth::setToken($token)->authenticate();
        $userEmail = $user->email;
    } catch (JWTException $e) {
        return response()->json(['error' => 'Token inválido ou expirado'], 401);
    }

    if (!$userEmail) {
        return response()->json(['error' => 'Usuário não encontrado'], 404);
    }

    // Remove o token do Redis
    $redisKey = "user:{$userEmail}:token"; 
    Redis::del($redisKey);

    JWTAuth::invalidate($token); // Invalida o token

    return response()->json(['message' => 'Logout realizado com sucesso']);
}


    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
