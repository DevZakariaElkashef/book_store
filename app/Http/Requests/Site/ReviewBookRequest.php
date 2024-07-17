<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ReviewBookRequest extends FormRequest
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
            'order_item_id' => 'required|exists:order_items,id',
            'star' => 'required|integer|lt:6|gt:0',
            'comment' => 'required|string'
        ];
    }


    public function messages(): array
    {
        return [
            'order_item_id.required' => __('validation.order_item_id.required'),
            'order_item_id.exists' => __('validation.order_item_id.exists'),
            'star.required' => __('validation.star.required'),
            'star.integer' => __('validation.star.integer'),
            'star.lt' => __('validation.star.lt'),
            'star.gt' => __('validation.star.gt'),
            'comment.required' => __('validation.comment.required'),
            'comment.string' => __('validation.comment.string')
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
