<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetAdminPassword extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'token' => 'required|string|exists:password_reset_tokens,token',
            'password' => 'required|min:8|max:255|same:confirm-password'
        ];
    }

    public function messages()
    {
        return [
            'token.exists' => __('Token Expire')
        ];
    }
}
