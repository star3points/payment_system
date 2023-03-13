<?php

declare(strict_types=1);

namespace App\Enums;

enum Currency: string
{
    use EnumCasesValues;

    case NONE = '';
    case USD = 'USD';
    case RUB = 'RUB';
}
