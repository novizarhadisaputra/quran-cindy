<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Http\Transformers\ResponseTransformer;
use Exception;
use Illuminate\Support\MessageBag;

class AuthController extends Controller
{
    protected $auth;

    public function __construct()
    {
        $this->auth = app()->make('repository.api.auth');
    }

    public function login(AuthLoginRequest $request)
    {
        try {
            $response = $this->auth->login($request);
            if ($response instanceof MessageBag == true) {
                return (new ResponseTransformer)->toJson(400, __('messages.400'), $response);
            }
            if (!$response) {
                return (new ResponseTransformer)->toJson(400, __('messages.400'), false);
            }
            return (new ResponseTransformer)->toJson(200, __('messages.200'), $response);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function register(AuthRegisterRequest $request)
    {
        try {
            $response = $this->auth->register($request);
            if ($response instanceof MessageBag == true) {
                return (new ResponseTransformer)->toJson(400, __('messages.400'), $response);
            }
            if (!$response) {
                return (new ResponseTransformer)->toJson(400, __('messages.400'), false);
            }
            return (new ResponseTransformer)->toJson(200, __('messages.200'), $response);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function logout()
    {
        try {
            $response = $this->auth->logout();
            if ($response instanceof MessageBag == true) {
                return (new ResponseTransformer)->toJson(400, __('messages.400'), $response);
            }
            if (!$response) {
                return (new ResponseTransformer)->toJson(400, __('messages.400'), false);
            }
            return (new ResponseTransformer)->toJson(200, __('messages.200'), $response);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function refresh()
    {
        try {
            $response = $this->auth->refresh();
            if ($response instanceof MessageBag == true) {
                return (new ResponseTransformer)->toJson(400, __('messages.400'), $response);
            }
            if (!$response) {
                return (new ResponseTransformer)->toJson(400, __('messages.400'), false);
            }
            return (new ResponseTransformer)->toJson(200, __('messages.200'), $response);
        } catch (Exception $e) {
            throw $e;
        }
    }
}
