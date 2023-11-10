<?php

namespace App\Common;

enum SortDirectionEnum: string
{
    case ASC = 'ASC';
    case DESC = 'DESC';

    public static function toMap(): array
    {
        $array = [];
        foreach (self::cases() as $case) {
            $array[$case->name] = $case->value;
        }

        return $array;
    }
}
