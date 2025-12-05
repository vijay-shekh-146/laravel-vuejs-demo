<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Helpers\ApiResponse;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
         
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Validation errors
        $exceptions->render(function (ValidationException $e) {
            return ApiResponse::error(422, 'Validation failed', $e->errors());
        });


         // Model not found
        $exceptions->render(function (ModelNotFoundException $e) {
            return ApiResponse::error(404, 'Resource not found');
        });

      

        // Fallback for other exceptions
        $exceptions->render(function (Exceptions $e) {
            \Log::error($e); // Log the error

            return ApiResponse::error(500, 'Something went wrong.');
        });
    })->create();
