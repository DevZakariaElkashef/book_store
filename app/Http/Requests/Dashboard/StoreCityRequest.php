<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class StoreCityRequest extends FormRequest
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
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'is_active' => 'required|boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'name_ar.required' => __('validation.name_ar.required'),
            'name_ar.string' => __('validation.name_ar.string'),
            'name_ar.max' => __('validation.name_ar.max'),
            'name_en.required' => __('validation.name_en.required'),
            'name_en.string' => __('validation.name_en.string'),
            'name_en.max' => __('validation.name_en.max'),
            'is_active.required' => __('validation.is_active.required'),
            'is_active.boolean' => __('validation.is_active.boolean'),
        ];
    }

    
}
