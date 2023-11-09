<?php

namespace Tests\Domain\Address\Entity;

use App\Domain\address\entity\AddressEntity;
use App\Domain\address\value_object\ZipCodeValueObject;
use App\Domain\address\value_object\state\BrazilianStateValueObject;

use PHPUnit\Framework\TestCase;

class AddressTest extends TestCase
{
    public function test_it_should_address_with_valid_input()
    {
        $zipCode = new ZipCodeValueObject("12345678");
        $stateUF = new BrazilianStateValueObject("SC");
        $address = new AddressEntity(
            street: "Rua",
            number: "1",
            city: "Petrópolis",
            country: "Brasil",
            stateUF: $stateUF,
            zipCode: $zipCode
        );

        $this->assertInstanceOf(AddressEntity::class, $address);
        $this->assertInstanceOf(ZipCodeValueObject::class, $zipCode);
    }

    public function test_it_should_address_with_number_0_input()
    {
        $zipCode = new ZipCodeValueObject("12345678");
        $stateUF = new BrazilianStateValueObject("SC");
        $address = new AddressEntity(
            street: "Rua",
            number: "0",
            city: "Petrópolis",
            country: "Brasil",
            stateUF: $stateUF,
            zipCode: $zipCode
        );

        $this->assertInstanceOf(AddressEntity::class, $address);
        $this->assertInstanceOf(ZipCodeValueObject::class, $zipCode);
    }

    public function test_it_should_not_create_address_without_street()
    {
        $this->expectException(\InvalidArgumentException::class);

        $zipCode = new ZipCodeValueObject("12345678");
        $stateUF = new BrazilianStateValueObject("SC");
        $address = new AddressEntity(
            street: "",
            city: "Petrópolis",
            country: "Brasil",
            stateUF: $stateUF,
            zipCode: $zipCode
        );
    }

    public function test_it_should_not_create_address_without_city()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Validation errors: City name cannot be empty.");

        $zipCode = new ZipCodeValueObject("12345678");
        $stateUF = new BrazilianStateValueObject("SC");
        $address = new AddressEntity(
            zipCode: $zipCode,
            stateUF: $stateUF,
            street: "Rua Teste",
            city: "", // cidade vazia
            country: "Brasil",
            number: "123",
            complement: "Apto 101",
            district: "Centro"
        );
    }

    public function test_it_should_not_create_address_without_country()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Validation errors: Country name cannot be empty.");

        $zipCode = new ZipCodeValueObject("12345678");
        $stateUF = new BrazilianStateValueObject("SC");
        $address = new AddressEntity(
            zipCode: $zipCode,
            stateUF: $stateUF,
            street: "Rua Teste",
            city: "Petrópolis",
            country: "", // país vazio
            number: "123",
            complement: "Apto 101",
            district: "Centro"
        );
    }

    public function test_it_should_not_create_address_without_number_or_complement()
    {
        $this->expectException(\InvalidArgumentException::class);

        $zipCode = new ZipCodeValueObject("12345678");
        $stateUF = new BrazilianStateValueObject("SC");
        $address = new AddressEntity(
            street: "Rua",
            city: "Petrópolis",
            country: "Brasil",
            stateUF: $stateUF,
            zipCode: $zipCode,
        );
    }
}
