<?php

namespace App\Infrastructure\routes\error_handling\errors;

class BodyParsingException extends \Exception
{
    public function __construct($message = 'Erro ao parsear o body da requisição', $code = 400, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
