<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PayOrderRequest extends FormRequest
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
            'note' => 'nullable|string',
            'banktype' => 'required|in:0,1',
            'address' => 'required|string',
            'lat' => 'required',
            'lng' => 'required',
            'transfer_image' => 'required_if:banktype,1'
        ];
    }

    public function messages(): array
    {
        return [
            'note.string' => __('validation.note.string'),
            'banktype.required' => __('validation.banktype.required'),
            'banktype.in' => __('validation.banktype.in'),
            'address.required' => __('validation.address.required'),
            'address.string' => __('validation.address.string'),
            'lat.required' => __('validation.lat.required'),
            'lng.required' => __('validation.lng.required'),
            'transfer_image.required_if' => __('validation.transfer_image.required_if')
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
