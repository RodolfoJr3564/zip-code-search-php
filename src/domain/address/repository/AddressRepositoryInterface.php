<?php

namespace App\Domain\address\repository;

use App\Domain\address\entity\AddressEntity;
use App\Common\AbstractSortableField;

interface AddressRepositoryInterface
{
    public function list(AbstractSortableField ...$sortFields): array;
    public function save(AddressEntity $address): array;
}
