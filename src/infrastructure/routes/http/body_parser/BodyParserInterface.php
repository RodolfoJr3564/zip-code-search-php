<?php

namespace App\Infrastructure\routes\http\body_parser;

interface BodyParserInterface
{
    public function parse(string $body): array;
}
