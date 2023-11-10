<?php

namespace Tests\UseCases;

use PHPUnit\Framework\TestCase;

use App\UseCases\ListAddressesUseCase;
use App\Domain\address\repository\AddressRepositoryInterface;
use App\Common\AbstractSortableField;
use App\Common\SortDirectionEnum;

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
        $result = $listAddressesUseCase->execute();

        $this->assertIsArray($result);
        $this->assertCount(0, $result);
    }

    public function testItShouldListAddressesWithValidSortFields()
    {
        $sortField = (new class('cidade', SortDirectionEnum::ASC, 1) extends AbstractSortableField
        {
        });

        $addressRepositoryMock = $this->createMock(AddressRepositoryInterface::class);
        $addressRepositoryMock->expects($this->once())
            ->method('list')
            ->with($this->equalTo($sortField))
            ->willReturn([]);

        $listAddressesUseCase = new ListAddressesUseCase($addressRepositoryMock);
        $result = $listAddressesUseCase->execute($sortField);

        $this->assertIsArray($result);
        $this->assertCount(0, $result);
    }
}
