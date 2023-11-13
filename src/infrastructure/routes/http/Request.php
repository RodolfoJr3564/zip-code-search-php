<?php

namespace App\Infrastructure\routes\http;

use App\Infrastructure\routes\http\body_parser\BodyParserFactory;
use App\Infrastructure\routes\http\query_params_parser\QueryParamsParser;
use App\Infrastructure\routes\error_handling\errors\RequestProcessingException;

class Request extends AbstractRequest
{
    public $method;
    public $path;
    public $queryParams;
    public $body;
    public $host;

    public function __construct($serve, $get)
    {
        try {

            $this->method = $serve['REQUEST_METHOD'];
            $this->host = $_SERVER['HTTP_HOST'];
            $this->path = parse_url($serve['REQUEST_URI'], PHP_URL_PATH);
            $this->queryParams = empty($get) ? [] : parent::parseQueryParams($get);
            $contentType = $serve['CONTENT_TYPE'] ?? null;
            $content = file_get_contents('php://input');
            if($contentType && $content) {
                $this->body = $contentType ? parent::parseBody($contentType, $content) : [];
            }

        } catch (\Throwable $e) {
            throw new RequestProcessingException();
        }

    }
}
