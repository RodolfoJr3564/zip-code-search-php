<?php

namespace App\Domain\address\value_object;

class ZipCodeValueObject
{
    private string $zipCode;

    public function __construct($zipCode)
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
