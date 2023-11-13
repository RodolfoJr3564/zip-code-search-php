<?php

namespace App\Infrastructure\routes\http;

use App\Infrastructure\routes\http\query_params_parser\QueryParamsParser;
use App\Infrastructure\routes\http\body_parser\BodyParserFactory;

abstract class AbstractRequest
{
    protected function parseQueryParams(array $params)
    {
        return QueryParamsParser::parse($params);
    }

    protected function parseBody(string $contentType, $content)
    {
        $parser = BodyParserFactory::createParser($contentType);

        return $parser->parse($content);
    }
}
