<?php

namespace App\Repositories\Api;

class AuthRepository
{
    protected $user;

    public function __construct()
    {

    }

    public function login($request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!auth()->attempt($credentials)) {
            return redirect()->route('login');
        }

        return redirect()->route('dashboard');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->back();
    }
}
