<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginApiRequest;
use App\Http\Requests\Auth\RegisterApiRequest;
use App\Models\User;
use App\Services\Auth\LoginService;
use App\Traits\ResponseCreator;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ResponseCreator;

    private $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function register(RegisterApiRequest $request)
    {
        User::create($request->validated());
        $loginReponse = $this->loginService->login($request->email, $request->password);

        return $this->createResponseSuccess($loginReponse, 201, 'Usuário registrado com sucesso.');
    }

    public function login(LoginApiRequest $request)
    {
        $loginReponse = $this->loginService->login($request->login, $request->password);

        return $this->createResponseSuccess($loginReponse, 200, 'Login realizado com sucesso.');
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->createResponseSuccess([], 200, 'Logout realizado com sucesso.');
    }

    public function user(Request $request)
    {
        return $this->createResponseSuccess($request->user(), 200, 'Usuário logado.');
    }
}
