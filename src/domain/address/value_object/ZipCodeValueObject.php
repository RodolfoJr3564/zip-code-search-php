<?php

namespace App\Domain\address\value_object;

class ZipCodeValueObject
{
    public string $zipCode;

    public function __construct(string $zipCode)
    {
        $this->zipCode = $zipCode;
        $this->validate();
    }

    private function validate(): void
    {
        if(empty(trim($this->zipCode))) {
            throw new \InvalidArgumentException("The provided zip code is invalid or missing.");
        }
    }
}
