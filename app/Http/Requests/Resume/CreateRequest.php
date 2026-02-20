<?php

namespace App\Http\Requests\Resume;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'full_name' => 'required|string|max:255',
            'email'     => 'required|email|max:255',
            'phone'     => 'required|string|max:50',
            'position'  => 'required|string|max:255',
            'category'  => 'required|string',
            'description' => 'required|string|max:4096',
            'salary'    => 'nullable|numeric|min:0',
            'education' => 'required|in:none,high_school,bachelor,master,phd',
            'experience' => 'required|in:none,junior,mid,senior',
            'skills'    => 'nullable|array',
        ];
    }
}
