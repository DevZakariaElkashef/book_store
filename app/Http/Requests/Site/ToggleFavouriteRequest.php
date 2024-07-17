<?php

namespace App\Http\Requests\Site;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ToggleFavouriteRequest extends FormRequest
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
            'book_id' => 'required|exists:books,id'
        ];
    }


    public function messages(): array
    {
        return [
            'book_id.required' => __('book_id.required'),
            'book_id.exists' => __('book_id.exists')
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
