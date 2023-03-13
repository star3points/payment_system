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
        User::factory(100)->has(
            Balance::factory()->has(
                Transaction::factory(5)
            )
        )->create();

        // \App\Models\UserResource::factory()->create([
        //     'name' => 'Test UserResource',
        //     'email' => 'test@example.com',
        // ]);
    }
}
