<?php

namespace App\Infrastructure\routes\error_handling\errors;

class QueryParametersException extends \Exception
{
    public function __construct($message = 'Erro ao processar os query parameters', $code = 400, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
