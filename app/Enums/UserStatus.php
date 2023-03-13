<?php

declare(strict_types=1);

namespace App\Enums;

enum UserStatus: string
{
    use EnumCasesValues;

    case Active = 'Active';
    case Blocked = 'Blocked';
}
