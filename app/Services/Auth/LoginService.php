<?php

namespace App\Services\Auth;

use Carbon\Carbon;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class LoginService
{
    public function login(string $login, string $password)
    {
        // verifica se o login é um e-mail se não for remove todos os caracteres que não são números
        if (!strpos($login, '@')) {
            $login = preg_replace('/[^0-9]/', '', $login);
        }

        // realiza o login
        if (!Auth::attempt(['email' => $login, 'password' => $password])) {
            throw new AuthenticationException('Usuário ou senha inválidos.');
        }

        $user = Auth::user();
        $token = $user->createToken('api')->plainTextToken;

        return [
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse()->addMinutes(config('sanctum.expiration'))->format('Y-m-d H:i:s'),
            'user' => $user,
        ];
    }
}
