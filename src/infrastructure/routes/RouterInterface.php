<?php

namespace App\Infrastructure\routes;

use App\Infrastructure\routes\http\AbstractRequest;

interface RouterInterface
{
    public function get(string $path, callable $handler);
    public function post(string $path, callable $handler);
    public function dispatch(AbstractRequest $request);
}
