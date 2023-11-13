<?php

namespace App\Infrastructure\routes\error_handling;

class ErrorHandler
{
    public function handle($callback)
    {
        set_error_handler([$this, 'errorHandler']);
        set_exception_handler([$this, 'exceptionHandler']);

        try {
            return $callback();
        } catch (\Throwable $e) {
            $this->handleException($e);
        } finally {
            restore_error_handler();
            restore_exception_handler();
        }
    }

    public function errorHandler($severity, $message, $file, $line)
    {
        if (!(error_reporting() & $severity)) {
            return false;
        }
        throw new \ErrorException($message, 0, $severity, $file, $line);
    }

    public function exceptionHandler($exception)
    {
        $this->handleException($exception);
    }

    private function handleException(\Throwable $e)
    {
        error_log($e);
        http_response_code($e->getCode() ?? 500);
        header('Content-Type: application/json');
        echo json_encode(['message' => $e->getMessage()]);
    }
}
