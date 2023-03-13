<?php

declare(strict_types=1);

namespace App\Enums;

trait EnumCasesValues
{
    public static function casesValues(): array
    {
        return array_column(self::cases(), 'value');
    }
}
