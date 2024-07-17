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
            'subject_id.required' => __('validation.subject_id.required'),
            'subject_id.exists' => __('validation.subject_id.exists'),
            'name_ar.required' => __('validation.name_ar.required'),
            'name_ar.string' => __('validation.name_ar.string'),
            'name_ar.max' => __('validation.name_ar.max'),
            'name_en.required' => __('validation.name_en.required'),
            'name_en.string' => __('validation.name_en.string'),
            'name_en.max' => __('validation.name_en.max'),
            'author_ar.required' => __('validation.author_ar.required'),
            'author_ar.string' => __('validation.author_ar.string'),
            'author_ar.max' => __('validation.author_ar.max'),
            'author_en.required' => __('validation.author_en.required'),
            'author_en.string' => __('validation.author_en.string'),
            'author_en.max' => __('validation.author_en.max'),
            'price.required' => __('validation.price.required'),
            'price.numeric' => __('validation.price.numeric'),
            'price.gt' => __('validation.price.gt'),
            'offer.numeric' => __('validation.offer.numeric'),
            'offer.gt' => __('validation.offer.gt'),
            'offer_start_at.date' => __('validation.offer_start_at.date'),
            'offer_end_at.date' => __('validation.offer_end_at.date'),
            'description_ar.required' => __('validation.description_ar.required'),
            'description_ar.string' => __('validation.description_ar.string'),
            'description_ar.max' => __('validation.description_ar.max'),
            'description_en.required' => __('validation.description_en.required'),
            'description_en.string' => __('validation.description_en.string'),
            'description_en.max' => __('validation.description_en.max'),
            'is_active.required' => __('validation.is_active.required'),
            'is_active.boolean' => __('validation.is_active.boolean'),
            'is_new.required' => __('validation.is_new.required'),
            'is_new.boolean' => __('validation.is_new.boolean'),
            'qty.required' => __('validation.qty.required'),
            'qty.integer' => __('validation.qty.integer'),
            'image.nullable' => __('validation.image.nullable'),
            'image.image' => __('validation.image.image'),
            'image.mimes' => __('validation.image.mimes'),
            'image.max' => __('validation.image.max'),
        ];
    }
}
