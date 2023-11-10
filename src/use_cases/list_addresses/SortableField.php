<?php

namespace App\UseCases\list_addresses;

use App\Common\AbstractSortableField;
use App\Common\SortDirectionEnum;

class SortableField extends AbstractSortableField
{
    /**
     * @param string $fieldName
     * @param string $direction
     * @param int $priority
     */
    public function __construct(string $fieldName, string $direction, int $priority)
    {
        $sortDirection = SortDirectionEnum::toMap()[$direction];

        if(!$sortDirection) {
            throw new \InvalidArgumentException("The provided sort direction is invalid or missing.");
        }

        parent::__construct(fieldName: $fieldName, direction:  SortDirectionEnum::from($sortDirection), priority: $priority);
    }
}
