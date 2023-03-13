<?php

namespace App\Http\Requests\Transaction;

use App\Enums\Currency;
use App\Enums\TransactionType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Enum;

class TransactionCreate extends FormRequest
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
            'user_id' => [
                'required_without:phone',
                'prohibited_unless:phone,null',
                'exists:App\Models\User,id'
            ],
            'phone' => [
                'required_without:user_id',
                'prohibited_unless:user_id,null',
                'exists:App\Models\User,phone'
            ],
            'type' => ['required', new Enum(TransactionType::class)],
            'amount_cents' => 'required|integer|min:0|max:10000000',
            'currency' => [new Enum(Currency::class)]
        ];
    }
}
