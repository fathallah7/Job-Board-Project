<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'password' => 'nullable|required|string|min:8|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'password.required'=> 'The Password is Required',
            'password.min' => 'The password must be at least 8 characters.',
            'password.max' => 'The password must be less than 255 characters.',
        ];
    }
}
