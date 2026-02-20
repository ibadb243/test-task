<?php

namespace App\Http\Requests\Resume;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'full_name' => 'sometimes|required|string|max:255',
            'email'     => 'sometimes|required|email|max:255',
            'phone'     => 'sometimes|required|string|max:50',
            'position'  => 'sometimes|required|string|max:255',
            'category'  => 'sometimes|required|string',
            'description' => 'sometimes|required|string|max:4096',
            'salary'    => 'nullable|numeric|min:0',
            'education' => 'sometimes|required|in:none,high_school,bachelor,master,phd',
            'experience' => 'sometimes|required|in:none,junior,mid,senior',
            'skills'    => 'nullable|array',
        ];
    }
}
