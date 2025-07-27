<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobVacancyResumeRequest extends FormRequest
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
            'resume' => 'required|mimes:pdf|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'resume.required' => 'The Resume is required.',
            'resume.max' => 'Max is 2mb.',
            'resume.mimes' => 'Pdf Only.',
        ];
    }

}
