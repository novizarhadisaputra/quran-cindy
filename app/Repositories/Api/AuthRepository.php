<?php

namespace App\Repositories\Api;

use App\Models\User;
use Illuminate\Support\MessageBag;

class AuthRepository
{
    protected $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function login($request)
    {
        $attempt = $request->only(['email', 'password']);
        if (!$token = auth('api')->attempt($attempt)) {
            return (new MessageBag())->add('password', __('auth.password'));
        }
        if ($this->user->where('email_verified_at', null)->first()) {
            return (new MessageBag())->add('email', __('auth.not-verified'));
        }

        return $this->respondWithToken($token);
    }

    public function register($request)
    {
        return;
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth('api')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
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
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
        ];
    }
}
