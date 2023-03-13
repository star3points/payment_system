<?php

namespace App\Http\Requests\User;

use App\Enums\UserStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Enum;

class UserSetStatus extends FormRequest
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
            'status' => ['required', new Enum(UserStatus::class)]
        ];
    }
}
