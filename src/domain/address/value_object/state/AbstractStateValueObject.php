<?php

namespace App\Domain\address\value_object\state;

abstract class AbstractStateValueObject
{
    public string $uf;
    public string $stateName;

    public function __construct(string $uf, string $stateName)
    {
        $this->uf = $uf;
        $this->stateName = $stateName;
    }
}
