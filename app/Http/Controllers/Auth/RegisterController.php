<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/';

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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
        	'documento' => 'required|digits_between:2,10|unique:users',
            'name' 		=> 'required|max:255',
        	'address' 	=> 'required|max:255',
        	'phonen' 	=> 'required|digits_between:7,10',
            'email' 	=> 'required|email|max:255|unique:users',
            'password' 	=> 'required|min:6|confirmed',
        	'g-recaptcha-response' => 'required|recaptcha',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
        	'documento' => $data['documento'],
            'name' => $data['name'],
        	'address' => $data['address'],
        	'phonen' => $data['phonen'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
