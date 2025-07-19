<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobVacancyUpdateRequest extends FormRequest
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
            'title' => 'bail|required|string|max:255',
            'location' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',
            'type' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'category_id' => 'required|string|max:255',
            'company_id' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The job title is required.',
            'title.unique' => 'The job title has already been taken.',
            'title.max' => 'The job title must be less than 255 characters.',
            'title.string' => 'The job title must be a string.',
            'location.required' => 'The job location is required.',
            'location.max' => 'The job location must be less than 255 characters.',
            'location.string' => 'The job location must be a string.',
            'salary.required' => 'The job salary is required.',
            'salary.numeric' => 'The job salary must be a number.',
            'salary.min' => 'The job salary must be at least 0.',
            'type.required' => 'The job type is required.',
            'type.max' => 'The job type must be less than 255 characters.',
            'type.string' => 'The job type must be a string.',
            'description.required' => 'The job description is required.',
            'description.max' => 'The job description must be less than 255 characters.',
            'description.string' => 'The job description must be a string.',
            'category_id.required' => 'The job category is required.',
            'category_id.max' => 'The job category must be less than 255 characters.',
            'category_id.string' => 'The job category must be a string.',
            'company_id.required' => 'The company is required.',
            'company_id.max' => 'The company must be less than 255 characters.',
            'company_id.string' => 'The company must be a string.',
        ];
    }
}
