<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class StoreCollegeRequest extends FormRequest
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
            'university_id' => 'required|exists:universities,id',
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_ar' => 'required|string|max:60000',
            'description_en' => 'required|string|max:60000',
            'is_active' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:20480',
        ];
    }

    public function messages(): array
    {
        return [
            'university_id.required' => __('validation.university_id.required'),
            'university_id.exists' => __('validation.university_id.exists'),
            'name_ar.required' => __('validation.name_ar.required'),
            'name_ar.string' => __('validation.name_ar.string'),
            'name_ar.max' => __('validation.name_ar.max'),
            'name_en.required' => __('validation.name_en.required'),
            'name_en.string' => __('validation.name_en.string'),
            'name_en.max' => __('validation.name_en.max'),
            'description_ar.required' => __('validation.description_ar.required'),
            'description_ar.string' => __('validation.description_ar.string'),
            'description_ar.max' => __('validation.description_ar.max'),
            'description_en.required' => __('validation.description_en.required'),
            'description_en.string' => __('validation.description_en.string'),
            'description_en.max' => __('validation.description_en.max'),
            'is_active.required' => __('validation.is_active.required'),
            'is_active.boolean' => __('validation.is_active.boolean'),
            'image.nullable' => __('validation.image.nullable'),
            'image.image' => __('validation.image.image'),
            'image.mimes' => __('validation.image.mimes'),
            'image.max' => __('validation.image.max'),
        ];
    }
}
