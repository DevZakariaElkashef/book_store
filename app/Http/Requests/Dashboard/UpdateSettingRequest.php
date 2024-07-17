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
            'name_ar.required' => __('name_ar.required'),
            'name_ar.string' => __('name_ar.string'),
            'name_ar.max' => __('name_ar.max'),
            'name_en.required' => __('name_en.required'),
            'name_en.string' => __('name_en.string'),
            'name_en.max' => __('name_en.max'),
            'email.required' => __('email.required'),
            'email.email' => __('email.email'),
            'email.max' => __('email.max'),
            'phone.required' => __('phone.required'),
            'phone.string' => __('phone.string'),
            'phone.max' => __('phone.max'),
            'address.required' => __('address.required'),
            'address.string' => __('address.string'),
            'address.max' => __('address.max'),
            'lat.required' => __('lat.required'),
            'lat.string' => __('lat.string'),
            'lat.max' => __('lat.max'),
            'lng.required' => __('lng.required'),
            'lng.string' => __('lng.string'),
            'lng.max' => __('lng.max'),
            'slogan_ar.required' => __('slogan_ar.required'),
            'slogan_ar.string' => __('slogan_ar.string'),
            'slogan_ar.max' => __('slogan_ar.max'),
            'slogan_en.required' => __('slogan_en.required'),
            'slogan_en.string' => __('slogan_en.string'),
            'slogan_en.max' => __('slogan_en.max'),
            'facebook.string' => __('facebook.string'),
            'facebook.max' => __('facebook.max'),
            'instagram.string' => __('instagram.string'),
            'instagram.max' => __('instagram.max'),
            'twitter.string' => __('twitter.string'),
            'twitter.max' => __('twitter.max'),
            'google.string' => __('google.string'),
            'google.max' => __('google.max'),
            'logo.mimes' => __('logo.mimes'),
            'logo.max' => __('logo.max'),
        ];
    }
}
