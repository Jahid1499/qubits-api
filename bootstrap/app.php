<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\CustomerMiddleware;
use App\Http\Middleware\TokenVerificationMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;
use \Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api:[
            __DIR__.'/../routes/api.php',
        ],
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function(){
            Route::prefix('api/v1/auth')->group(function () {
                require __DIR__.'/../routes/auth.php';
            });

            Route::prefix('api/v1')->group(function () {
                require __DIR__.'/../routes/admin.php';
            });

            Route::prefix('api/v1')->group(function () {
                require __DIR__.'/../routes/customer.php';
            });
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'auth' => TokenVerificationMiddleware::class,
            'admin' => AdminMiddleware::class,
            'customer' => CustomerMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (NotFoundHttpException $exception) {
            if ($exception->getStatusCode() == 404) {
                return response()->json(['message' => '404 not found'], 404);
            }
        });
    })->create();
