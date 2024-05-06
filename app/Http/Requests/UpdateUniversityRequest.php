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
}
