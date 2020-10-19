<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use Validator;
use App\User;
use Hash;

class AuthController extends Controller
{

  public function loginView(){
  	return view('Auth.login');
  }

  public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');

        $login = Auth::attempt($credentials);

        if ($login) {
           return view('dashboard.dashboard.index');
        } else {
            return redirect()->route('login');
        }

    }

	public function registerView(){
		return view('Auth.register');
	}

	public function register(Request $request)
    {
        //Validasi
        $validasi = Validator::make($request->all(), [
            'name'  => 'required|min:5|string',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed|min:6'
        ])->validate();

        $request->merge([
            'password' => Hash::make($request->password)
        ]);
        $user = User::create($request->except(['password_confirmation']));
        
        if ( $user ) {
            return redirect()->route('login');
        } else {
            return redirect()->route('register');
        }
    }

    public function logout()
    {
        $logout = Auth::logout();
        if ($logout) {
           return abort(404);
        } else {
            return  redirect()->route('login');
        }
    }

}
