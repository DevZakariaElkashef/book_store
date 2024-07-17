<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ConfirmCodeRequest extends FormRequest
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
            'email' => 'required|exists:users,email',
            'otp' => 'required|array|size:4',
            'otp.*' => 'required|numeric'
        ];
    }


    public function messages(): array
    {
        return [
            'email.required' => __('email.required'),
            'email.exists' => __('email.exists'),
            'otp.required' => __('otp.required'),
            'otp.array' => __('otp.array'),
            'otp.size' => __('otp.size'),
            'otp.*.required' => __('otp.*.required'),
            'otp.*.numeric' => __('otp.*.numeric')
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        $firstError = $validator->errors()->first();

        $response = redirect()
            ->back()
            ->withInput()
            ->with('message', [
                'status' => false,
                'content' => $firstError,
            ]);

        throw new HttpResponseException($response);
    }
}
