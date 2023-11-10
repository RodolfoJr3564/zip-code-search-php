<?php

namespace App\UseCases;

use App\Domain\address\repository\AddressRepositoryInterface;

class StoreXMLAddressUseCase
{
    private AddressRepositoryInterface $addressRepository;

    public function __construct(AddressRepositoryInterface $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    public function execute(string $xml): array
    {
        $xml = simplexml_load_string($xml);
        $json = json_encode($xml);
        $array = json_decode($json, true);
        $address = $this->addressRepository->save($array);
        return $address;
    }
}
