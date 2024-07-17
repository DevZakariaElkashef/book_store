<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class StoreUniversityRequest extends FormRequest
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
            'description_ar' => 'required|string|max:60000',
            'description_en' => 'required|string|max:60000',
            'is_active' => 'required|boolean',
            'image' =>'nullable|image|mimes:jpeg,png,jpg|max:20480',
        ];
    }


    public function messages(): array
    {
        return [
            'name_ar.required' => __('name_ar.required'),
            'name_ar.string' => __('name_ar.string'),
            'name_ar.max' => __('name_ar.max'),
            'name_en.required' => __('name_en.required'),
            'name_en.string' => __('name_en.string'),
            'name_en.max' => __('name_en.max'),
            'description_ar.required' => __('description_ar.required'),
            'description_ar.string' => __('description_ar.string'),
            'description_ar.max' => __('description_ar.max'),
            'description_en.required' => __('description_en.required'),
            'description_en.string' => __('description_en.string'),
            'description_en.max' => __('description_en.max'),
            'is_active.required' => __('is_active.required'),
            'is_active.boolean' => __('is_active.boolean'),
            'image.mimes' => __('image.mimes'),
            'image.max' => __('image.max'),
        ];
    }
}
