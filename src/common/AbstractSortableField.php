<?php

namespace App\Common;

use App\Common\SortDirectionEnum;

abstract class AbstractSortableField
{
    public string $fieldName;
    public int $priority;
    public SortDirectionEnum $direction;

    public function __construct(string $fieldName, SortDirectionEnum $direction, int $priority)
    {
        $this->fieldName = $fieldName;
        $this->direction = $direction;
        $this->priority = $priority;
    }
}
