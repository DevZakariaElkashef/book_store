<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUniversityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name_ar'  => 'required|string|max:255',
            'name_en'  => 'required|string|max:255',
            'description_ar'  => 'nullable|string|max:65535',
            'description_en'  => 'nullable|string|max:65535',
            'image' => 'nullable|file|mimes:png,jpg|max:10000'
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
            'description_ar.string' => __('description_ar.string'),
            'description_ar.max' => __('description_ar.max'),
            'description_en.string' => __('description_en.string'),
            'description_en.max' => __('description_en.max'),
            'image.nullable' => __('image.nullable'),
            'image.file' => __('image.file'),
            'image.mimes' => __('image.mimes'),
            'image.max' => __('image.max')
        ];
    }
}
