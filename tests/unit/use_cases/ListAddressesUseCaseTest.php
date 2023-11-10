<?php

namespace Tests\UseCases;

use PHPUnit\Framework\TestCase;

use App\UseCases\list_addresses\ListAddressesUseCase;
use App\UseCases\list_addresses\ListAddressesUseCaseInputDTO;
use App\UseCases\list_addresses\ListAddressesUseCaseOutputDTO;
use App\Domain\address\repository\AddressRepositoryInterface;

class ListAddressesUseCaseTest extends TestCase
{
    public function testItShouldListAddressesWithoutSortFields()
    {
        $addressRepositoryMock = $this->createMock(AddressRepositoryInterface::class);
        $addressRepositoryMock->expects($this->once())
            ->method('list')
            ->with()
            ->willReturn([]);

        $listAddressesUseCase = new ListAddressesUseCase($addressRepositoryMock);
        $inputDTO = new ListAddressesUseCaseInputDTO([]);
        $result = $listAddressesUseCase->execute($inputDTO);

        $this->assertInstanceOf(ListAddressesUseCaseOutputDTO::class, $result);
    }

    public function testItShouldListAddressesWithValidSortFields()
    {
        $addressRepositoryMock = $this->createMock(AddressRepositoryInterface::class);
        $addressRepositoryMock->expects($this->once())
            ->method('list')
            ->willReturn([]);

        $sortFields = [ ['fieldName' => 'cidade', 'priority' => 1, 'direction' => 'ASC']];
        $inputDTO = new ListAddressesUseCaseInputDTO($sortFields);

        $listAddressesUseCase = new ListAddressesUseCase($addressRepositoryMock);
        $result = $listAddressesUseCase->execute($inputDTO);

        $this->assertInstanceOf(ListAddressesUseCaseOutputDTO::class, $result);
    }

    public function testItShouldNotListAddressesWithInvalidSortField()
    {
        $this->expectException(\InvalidArgumentException::class);

        $sortFields = [['cidade', 'INVALID_DIRECTION', 1]];
        $inputDTO = new ListAddressesUseCaseInputDTO($sortFields);

        $addressRepositoryMock = $this->createMock(AddressRepositoryInterface::class);

        $listAddressesUseCase = new ListAddressesUseCase($addressRepositoryMock);
        $listAddressesUseCase->execute($inputDTO);
    }


}
