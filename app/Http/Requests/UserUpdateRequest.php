<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
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
            'email.required' => 'L\'adresse email est requis',
            'email.unique' => 'L\'adresse email est déjà utilisé.',
            'password.required' => 'Mot de passe requis',
            'password.confirmed' => 'Les mots de passe ne sont pas les mêmes',
            'password.min' => 'Veuillez entrer un mot de passe d\'au moins 8 caractères'
        ];
    }
}
