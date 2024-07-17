<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
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
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'lat' => 'required|string|max:255',
            'lng' => 'required|string|max:255',
            'slogan_ar' => 'required|string|max:255',
            'slogan_en' => 'required|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'google' => 'nullable|string|max:255',
            'logo' => 'nullable|mimes:png,jpg,jpeg',
        ];
    }

    public function messages(): array
    {
        return [
            'name_ar.required' => __('validation.name_ar.required'),
            'name_ar.string' => __('validation.name_ar.string'),
            'name_ar.max' => __('validation.name_ar.max'),
            'name_en.required' => __('validation.name_en.required'),
            'name_en.string' => __('validation.name_en.string'),
            'name_en.max' => __('validation.name_en.max'),
            'email.required' => __('validation.email.required'),
            'email.email' => __('validation.email.email'),
            'email.max' => __('validation.email.max'),
            'phone.required' => __('validation.phone.required'),
            'phone.string' => __('validation.phone.string'),
            'phone.max' => __('validation.phone.max'),
            'address.required' => __('validation.address.required'),
            'address.string' => __('validation.address.string'),
            'address.max' => __('validation.address.max'),
            'lat.required' => __('validation.lat.required'),
            'lat.string' => __('validation.lat.string'),
            'lat.max' => __('validation.lat.max'),
            'lng.required' => __('validation.lng.required'),
            'lng.string' => __('validation.lng.string'),
            'lng.max' => __('validation.lng.max'),
            'slogan_ar.required' => __('validation.slogan_ar.required'),
            'slogan_ar.string' => __('validation.slogan_ar.string'),
            'slogan_ar.max' => __('validation.slogan_ar.max'),
            'slogan_en.required' => __('validation.slogan_en.required'),
            'slogan_en.string' => __('validation.slogan_en.string'),
            'slogan_en.max' => __('validation.slogan_en.max'),
            'facebook.string' => __('validation.facebook.string'),
            'facebook.max' => __('validation.facebook.max'),
            'instagram.string' => __('validation.instagram.string'),
            'instagram.max' => __('validation.instagram.max'),
            'twitter.string' => __('validation.twitter.string'),
            'twitter.max' => __('validation.twitter.max'),
            'google.string' => __('validation.google.string'),
            'google.max' => __('validation.google.max'),
            'logo.mimes' => __('validation.logo.mimes'),
            'logo.max' => __('validation.logo.max'),
        ];
    }
}
