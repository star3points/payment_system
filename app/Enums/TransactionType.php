<?php

declare(strict_types=1);

namespace App\Enums;

enum TransactionType: string
{
    use EnumCasesValues;

    case Withdrawal = 'Withdrawal';
    case Replenishment = 'Replenishment';
}
