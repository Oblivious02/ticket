<?php

namespace App\Http\Requests\Verification;

use Illuminate\Foundation\Http\FormRequest;

class VerifyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'otp' => 'required|exists:verifications,otp|numeric',
            'phone' => 'required_without:email|exists:verifications,phone',
            'dial_code' => 'required_with:phone',
            'email' => 'required_without:phone|email|exists:verifications,email',
        ];
    }
}
