<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

use App\Rules\{NameRule, EmailRule};

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if ($this->route()->uri == 'login') {
            
            return [
                'email'         => ['required', 'email', 'exists:users,email'],
                'password'      => ['required', Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised()]
            ];

        } else if ($this->route()->uri == 'register') {
            
            return [
                'name' => ['required', 'string', 'max:255', new NameRule],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email', new EmailRule],
                'password' => ['required', 'string', 'confirmed', Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised()],
                'avatar'    => ['sometimes', 'image', 'mimes:png,jpg,jpeg,gif']
            ];
        }
    }  

    public function messages()
    {
        return [
            'exists' => 'The account does not exist.',
        ];
    }
}
