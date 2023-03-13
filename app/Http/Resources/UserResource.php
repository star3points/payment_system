<?php

namespace App\Http\Resources;

use App\Models\User as UserModel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin UserModel
 */
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'status' => $this->status,
            'balance' => new BalanceResource($this->whenLoaded('balance'))
        ];
    }
}
