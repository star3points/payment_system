<?php

namespace Database\Factories;

use App\Enums\Currency;
use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => fake()->randomElement(TransactionStatus::casesValues()),
            'type' => fake()->randomElement(TransactionType::casesValues()),
            'amount' => fake()->numberBetween(100_00, 100_000_00),
            'currency' => Currency::NONE,
            'date' => fake()->dateTime()
        ];
    }
}
