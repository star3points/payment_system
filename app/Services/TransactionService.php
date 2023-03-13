<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use App\Models\Transaction;
use App\Models\User;
use App\ValueObjects\Money;
use Illuminate\Support\Facades\DB;

class TransactionService
{
    public function create(User $user, TransactionType $type, Money $money): Transaction
    {
        return Transaction::create([
            'balance_id' => $user->balance->id,
            'status' => TransactionStatus::Processing->value,
            'type' => $type->value,
            'amount' => $money->amountCents,
            'currency' => $money->currency
        ]);
    }

    public function cancel(Transaction $transaction): void
    {
        if ($transaction->status === TransactionStatus::Processed->value) {
            DB::transaction(function () use ($transaction) {
                $balance = $transaction->balance;
                $type = TransactionType::tryFrom($transaction->type);
                $balance->amount = match ($type) {
                    TransactionType::Replenishment => $balance->amount - $transaction->amount,
                    TransactionType::Withdrawal => $balance->amount + $transaction->amount,
                    default => throw new \Exception('Transaction type not found')
                };
                $transaction->status = TransactionStatus::Cancelled->value;
                $balance->save();
                $transaction->save();
            });
        }
    }

    public function handle(Transaction $transaction): void
    {
        if ($transaction->status === TransactionStatus::Processing->value) {
            DB::transaction(function () use ($transaction) {
                $balance = $transaction->balance();
                $type = TransactionType::tryFrom($transaction->type);
                $balance->amount = match ($type) {
                    TransactionType::Replenishment => $balance->amount + $transaction->amount,
                    TransactionType::Withdrawal => $balance->amount - $transaction->amount,
                    default => throw new \Exception('Transaction type not found')
                };
                $transaction->status = TransactionStatus::Processed->value;
                $balance->save();
                $transaction->save();
            });
        }
    }
}
