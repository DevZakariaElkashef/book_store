<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class UpdateShippingRequest extends FormRequest
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
            'use_shiping' => 'nullable',
            'free_distance' => 'required_if:use_shipping',
            'cost_per_km' => 'required_if:use_shipping',
            'non_operational_distance' => 'required_if:use_shipping',
            'expected_order_delivered' => 'required',
        ];
    }
}
