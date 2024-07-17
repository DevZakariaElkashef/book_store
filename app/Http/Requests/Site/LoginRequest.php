<?php

namespace App\Http\Requests\Site;

use App\Rules\MatchPassword;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            "email" => "required|email|exists:users,email",
            'password' => ['required', new MatchPassword($this->email)],
        ];
    }


    public function messages(): array
    {
        return [
            'email.required' => __('validation.email.required'),
            'email.email' => __('validation.email.email'),
            'email.exists' => __('validation.email.exists'),
            'password.required' => __('validation.password.required'),
            'password.match_password' => __('validation.password.match_password')
        ];
    }
}
