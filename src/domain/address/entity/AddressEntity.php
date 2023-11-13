<?php

namespace App\Domain\address\entity;

use App\Domain\address\value_object\ZipCodeValueObject;
use App\Domain\address\value_object\state\AbstractStateValueObject;

class AddressEntity
{
    public string $street;
    public ?string $complement;
    public ?string $district;
    public string $city;
    public AbstractStateValueObject $stateUF;
    public ZipCodeValueObject $zipCode;

    public function __construct(
        ZipCodeValueObject $zipCode,
        AbstractStateValueObject $stateUF,
        $street,
        $city,
        $complement = '',
        $district = '',
    ) {

        $this->zipCode = $zipCode;
        $this->street = $street;
        $this->complement = $complement;
        $this->district = $district;
        $this->city = $city;
        $this->stateUF = $stateUF;

        $this->validate();
    }


    private function validate(): void
    {
        $errors = [];

        $nonEmptyProperties = [
            'street' => ['value' => $this->street, 'message' => 'Street address cannot be empty.'],
            'city' => ['value' => $this->city, 'message' => 'City name cannot be empty.'],
        ];

        foreach ($nonEmptyProperties as $property => $data) {
            if (!$this->isPropertyNonEmpty($data['value'])) {
                $errors[] = $data['message'];
            }
        }

        if (!empty($errors)) {
            throw new \InvalidArgumentException("Validation errors: " . implode(' ', $errors));
        }

    }

    private function isPropertyNonEmpty($property): bool
    {
        return trim($property) !== '' && $property !== null;
    }

}
