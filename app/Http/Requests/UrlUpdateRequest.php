<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UrlUpdateRequest extends FormRequest
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
            'name' => 'required',
            'original_url' => 'required|url:http,https',
            'generated_url' => 'required',
            'active' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Le nom est requis',
            'original_url.required' => 'L\'URL original est requis et doit être un URL',
            'generated_url.required' => 'L\'URL généré est requis',
            'active.required' => 'L\'état est requis'
        ];
    }
}
