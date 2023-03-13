<?php

namespace App\Http\Controllers;

use App\Enums\TransactionType;
use App\Http\Controllers\Traits\GetUserFormRequest;
use App\Http\Requests\Transaction\TransactionCancel;
use App\Http\Requests\Transaction\TransactionCreate;
use App\Http\Requests\Transaction\TransactionHandle;
use App\Http\Requests\Transaction\TransactionIndex;
use App\Http\Resources\TransactionResource;
use App\Models\Balance;
use App\Models\Transaction;
use App\Services\TransactionService;
use App\ValueObjects\Money;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionController extends Controller
{
    use GetUserFormRequest;

    public function index(TransactionIndex $request): JsonResource
    {
        $user = $this->getUser($request);
        $transactions = $user->balance->transactions()
            ->whereBetween('created_at', [
                    $request->validated('date_from'),
                    $request->validated('date_to')
                ]
            )->get();
        return TransactionResource::collection($transactions);
    }

    public function create(TransactionCreate $request): JsonResource
    {
        $user = $this->getUser($request);
        $type = TransactionType::tryFrom($request->validated('type')) ?? TransactionType::Replenishment;
        $money = Money::createFromInt(
            $request->validated('amount_cents'),
            $request->validated('currency')
        );
        $transaction = app(TransactionService::class)->create($user, $type, $money);
        return new TransactionResource($transaction);
    }

    public function handle(TransactionHandle $request): void
    {
        $transaction = Transaction::find($request->validated('transaction_id'));
        app(TransactionService::class)->handle($transaction);
    }

    public function cancel(TransactionCancel $request): void
    {
        $transaction = Transaction::find($request->validated('transaction_id'));
        app(TransactionService::class)->cancel($transaction);
    }
}
