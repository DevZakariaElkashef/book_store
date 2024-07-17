<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubjectRequest extends FormRequest
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
            'college_id' => 'required|exists:colleges,id',
            'university_id' => 'required|exists:universities,id',
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'is_active' => 'required|in:0,1'
        ];
    }

    public function messages(): array
    {
        return [
            'college_id.required' => __('validation.college_id.required'),
            'college_id.exists' => __('validation.college_id.exists'),
            'university_id.required' => __('validation.university_id.required'),
            'university_id.exists' => __('validation.university_id.exists'),
            'name_ar.required' => __('validation.name_ar.required'),
            'name_ar.string' => __('validation.name_ar.string'),
            'name_ar.max' => __('validation.name_ar.max'),
            'name_en.required' => __('validation.name_en.required'),
            'name_en.string' => __('validation.name_en.string'),
            'name_en.max' => __('validation.name_en.max'),
            'is_active.required' => __('validation.is_active.required'),
            'is_active.in' => __('validation.is_active.in')
        ];
    }
}
