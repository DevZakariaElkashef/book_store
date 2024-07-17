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
        'name.required' => __('validation.name.required'),
        'name.string' => __('validation.name.string'),
        'name.max' => __('validation.name.max'),
        'email.required' => __('validation.email.required'),
        'email.email' => __('validation.email.email'),
        'email.unique' => __('validation.email.unique'),
        'city_id.required' => __('validation.city_id.required'),
        'city_id.exists' => __('validation.city_id.exists'),
        'address.required' => __('validation.address.required'),
        'address.string' => __('validation.address.string'),
        'avatar.nullable' => __('validation.avatar.nullable')
    ];
}
}
