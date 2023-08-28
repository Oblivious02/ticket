<?php

namespace App\Http\Requests\Verification;

use Illuminate\Foundation\Http\FormRequest;

class SendCodeRequest extends FormRequest
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
            'phone' => 'required_without:email|unique:verifications,phone',
            'dial_code' => 'required_with:phone',
            'email' => 'required_without:phone|email|unique:verifications,email',
        ];
    }

    public function prepareForValidation()
    {
        if ($this->get('phone')) {
            $phone = (string) ((int) $this->get('phone'));
            
            $this->merge(['phone' => $phone]);
        }
    }
}
