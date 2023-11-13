<?php

namespace App\UseCases\store_address;

class StoreAddressUseCaseInputDTO
{
    public string $zipCode;
    public string $stateUF;
    public string $street;
    public string $city;
    public string $complement;
    public string $district;

    public function __construct(
        string $zipCode,
        string $stateUF,
        string $street,
        string $city,
        string $complement = null,
        string $district = null,
    ) {
        $this->zipCode = $zipCode;
        $this->stateUF = $stateUF;
        $this->street = $street;
        $this->city = $city;
        $this->complement = $complement;
        $this->district = $district;
    }
}
