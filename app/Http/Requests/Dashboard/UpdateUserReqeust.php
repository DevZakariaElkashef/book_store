<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserReqeust extends FormRequest
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
            'name' => 'required|string|max:255|min:2',
            'email' => 'required|email|max:255|unique:users,email,' . $this->id,
            'phone' => 'nullable|string|max:255|unique:users,phone,' . $this->id,
            'password' => 'nullable|min:8|max:255|string',
            'is_active' => 'required|boolean',
            'avatar' => 'nullable|mimes:png,jpg|max:10000'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('validation.name.required'),
            'name.string' => __('validation.name.string'),
            'name.max' => __('validation.name.max'),
            'name.min' => __('validation.name.min'),
            'email.required' => __('validation.email.required'),
            'email.email' => __('validation.email.email'),
            'email.max' => __('validation.email.max'),
            'email.unique' => __('validation.email.unique'),
            'phone.string' => __('validation.phone.string'),
            'phone.max' => __('validation.phone.max'),
            'phone.unique' => __('validation.phone.unique'),
            'password.min' => __('validation.password.min'),
            'password.max' => __('validation.password.max'),
            'is_active.required' => __('validation.is_active.required'),
            'is_active.boolean' => __('validation.is_active.boolean'),
            'avatar.mimes' => __('validation.avatar.mimes'),
            'avatar.max' => __('validation.avatar.max'),
        ];
    }
}
