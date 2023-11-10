<?php

namespace App\Domain\address\repository;

use App\Domain\address\entity\AddressEntity;
use App\Common\AbstractSortableField;

interface AddressRepositoryInterface
{
    /**
     * @param AbstractSortableField[]
     * @return AddressEntity[]
    */
    public function list(AbstractSortableField ...$sortFields): array;

    /**
     * @param AddressEntity
     * @return void
    */
    public function save(AddressEntity $address): void;
}
