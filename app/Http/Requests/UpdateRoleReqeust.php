<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleReqeust extends FormRequest
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
            'name' => 'required|string|max:255|unique:roles,name,' . $this->id,
            'permissions' => 'required|array'
        ];
    }


    public function messages(): array
    {
        return [
            'name.required' => __('validation.name.required'),
            'name.string' => __('validation.name.string'),
            'name.max' => __('validation.name.max'),
            'name.unique' => __('validation.name.unique'),
            'permissions.required' => __('validation.permissions.required'),
            'permissions.array' => __('validation.permissions.array')
        ];
    }
}
