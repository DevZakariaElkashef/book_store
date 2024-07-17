<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|unique:users,email',
            'password' => 'required|string|min:8',
            'term' => 'required',
            'avatar' => 'nullable|mimes:png,jpg,jpeg|max:10000'
        ];
    }


    public function messages(): array
    {
        return [
            'name.required' => __('name.required'),
            'name.string' => __('name.string'),
            'name.max' => __('name.max'),
            'email.required' => __('email.required'),
            'email.unique' => __('email.unique'),
            'password.required' => __('password.required'),
            'password.string' => __('password.string'),
            'password.min' => __('password.min'),
            'term.required' => __('term.required'),
            'avatar.mimes' => __('avatar.mimes'),
            'avatar.max' => __('avatar.max')
        ];
    }
}
