<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLangRequest extends FormRequest
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
        return ([
            'lang' => 'required|in:ar,en',
        ]);
    }

    public function messages(): array
    {
        return [
            'lang.required' => __('lang.required'),
            'lang.in' => __('lang.in')
        ];
    }
}
