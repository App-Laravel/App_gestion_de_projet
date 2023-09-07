<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class PasswordRequest extends FormRequest
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
        return [
            'currentpassword'   => ['required', 'current_password'],
            'password'          => ['required', 'string', 'different:currentpassword','confirmed', Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised()]   
        ];
    }
    public function attributes() {
        return [
            'currentpassword'   => 'current password',
        ];
    }
}
