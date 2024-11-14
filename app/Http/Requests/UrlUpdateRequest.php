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
            'originalUrl' => 'required|url:http,https',
            'generatedUrl' => 'required',
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
            'originalUrl.required' => 'L\'URL original est requis et doit être un URL',
            'generatedUrl.required' => 'L\'URL généré est requis',
            'active.required' => 'L\'état est requis'
        ];
    }
}
