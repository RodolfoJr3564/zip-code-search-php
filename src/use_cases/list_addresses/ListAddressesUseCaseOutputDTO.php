<?php

namespace App\UseCases\list_addresses;

class ListAddressesUseCaseOutputDTO
{
    /**
     * @var Address[]
     */
    public array $addresses;

    /**
     * @param Address[]
     */
    public function __construct(array $addresses)
    {
        $this->addresses = $addresses;
    }
}
