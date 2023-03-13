<?php

use App\Enums\Currency;
use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use App\Models\Balance;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Balance::class);
            $table->enum('status', TransactionStatus::casesValues());
            $table->enum('type', TransactionType::casesValues());
            $table->integer('amount')
                ->comment('The value is indicated in conditional cents');
            $table->enum('currency', Currency::casesValues());
            $table->dateTime('date')->default(now());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
