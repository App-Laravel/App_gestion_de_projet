<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    // User's homepage
    public function index()
    {
        $projects = User::find(Auth::user()->id)->projects;
        // total of projects
        $total = $projects->count();

        return view('client.home', compact('total'));
    }


    // show user's profile
    public function profile()
    {
        $user = Auth::user();

        return view('client.profile', compact('user'));
    }

    // Show the form for modifying user's profile
    public function editProfile()
    {
        $user = Auth::user();
        session(['id'=>$user->id]);

        return view('client.edit_profile', compact('user'));
    }

    // Save the modified profile
    public function handleEditProfile(ProfileRequest $request)
    {
        $user = User::find(Auth::user()->id);
        $user->name = $request->name;

        if (!empty($request->gender)) {
            $user->gender = $request->gender;
        }       

        if (!empty($request->avatar)) {
            $user->avatar = $request->avatar;
        }
        
        $user->email = $request->email;
        $user->phone = $request->phone ?? null;
        $status = $user->save();

        if (!empty($status)) {
            return back()->with('msg', trans('profile.profile-msg'));
        }
        return back()->with('msg-error', trans('profile.profile-msg-error'));
    }

    // Show the form for changing the password
    public function changePassword()
    {
        return view('client.change_password');
    }

    // Save new password
    public function handleChangePassword(PasswordRequest $request)
    {
        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($request->password);
        $status = $user->save();

        if (!empty($status)) {
            return back()->with('msg', trans('profile.change-password-msg'));
        }
        return back()->with('msg-error', trans('profile.change-password-msg-error'));
    }
}
