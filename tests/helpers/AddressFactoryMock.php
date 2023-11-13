<?php

namespace Tests\Helpers;

use App\Domain\address\entity\AddressEntity;
use App\Domain\address\value_object\ZipCodeValueObject;
use App\Domain\address\value_object\state\BrazilianStateValueObject;

class AddressFactoryMock
{
    public static function create(array $overrideProperties = []): AddressEntity
    {
        $defaults = [
            'zipCode' => '12345-678',
            'stateUF' => 'SC',
            'street' => 'Main St',
            'city' => 'Anytown',
            'complement' => 'Apt 101',
            'district' => 'Central',
        ];

        $properties = array_merge($defaults, $overrideProperties);

        $zipCode = new ZipCodeValueObject($properties['zipCode']);
        $stateUF = new BrazilianStateValueObject($properties['stateUF']);

        return new AddressEntity(
            zipCode: $zipCode,
            stateUF: $stateUF,
            street: $properties['street'],
            city: $properties['city'],
            complement: $properties['complement'],
            district: $properties['district']
        );
    }
}
