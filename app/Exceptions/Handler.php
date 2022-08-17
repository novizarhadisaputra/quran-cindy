<?php

namespace App\Exceptions;

use Throwable;
use App\Http\Transformers\ResponseTransformer;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof NotFoundHttpException) {
            if ($request->expectsJson()) {
                return (new ResponseTransformer)->toJson(400, __('messages.404'));
            }
        }

        if ($e instanceof ValidationException) {
            if ($request->expectsJson()) {
                return (new ResponseTransformer)->toJson(400, __('messages.422'), $e->errors());
            }
        }

        if ($request->expectsJson()) {
            return (new ResponseTransformer)->toJson(400, $e->getMessage());
        }
    }
}
