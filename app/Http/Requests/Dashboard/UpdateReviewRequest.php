<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReviewRequest extends FormRequest
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
            'star' => 'required|integer|lt:6|gt:0',
            'comment' => 'required|string'
        ];
    }

    public function messages(): array
    {
        return [
            'star.required' => __('validation.star.required'),
            'star.integer' => __('validation.star.integer'),
            'star.lt' => __('validation.star.lt'),
            'star.gt' => __('validation.star.gt'),
            'comment.required' => __('validation.comment.required'),
            'comment.string' => __('validation.comment.string'),
        ];
    }



}
