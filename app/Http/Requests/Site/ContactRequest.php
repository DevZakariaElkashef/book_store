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
            'name.required' => __('name.required'),
            'name.string' => __('name.string'),
            'name.max' => __('name.max'),
            'email.required' => __('email.required'),
            'email.string' => __('email.string'),
            'email.email' => __('email.email'),
            'message.required' => __('message.required'),
            'message.string' => __('message.string'),
            'contact_type_id.required' => __('contact_type_id.required'),
            'contact_type_id.exists' => __('contact_type_id.exists')
        ];
    }
}
