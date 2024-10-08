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
            'old_password.required' => __('old_password.required'),
            'new_password.required' => __('new_password.required'),
            'new_password.string' => __('new_password.string'),
            'new_password.max' => __('new_password.max'),
            'new_password.same' => __('new_password.same'),
            'new_password.different' => __('new_password.different'),
        ];
    }
}
