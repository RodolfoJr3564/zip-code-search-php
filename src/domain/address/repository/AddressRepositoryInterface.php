<?php

namespace App\Domain\address\repository;

use App\Domain\address\entity\AddressEntity;
use App\Common\AbstractSortableField;

interface AddressRepositoryInterface
{
    /**
    * @param array{DB_HOST: string, DB_NAME: string, DB_USER: string, DB_PASS: string}
    */
    public function __construct(array $config);

    /**
     * @param AbstractSortableField[]
     * @return AddressEntity[]
    */
    public function list(array $sortParams): array;

    /**
     * @param AddressEntity
     * @return void
    */
    public function save(AddressEntity $address): void;
}
