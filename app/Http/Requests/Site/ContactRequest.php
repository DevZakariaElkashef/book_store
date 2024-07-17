<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email',
            'message' => 'required|string',
            'contact_type_id' => 'required|exists:contact_types,id'
        ];
    }


    public function messages(): array
    {
        return [
            'name.required' => __('validation.name.required'),
            'name.string' => __('validation.name.string'),
            'name.max' => __('validation.name.max'),
            'email.required' => __('validation.email.required'),
            'email.string' => __('validation.email.string'),
            'email.email' => __('validation.email.email'),
            'message.required' => __('validation.message.required'),
            'message.string' => __('validation.message.string'),
            'contact_type_id.required' => __('validation.contact_type_id.required'),
            'contact_type_id.exists' => __('validation.contact_type_id.exists')
        ];
    }
}
