<?php

namespace Database\Factories;

use App\Enums\Currency;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Balance>
 */
class BalanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount' => fake()->numberBetween(100_00, 100_000_00),
            'currency' => Currency::NONE
        ];
    }
}
