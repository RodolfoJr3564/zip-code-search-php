<?php

namespace App\UseCases\list_addresses;

use App\Domain\address\repository\AddressRepositoryInterface;
use App\UseCases\list_addresses\SortableField;
use App\UseCases\list_addresses\ListAddressesUseCaseInputDTO;
use App\UseCases\list_addresses\ListAddressesUseCaseOutputDTO;

class ListAddressesUseCase
{
    private AddressRepositoryInterface $addressRepository;

    public function __construct(AddressRepositoryInterface $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    public function execute(ListAddressesUseCaseInputDTO $addressListDTO): ListAddressesUseCaseOutputDTO
    {
        $sortableFields =  array_map(fn ($sortField) => new SortableField(...$sortField), $addressListDTO->sortFields);
        $addresses = $this->addressRepository->list(...$sortableFields);
        return new ListAddressesUseCaseOutputDTO($addresses);
    }
}
