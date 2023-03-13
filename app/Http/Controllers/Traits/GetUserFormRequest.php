<?php

declare(strict_types=1);

namespace App\Http\Controllers\Traits;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

trait GetUserFormRequest
{
    protected function getUser(FormRequest $request): User|null
    {
        $userId = $request->validated('user_id');
        $phone = $request->validated('phone');
        return User::when($userId, function ($q, $userId) {
            $q->where('id', $userId);
        })->when($phone, function ($q, $phone) {
            $q->where('phone', $phone);
        })->first();
    }
}
