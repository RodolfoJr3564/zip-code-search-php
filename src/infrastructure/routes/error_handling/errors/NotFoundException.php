<?php

namespace App\Infrastructure\routes\error_handling\errors;

class NotFoundException extends \Exception
{
    public function __construct($message = 'Rota não encontrada', $code = 404, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
