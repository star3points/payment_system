<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\User as UserDTO;
use App\Enums\UserStatus;
use App\Models\Balance;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserService
{
    public function register(UserDTO $user)
    {
        DB::transaction(function () use ($user) {
            $userModel = User::create([
                'name' => $user->name,
                'phone' => $user->phone,
                'status' => $user->status->value,
            ]);
            $userModel->balance()->save(
                new Balance([
                    'amount' => $user->balance->amountCents,
                    'currency' => $user->balance->currency->value
                ])
            );
        });
    }

    public function setStatus(User $user, UserStatus $status)
    {
        $user->status = $status->value;
        $user->save();
    }
}
