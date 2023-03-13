<?php

namespace App\Rules;

use App\Enums\UserStatus;
use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UserNotBlocked implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $modelAttribute = match ($attribute) {
            'user_id' => 'id',
            'phone' => 'phone'
        };
        $user = User::where($modelAttribute, $value)->first();
        if ($user->status === UserStatus::Blocked->value) {
            $fail("User {$attribute} - {$value} is blocked");
        }
    }
}
