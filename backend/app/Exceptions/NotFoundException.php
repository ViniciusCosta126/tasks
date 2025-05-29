<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class NotFoundException extends NotFoundHttpException
{
    public function __construct($message = 'Item não encontrado', \Throwable $previous = null)
    {
        parent::__construct($message, $previous, 404);
    }
}
