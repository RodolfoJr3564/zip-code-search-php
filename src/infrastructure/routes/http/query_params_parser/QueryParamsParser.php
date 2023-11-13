<?php

namespace App\Infrastructure\routes\http\query_params_parser;

use App\Infrastructure\routes\error_handling\errors\QueryParametersException;

class QueryParamsParser implements QueryParamsParserInterface
{
    public static function parse(array $queryParams): array
    {
        try {
            $parsedParams = [];

            foreach ($queryParams as $key => $value) {
                if (is_array($value)) {
                    $parsedParams[$key] = self::parse($value);
                } elseif (isset($key, $value)) {
                    $parsedParams[$key] = $value;
                }
            }

            return $parsedParams;
        } catch (\Throwable $e) {
            throw new QueryParametersException();
        }
    }

}
