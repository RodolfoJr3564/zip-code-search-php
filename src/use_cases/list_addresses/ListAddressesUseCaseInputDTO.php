<?php

namespace App\UseCases\list_addresses;

class ListAddressesUseCaseInputDTO
{
    /**
     * @var array<array{fieldName: string, priority: int, direction: string}>
     */
    public array $sortFields;


    /**
     * @param array<array{fieldName: string, priority: int, direction: string}>
     */
    public function __construct($sortFields = [])
    {
        $this->sortFields = $sortFields;
    }
}
