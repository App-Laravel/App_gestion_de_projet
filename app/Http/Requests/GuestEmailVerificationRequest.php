<?php

namespace App\Http\Requests;

use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class GuestEmailVerificationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // get id from route 
        $id = $this->route('id');

        // get email of this userID
        if (!empty($id)) {
            $email = User::find($id)->email;
        }
        
        if (!empty($email)) {

            // check if the encrypted email matches the hash from the route
            if (hash_equals(sha1($email), $this->route('hash'))) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
