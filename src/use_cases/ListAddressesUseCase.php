<?php

namespace App\UseCases;

use App\Common\AbstractSortableField;
use App\Domain\address\repository\AddressRepositoryInterface;

class ListAddressesUseCase
{
    private AddressRepositoryInterface $addressRepository;

    public function __construct(AddressRepositoryInterface $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    public function execute(AbstractSortableField ...$sortFields): array
    {
        return $this->addressRepository->list(...$sortFields);
    }
}
