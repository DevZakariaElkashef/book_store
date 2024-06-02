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
}
