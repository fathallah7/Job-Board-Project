<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobCategoryRequest extends FormRequest
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
            "name" => "required|string|max:255|unique:job_category,name",
        ];
    }

    public function messages(): array
    {
        return [
            "name.required" => "The Name Is Required",
            "name.unique" => "The Name has already been Taken",
            "name.string" => "The Name Must be String",
            "name.max" => "Max 255",
        ];
    }
}
