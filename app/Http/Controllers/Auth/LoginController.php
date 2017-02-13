<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\LoginRequest;

use Illuminate\Validation\Validator;

use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public function withValidator($validator)
{
    $validator->after(function ($validator) {
        if ($this->somethingElseIsInvalid()) {
            $validator->errors()->add('field', 'Something is wrong with this field!');
        }
    });
}


    public function getLogin() {
        if (Auth::check()) {
            return redirect()->route('admin');
        }
       else {
         return view('auth.login');
       } 
    }

    public function postLogin(LoginRequest $request) {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password, 'level'=> 1])) {
            return redirect()->route('admin');
        }
        else return redirect()->back();
    }

     public function getLogout() {
        Auth::logout();
        return redirect()->route('home');
    }
}
