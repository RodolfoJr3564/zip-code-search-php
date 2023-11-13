<?php

namespace App\Infrastructure\routes;

use App\Infrastructure\routes\RouterInterface;
use App\Infrastructure\routes\http\AbstractRequest;
use App\Infrastructure\routes\error_handling\errors\NotFoundException;

class Router implements RouterInterface
{
    private $routes = [];

    public function get($path, $handler)
    {
        $this->addRoute('GET', $path, $handler);
    }

    public function post($path, $handler)
    {
        $this->addRoute('POST', $path, $handler);
    }

    private function addRoute($method, $path, $handler)
    {
        $this->routes[$method][$path] = $handler;
    }

    public function dispatch(AbstractRequest $request)
    {
        $method = $request->method;
        $path = $request->path;

        if (isset($this->routes[$method][$path])) {
            $handler = $this->routes[$method][$path];
            if (is_callable($handler)) {
                call_user_func($handler, $request);
            }
        } else {
            throw new NotFoundException();
        }
    }
}
