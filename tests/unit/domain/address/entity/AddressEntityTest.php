<?php

namespace Tests\Domain\Address\Entity;

use App\Domain\address\entity\AddressEntity;
use Tests\Helpers\AddressFactoryMock;
use App\Domain\address\value_object\ZipCodeValueObject;
use App\Domain\address\value_object\state\BrazilianStateValueObject;

use PHPUnit\Framework\TestCase;

class AddressEntityTest extends TestCase
{
    public function test_it_should_address_with_valid_input()
    {
        $address = AddressFactoryMock::create();
        $this->assertInstanceOf(AddressEntity::class, $address);
    }

    public function test_it_should_address_with_number_0_input()
    {
        $address = AddressFactoryMock::create(["number" => "0"]);
        $this->assertInstanceOf(AddressEntity::class, $address);
    }

    public function test_it_should_not_create_address_with_invalid_zipcode()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("The provided zip code is invalid or missing.");
        new ZipCodeValueObject("");
    }

    public function test_it_should_not_create_address_with_invalid_stateUF()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("The provided brazilian state is invalid or missing.");
        new BrazilianStateValueObject("InvalidStateUF");
    }

    public function test_it_should_not_create_address_without_street()
    {
        $this->expectException(\InvalidArgumentException::class);

        $address = AddressFactoryMock::create(["street" => ""]);
        $this->assertInstanceOf(AddressEntity::class, $address);
    }

    public function test_it_should_not_create_address_without_city()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Validation errors: City name cannot be empty.");

        AddressFactoryMock::create(["city" => ""]);
    }

    public function test_it_should_not_create_address_without_country()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Validation errors: Country name cannot be empty.");

        AddressFactoryMock::create(["country" => ""]);
    }

    public function test_it_should_not_create_address_without_number_or_complement()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Validation errors: Either house number or complement must be provided.");

        AddressFactoryMock::create(["number" => "", "complement" => ""]);
    }
}
