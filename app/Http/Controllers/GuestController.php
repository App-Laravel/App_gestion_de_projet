<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\GuestEmailVerificationRequest;
use Carbon\Carbon;

class GuestController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    // show message of sending the verification email
    public function emailVerification(User $user)
    {
        return view('client.verify');
    }

    // Send again the verification email
    public function emailResend(User $user)
    {
        $user->sendEmailVerificationNotification();    
        return back()->with('resent', 'Verification link sent!');
    }

    // handle the email verification when click on the "email verification" in the mail 
    public function setEmailVerification(GuestEmailVerificationRequest $request)
    {
        // get user infos
        $id = $request->route('id');
        $user = User::find($id);

        // if the email is not
        if (empty($user->email_verified_at)) {

            $expires = $request->expires;
            $now = strtotime(Carbon::now());

            // if the request is expired
            if ($now > $expires) {
                return redirect()->route('user.verification-result')->with('expired', 'true');
            };

            // if not expired, the email_verified of this user is set "verified    
            $user->email_verified_at = Carbon::now();
            $status = $user->save();

            if (!empty($status)) {
                return redirect()->route('user.verification-result')->with('success', 'true');
            } else {
                return redirect()->route('user.verification-result')->with('fail', 'true');
            }        
        }

        return redirect()->route('user.verification-result')->with('already', 'true');
    }

    // show email verification result
    public function verificationResult() 
    {
        return view('client.guest_email_verif');
    }
}
