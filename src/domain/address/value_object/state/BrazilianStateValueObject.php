<?php

namespace App\Domain\address\value_object\state;

use App\Domain\address\value_object\state\BrazilianStateEnum;

class BrazilianStateValueObject extends AbstractStateValueObject
{
    public function __construct(string $uf)
    {
        $stateName = $this->getStateName(uf: $uf);

        if(!$stateName) {
            throw new \InvalidArgumentException("The provided brazilian state is invalid or missing.");
        }

        parent::__construct(uf: $uf, stateName: $stateName);
    }

    private function getStateName($uf): ?string
    {
        $statesMap = BrazilianStateEnum::toMap();
        return $statesMap[$uf] ?? null;
    }
}
