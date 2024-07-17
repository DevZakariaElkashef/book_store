<?php

namespace App\Http\Requests\Site;

use App\Rules\MatchOldPassword;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
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
            'old_password' => ['required', new MatchOldPassword()],
            'new_password' => 'required|string|max:255|same:confirm_password|different:old_password',
        ];
    }


    public function messages(): array
    {
        return [
            'old_password.required' => __('validation.old_password.required'),
            'new_password.required' => __('validation.new_password.required'),
            'new_password.string' => __('validation.new_password.string'),
            'new_password.max' => __('validation.new_password.max'),
            'new_password.same' => __('validation.new_password.same'),
            'new_password.different' => __('validation.new_password.different'),
        ];
    }
}
