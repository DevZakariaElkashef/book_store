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
            'subject_id' => 'required|exists:subjects,id',
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
            'qty' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:20480',
        ];
    }


    public function messages(): array
    {
        return [
            'subject_id.required' => __('subject_id.required'),
            'subject_id.exists' => __('subject_id.exists'),
            'name_ar.required' => __('name_ar.required'),
            'name_ar.string' => __('name_ar.string'),
            'name_ar.max' => __('name_ar.max'),
            'name_en.required' => __('name_en.required'),
            'name_en.string' => __('name_en.string'),
            'name_en.max' => __('name_en.max'),
            'author_ar.required' => __('author_ar.required'),
            'author_ar.string' => __('author_ar.string'),
            'author_ar.max' => __('author_ar.max'),
            'author_en.required' => __('author_en.required'),
            'author_en.string' => __('author_en.string'),
            'author_en.max' => __('author_en.max'),
            'price.required' => __('price.required'),
            'price.numeric' => __('price.numeric'),
            'price.gt' => __('price.gt'),
            'offer.numeric' => __('offer.numeric'),
            'offer.gt' => __('offer.gt'),
            'offer_start_at.date' => __('offer_start_at.date'),
            'offer_end_at.date' => __('offer_end_at.date'),
            'description_ar.required' => __('description_ar.required'),
            'description_ar.string' => __('description_ar.string'),
            'description_ar.max' => __('description_ar.max'),
            'description_en.required' => __('description_en.required'),
            'description_en.string' => __('description_en.string'),
            'description_en.max' => __('description_en.max'),
            'is_active.required' => __('is_active.required'),
            'is_active.boolean' => __('is_active.boolean'),
            'is_new.required' => __('is_new.required'),
            'is_new.boolean' => __('is_new.boolean'),
            'qty.required' => __('qty.required'),
            'qty.integer' => __('qty.integer'),
            'image.nullable' => __('image.nullable'),
            'image.image' => __('image.image'),
            'image.mimes' => __('image.mimes'),
            'image.max' => __('image.max'),
        ];
    }
}
