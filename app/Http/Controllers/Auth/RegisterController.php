<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;

use App\Rules\{NameRule, EmailRule};
use Illuminate\Validation\Rules\Password;
use App\Http\Requests\UserRequest;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name'      => $data['name'],
            'email'     => $data['email'],
            'password'  => Hash::make($data['password']),
            'avatar'    => $data['avatar'],
        ]);
    }

    public function register(UserRequest $userRequest)
    {
        $userData = request()->all();
        $userData['avatar'] = $this->storeAvatar();

        event(new Registered($user = $this->create($userData)));

        $this->guard()->login($user);

        if ($response = $this->registered(request(), $user)) {
            return $response;
        }

        return request()->wantsJson()
                    ? new JsonResponse([], 201)
                    : redirect($this->redirectPath());
    }

    public function storeAvatar()
    {
        if (request()->hasFile('avatar')) {
            
            // check if file upload is successful
            if (request()->avatar->isValid()) {
                $file = request()->avatar;

                $fileName = time().'_'.request()->avatar->getClientOriginalName();
                $filePath = $file->storeAs('uploads/avatar', $fileName);

                $filePath = str_replace('/', DIRECTORY_SEPARATOR, $filePath);
                return storage_path("app".DIRECTORY_SEPARATOR.$filePath);

            } else {
                return back()->withInput()->with('upload_error', 'The file upload was not successful.');
            }
        }
    
        return null;
    }
}
