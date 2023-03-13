<?php

declare(strict_types=1);

namespace App\DTO;

use App\Enums\Currency;
use App\Enums\UserStatus;
use App\ValueObjects\Money;

class User
{
    public function __construct(
        public string $name,
        public string $phone,
        public UserStatus $status = UserStatus::Active,
        public Money $balance = new Money(0, Currency::NONE)
    ) {
    }
}
