<?php

namespace App\Infrastructure\models\database;

use App\Infrastructure\models\database\DatabaseConnectionInterface;

class DatabaseConnection implements DatabaseConnectionInterface
{
    private static ?DatabaseConnection $instance = null;
    private \PDO $connection;

    /**
     * @param array{DB_HOST: string, DB_NAME: string, DB_USER: string, DB_PASS: string}
     */
    public function __construct(array $config)
    {
        $host = $config['DB_HOST'];
        $db   = $config['DB_NAME'];
        $user = $config['DB_USER'];
        $pass = $config['DB_PASS'];
        $port = $config['DB_PORT'];

        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, // throw exceptions on errors
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC, // return rows as associative arrays
        ];

        $dsn = "pgsql:host=$host;port=$port;dbname=$db;";

        $this->connection = new \PDO($dsn, $user, $pass, $options);

    }

    public static function getInstance(): DatabaseConnection
    {
        if (self::$instance === null) {
            self::$instance = new DatabaseConnection();
        }

        return self::$instance;
    }

    public function getConnection(): \PDO
    {
        return $this->connection;
    }
}
