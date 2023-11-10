<?php

namespace App\Domain\address\entity;

use App\Domain\address\value_object\ZipCodeValueObject;
use App\Domain\address\value_object\state\AbstractStateValueObject;

class AddressEntity
{
    private string $street;
    private ?string $number;
    private ?string $complement;
    private ?string $district;
    private string $city;
    private AbstractStateValueObject $stateUF;
    private ZipCodeValueObject $zipCode;

    public function __construct(
        ZipCodeValueObject $zipCode,
        AbstractStateValueObject $stateUF,
        $street,
        $city,
        $number = '',
        $complement = '',
        $district = '',
    ) {

        $this->zipCode = $zipCode;
        $this->street = $street;
        $this->number = $number;
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

        $hasNumberOrComplement = $this->hasNumberOrComplement(number: $this->number, complement: $this->complement);

        if (!$hasNumberOrComplement) {
            $errors[] = 'Either house number or complement must be provided.';
        }

        if (!empty($errors)) {
            throw new \InvalidArgumentException("Validation errors: " . implode(' ', $errors));
        }

    }

    private function hasNumberOrComplement($number, $complement): bool
    {
        return $this->isPropertyNonEmpty($number) || $this->isPropertyNonEmpty($complement);
    }

    private function isPropertyNonEmpty($property): bool
    {
        return trim($property) !== '' && $property !== null;
    }

}
