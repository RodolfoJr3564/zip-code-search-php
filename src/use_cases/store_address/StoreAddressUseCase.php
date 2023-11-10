<?php

namespace App\UseCases\store_address;

use App\UseCases\store_address\StoreAddressUseCaseInputDTO;
use App\Domain\address\entity\AddressEntity;
use App\Domain\address\value_object\ZipCodeValueObject;
use App\Domain\address\value_object\state\BrazilianStateValueObject;
use App\Domain\address\repository\AddressRepositoryInterface;

class StoreAddressUseCase
{
    private AddressRepositoryInterface $addressRepository;

    public function __construct(AddressRepositoryInterface $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    public function execute(StoreAddressUseCaseInputDTO $addressInput): void
    {
        $zipCodeInstance = new ZipCodeValueObject($addressInput->zipCode);
        $stateUFInstance = new BrazilianStateValueObject($addressInput->stateUF);

        $addressEntity = new AddressEntity(
            zipCode: $zipCodeInstance,
            stateUF: $stateUFInstance,
            street: $addressInput->street,
            city: $addressInput->city,
            number: $addressInput->number,
            complement: $addressInput->complement,
            district: $addressInput->district
        );

        $this->addressRepository->save($addressEntity);
    }
}
