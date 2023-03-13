<?php

declare(strict_types=1);

namespace App\ValueObjects;

use App\Enums\Currency;
use App\Models\Balance;
use Illuminate\Support\Str;

class Money
{
    public function __construct(
        public int $amountCents = 0,
        public Currency $currency = Currency::NONE
    ) {
    }

    public static function createFromBalance(Balance $balance): static
    {
        return new static (
            amountCents: $balance->amount,
            currency: Currency::tryFrom($balance->currency)
        );
    }

    public static function createFromInt(int $intCents, string $currency): static
    {
        return new static (
            amountCents: $intCents,
            currency: Currency::tryFrom(Str::upper($currency)) ?? Currency::NONE
        );
    }

    public static function createFromFloat(float $floatDollars, string $currency): static
    {
        return new static (
            amountCents: (int)($floatDollars * 100),
            currency: Currency::tryFrom(Str::upper($currency)) ?? Currency::NONE
        );
    }

    public function format(): string
    {
        return (string)($this->amountCents / 100) . $this->currency->value;
    }
}
