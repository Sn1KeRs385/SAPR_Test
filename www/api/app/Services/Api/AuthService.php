<?php

namespace App\Services\Api;


use App\Exceptions\Api\Auth\WrongCredentialException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\PersonalAccessTokenResult;

class AuthService
{
    public function signup(string $name, string $email, string $password): PersonalAccessTokenResult
    {
        $user = new User([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password)
        ]);

        $user->save();

        $token = $this->createToken($user);

        return $token;
    }

    public function login(string $email, string $password): PersonalAccessTokenResult
    {
        $credentials = [
            'email' => $email,
            'password' => $password,
        ];
        if(!Auth::attempt($credentials)) {
            throw new WrongCredentialException();
        }
        $user = request()->user();

        $token = $this->createToken($user);

        return $token;
    }

    public function logout(User $user): void
    {
        $user->token()->revoke();
    }

    protected function createToken(User $user): PersonalAccessTokenResult
    {
        $tokenResult = $user->createToken('Personal Access Token');

        return $tokenResult;
    }
}
