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
            'order_item_id.required' => __('order_item_id.required'),
            'order_item_id.exists' => __('order_item_id.exists'),
            'star.required' => __('star.required'),
            'star.integer' => __('star.integer'),
            'star.lt' => __('star.lt'),
            'star.gt' => __('star.gt'),
            'comment.required' => __('comment.required'),
            'comment.string' => __('comment.string')
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
