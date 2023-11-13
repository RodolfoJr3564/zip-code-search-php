<?php

namespace App\UseCases\list_addresses;

use App\Domain\address\entity\AddressEntity;

class ListAddressesUseCaseOutputDTO
{
    /**
     * @var AddressEntity[]
     */
    public array $addresses;

    /**
     * @param AddressEntity[]
     */
    public function __construct(array $addresses)
    {
        $this->addresses = $addresses;
    }
}
