<?php

namespace App\Infrastructure\routes\http\body_parser;

class BodyParserFactory
{
    public static function createParser(string $contentType): BodyParserInterface
    {
        switch ($contentType) {
            case 'application/json':
                return new JsonBodyParser();
            default:
                throw new Exception("Content type not supported");
        }
    }
}
