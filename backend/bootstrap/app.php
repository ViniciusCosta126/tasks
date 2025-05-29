<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(\App\Http\Middleware\ForceJsonResponse::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {

        $exceptions->render(function (\App\Exceptions\NotFoundException $e, $request) {
            return response()->json([
                'message' => $e->getMessage()
            ], 404);
        });


        $exceptions->render(function (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e, $request) {
            return response()->json([
                'message' => 'Rota não encontrada.'
            ], 404);
        });


        $exceptions->render(function (\Illuminate\Database\QueryException $e, $request) {
            return response()->json([
                'message' => 'Erro de banco de dados.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        });


        $exceptions->render(function (\Throwable $e, $request) {
            return response()->json([
                'message' => 'Erro interno no servidor.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        });
    })
    ->create();
