<?php

namespace App\Infrastructure\routes\error_handling\errors;

class RequestProcessingException extends \Exception
{
    public function __construct($message = 'Erro ao processar a requisição', $code = 500, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
