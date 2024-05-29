<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserReqeust extends FormRequest
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
            'name' => 'required|string|max:255|min:2',
            'email' => 'required|email|max:255|unique:users,email,' . $this->id,
            'phone' => 'nullable|string|max:255|unique:users,phone,' . $this->id,
            'password' => 'nullable|min:8|max:255|string',
            'is_active' => 'required|boolean',
            'avatar' => 'nullable|mimes:png,jpg|max:10000'
        ];
    }
}
