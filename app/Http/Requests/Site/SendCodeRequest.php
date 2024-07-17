<?php

namespace App\Http\Requests\Site;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|exists:users,email'
        ];
    }


    public function messages(): array
    {
        return [
            'email.required' => __('email.required'),
            'email.exists' => __('email.exists')
        ];
    }
}
