<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Balance;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->has(
            Balance::factory()->has(
                Transaction::factory(5)
            )
        )->create([
            'name' => 'User User',
            'email' => 'mail@mail.com'
        ]);

        User::factory(100)->has(
            Balance::factory()->has(
                Transaction::factory(5)
            )
        )->create();
    }
}
