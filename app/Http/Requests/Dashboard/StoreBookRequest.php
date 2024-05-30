<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
            'college_id' => 'required|exists:colleges,id',
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'author_ar' => 'required|string|max:255',
            'author_en' => 'required|string|max:255',
            'price' => 'required|numeric|gt:0',
            'offer' => 'nullable|numeric|gt:0',
            'offer_start_at' => 'nullable|date',
            'offer_end_at' => 'nullable|date',
            'description_ar' => 'required|string|max:60000',
            'description_en' => 'required|string|max:60000',
            'is_active' => 'required|boolean',
            'is_new' => 'required|boolean',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:20480',
        ];
    }
}
