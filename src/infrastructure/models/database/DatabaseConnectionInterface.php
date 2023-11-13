<?php

namespace App\Infrastructure\models\database;

interface DatabaseConnectionInterface
{
    /**
     * @param array{DB_HOST: string, DB_NAME: string, DB_USER: string, DB_PASS: string}
     */
    public function __construct(array $config);
    public static function getInstance(): DatabaseConnection;
    public function getConnection(): \PDO;

}
