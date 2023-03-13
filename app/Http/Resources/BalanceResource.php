<?php

namespace App\Http\Resources;

use App\ValueObjects\Money;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Balance
 */
class BalanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'amount_cents' => $this->amount,
            'currency' => $this->currency,
            'formatted' => Money::createFromInt($this->amount, $this->currency)->format(),
            'transactions' => $this->whenLoaded('transactions', $this->transactions)
        ];
    }
}
