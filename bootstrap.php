<?php

require __DIR__ . '/vendor/autoload.php';

use App\Infrastructure\routes\http\Request;
use App\Infrastructure\routes\Router;
use App\Infrastructure\controllers\AddressController;
use App\Infrastructure\routes\error_handling\ErrorHandler;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$errorHandler = new ErrorHandler();

$errorHandler->handle(function () {
    $router = new Router();
    $router->get('/', [AddressController::class, 'index']);
    $router->post('/', [AddressController::class, 'save']);

    $request = new Request($_SERVER, $_GET);
    $router->dispatch($request);
});
