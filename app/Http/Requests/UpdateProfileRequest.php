<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email,' . $this->id,
            'city_id' => 'required|exists:cities,id',
            'address' => 'required|string',
            'avatar' => 'nullable|mimes:png,jpg,jpeg'
        ];
    }


    public function messages(): array
{
    return [
        'name.required' => __('name.required'),
        'name.string' => __('name.string'),
        'name.max' => __('name.max'),
        'email.required' => __('email.required'),
        'email.email' => __('email.email'),
        'email.unique' => __('email.unique'),
        'city_id.required' => __('city_id.required'),
        'city_id.exists' => __('city_id.exists'),
        'address.required' => __('address.required'),
        'address.string' => __('address.string'),
        'avatar.nullable' => __('avatar.nullable')
    ];
}
}
