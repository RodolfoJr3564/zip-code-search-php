<?php

namespace App\Infrastructure\routes\error_handling\errors;

class InvalidParamtersException extends \Exception
{
    public function __construct($message = 'Não foi possível processar dados do endereço enviado', $code = 400, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
