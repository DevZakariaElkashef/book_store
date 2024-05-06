<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;

use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {

        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        // handle the fallback exception for the application dashboard and site
        if ($this->isHttpException($exception)) {
            if ($request->is('dashboard/*')) {
                if ($exception->getStatusCode() == 404) {
                    return response()->view('dashboard.errors.404');
                }
            } else {
                if ($exception->getStatusCode() == 404) {
                    return response()->view('welcome');
                }
            }
        }

        return parent::render($request, $exception);
    }
}
