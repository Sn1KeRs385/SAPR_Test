<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\SignupRequest;
use App\Http\Resources\Api\Auth\TokenResource;
use Illuminate\Http\Request;
use App\Services\Api\AuthService;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function signup(SignupRequest $request)
    {
        $token = $this->authService->signup(
            $request->name,
            $request->email,
            $request->password
        );

        return response()->json(TokenResource::make($token), Response::HTTP_CREATED);
    }

    public function login(LoginRequest $request)
    {
        $token = $this->authService->login(
            $request->email,
            $request->password,
        );

        return response()->json(TokenResource::make($token), Response::HTTP_ACCEPTED);
    }


    public function logout(Request $request)
    {
        $this->authService->logout($request->user());

        return response()->json(Response::HTTP_OK);
    }
}
