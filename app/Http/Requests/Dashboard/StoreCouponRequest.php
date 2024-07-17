<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class StoreCouponRequest extends FormRequest
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
            'code' => 'required|string|max:255',
            'discount' => 'required|numeric|max:100',
            'start_at' => 'nullable|date|after_or_equal:today',
            'end_at' => 'nullable|date|after_or_equal:start_at',
            'max_times' => 'required|integer',
            'is_active' => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => __('validation.code.required'),
            'code.string' => __('validation.code.string'),
            'code.max' => __('validation.code.max'),
            'discount.required' => __('validation.discount.required'),
            'discount.numeric' => __('validation.discount.numeric'),
            'discount.max' => __('validation.discount.max'),
            'start_at.date' => __('validation.start_at.date'),
            'start_at.after_or_equal' => __('validation.start_at.after_or_equal'),
            'end_at.date' => __('validation.end_at.date'),
            'end_at.after_or_equal' => __('validation.end_at.after_or_equal'),
            'max_times.required' => __('validation.max_times.required'),
            'max_times.integer' => __('validation.max_times.integer'),
            'is_active.required' => __('validation.is_active.required'),
            'is_active.boolean' => __('validation.is_active.boolean'),
        ];
    }

}
