<?php

namespace App\Http\Requests\User;

use App\DTO\User;
use App\Enums\Currency;
use App\Enums\UserStatus;
use App\Rules\NameRule;
use App\Rules\PhoneRule;
use App\ValueObjects\Money;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Enum;

class UserRegister extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', new NameRule()],
            'phone' => ['required', 'string', 'unique:App\Models\User,phone', new PhoneRule()],
            'balance' => 'nullable|integer|min:-10000000|max:10000000',
            'currency' => ['nullable', new Enum(Currency::class)],
            'status' => ['nullable', new Enum(UserStatus::class)]
        ];
    }

    public function toDTO(): User
    {
        return new User(
            name: $this->validated('name'),
            phone: $this->validated('phone'),
            status: UserStatus::tryFrom($this->validated('status')) ?? UserStatus::Active,
            balance: Money::createFromInt(
                intCents: $this->validated('balance') ?? 0,
                currency: $this->validated('currency') ?? ''
            )
        );
    }
}
