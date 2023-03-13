<?php

declare(strict_types=1);

namespace App\Enums;

enum TransactionStatus: string
{
    use EnumCasesValues;

    case Processing = 'Processing';
    case Processed = 'Processed';
    case Cancelled = 'Cancelled';
}
