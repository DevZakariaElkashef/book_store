<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePageRequest extends FormRequest
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
            'value_ar' => 'required|string',
            'value_en' => 'required|string',
        ];
    }


    public function messages(): array
    {
        return [
            'value_ar.required' => __('validation.value_ar.required'),
            'value_ar.string' => __('validation.value_ar.string'),
            'value_en.required' => __('validation.value_en.required'),
            'value_en.string' => __('validation.value_en.string'),
        ];
    }
}
