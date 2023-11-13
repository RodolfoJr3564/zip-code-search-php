<?php

namespace App\Infrastructure\routes\http\query_params_parser;

interface QueryParamsParserInterface
{
    public static function parse(array $queryParams): array;
}
