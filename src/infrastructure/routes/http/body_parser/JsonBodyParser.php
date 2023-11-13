<?php

namespace App\Infrastructure\routes\http\body_parser;

use App\Infrastructure\routes\http\body_parser\BodyParserInterface;
use App\Infrastructure\routes\error_handling\errors\BodyParsingException;

class JsonBodyParser implements BodyParserInterface
{
    public function parse(string $body): array
    {
        try {
            return json_decode($body, true);
        } catch (\Throwable $e) {
            throw new BodyParsingException();
        }
    }
}
