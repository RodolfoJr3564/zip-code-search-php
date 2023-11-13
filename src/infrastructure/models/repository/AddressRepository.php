<?php

namespace App\Infrastructure\models\repository;

use App\Domain\address\entity\AddressEntity;
use App\Infrastructure\models\database\DatabaseConnectionInterface;
use App\Domain\address\repository\AddressRepositoryInterface;
use App\Infrastructure\models\database\DatabaseConnection;

class AddressRepository implements AddressRepositoryInterface
{
    private DatabaseConnectionInterface $connection;

    /**
     * @param array{DB_HOST: string, DB_NAME: string, DB_USER: string, DB_PASS: string}
     */
    public function __construct(array $config)
    {
        $this->connection = new DatabaseConnection($config);
    }

    /**
     * @param AbstractSortableField[]
    */
    public function list(array $sortParams = []): array
    {
        $selection = "SELECT * FROM address";

        if (!empty($sortParams)) {
            $orderClauses = [];
            foreach ($sortParams as $param) {
                $direction = strtoupper($param->direction->value);
                $orderClauses[$param->priority] = "$param->fieldName $direction";
            }

            if (!empty($orderClauses)) {
                $selection .= ' ORDER BY ' . implode(', ', $orderClauses);
            }
        }

        try {
            $database = $this->connection->getConnection()->prepare($selection);
            $database->execute();
            $addresses = $database->fetchAll(\PDO::FETCH_ASSOC);
            return $addresses;

        } catch (\Throwable $e) {
            error_log($e);
            throw new \Exception("Houve uma falha ao tentar armazenar o endereço", 500);
        }

    }

    public function save(AddressEntity $address): void
    {
        try {
            $query = "INSERT INTO address (zip, street, complement, district, city, uf) VALUES (:zip, :street, :complement, :district, :city, :uf)";

            $stmt = $this->connection->getConnection()->prepare($query);
            $stmt->bindValue(':zip', $address->zipCode->zipCode);
            $stmt->bindValue(':uf', $address->stateUF->uf);
            $stmt->bindValue(':street', $address->street);
            $stmt->bindValue(':complement', $address->complement);
            $stmt->bindValue(':district', $address->district);
            $stmt->bindValue(':city', $address->city);
            $stmt->execute();

        } catch (\PDOException $e) {
            if ($e->getCode() == 23000) {
                error_log("Tentativa de salvar um endereço duplicado: " . $e->getMessage());
            } else {
                throw $e;
            }
        }

    }
}
