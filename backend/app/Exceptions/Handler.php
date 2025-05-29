<?php

namespace App\Exceptions;

use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontReport = [];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        // Exceção customizada
        $this->renderable(function (NotFoundException $e, $request) {
            return response()->json([
                'message' => $e->getMessage()
            ], 404);
        });

        // Rota não encontrada
        $this->renderable(function (NotFoundHttpException $e, $request) {
            return response()->json([
                'message' => 'Rota não encontrada.'
            ], 404);
        });

        // Outros erros 500
        $this->renderable(function (Throwable $e, $request) {
            if ($e instanceof \Illuminate\Database\QueryException || $e instanceof \PDOException) {
                return response()->json([
                    'message' => 'Erro de banco de dados.',
                    'error' => config('app.debug') ? $e->getMessage() : null
                ], 500);
            }

            return response()->json([
                'message' => 'Erro interno no servidor.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        });
    }
}
