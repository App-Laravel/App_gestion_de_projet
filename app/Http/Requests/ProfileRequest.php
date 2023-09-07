<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\{NameRule, EmailRule};

class ProfileRequest extends FormRequest
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
            'name'      => ['required', 'string', 'max:255', new NameRule],
            'gender'    => ['sometimes', 'nullable', 'integer', function($attribute, $value, $fail) {
                                                                    if (!in_array($value, [1, 2])) $fail('The gender is not correct');
            }],
            'email'     => ['required', 'email', 'max:255', 'unique:users,email,'.session('id'), new EmailRule],
            'phone'     => ['sometimes', 'nullable', 'max:50'],            
        ];
    }
    public function messages() {
        return [
            'gender.integer' => 'The gender is not correct'
        ];
    }
}
