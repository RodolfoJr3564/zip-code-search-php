<?php

use PHPUnit\Framework\TestCase;

use App\UseCases\store_address\StoreAddressUseCaseInputDTO;
use App\UseCases\store_address\StoreAddressUseCase;
use App\Domain\address\repository\AddressRepositoryInterface;

class StoreAddressUseCaseTest extends TestCase
{
    public function testItShouldSuccessfullyStoreAddress()
    {
        $addressInputDTO = new StoreAddressUseCaseInputDTO(
            zipCode: '12345-678',
            stateUF: 'SC',
            street: 'Rua 1',
            city: 'Santa Catarina',
            number: '0',
            complement: 'Apartamento 101',
            district: 'Centro'
        );

        $addressRepositoryMock = $this->createMock(AddressRepositoryInterface::class);
        $addressRepositoryMock->expects($this->once())
            ->method('save');

        $storeAddressUseCase = new StoreAddressUseCase($addressRepositoryMock);
        $storeAddressUseCase->execute($addressInputDTO);
    }
}
