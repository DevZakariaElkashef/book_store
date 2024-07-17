<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class StoreAboutusRequest extends FormRequest
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
            'content_ar' => 'required|string|max:60000',
            'content_en' => 'required|string|max:60000',
            'is_active' => 'required|in:0,1',
            'image' => 'required|mimes:png,jpg,jpeg'
        ];
    }


    public function messages(): array
    {
        return [
            'content_ar.required' => __('validation.content_ar.required'),
            'content_ar.string' => __('validation.content_ar.string'),
            'content_ar.max' => __('validation.content_ar.max'),
            'content_en.required' => __('validation.content_en.required'),
            'content_en.string' => __('validation.content_en.string'),
            'content_en.max' => __('validation.content_en.max'),
            'is_active.required' => __('validation.is_active.required'),
            'is_active.in' => __('validation.is_active.in'),
            'image.required' => __('validation.image.required'),
            'image.mimes' => __('validation.image.mimes')
        ];
    }
}
