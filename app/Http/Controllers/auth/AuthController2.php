<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
  public function FormLogin()
  {
    return view('auth.login');
  }

  public function Login(Request $request)
  {
    // return $request->all();
    // $validator = Validator::make($request->all(), [
    //   'g-recaptcha-response' => 'required'
    // ], [], ['g-recaptcha-response' => 'Captcha']);
    //
    // $validator->validate();

    $credentials = $request->only('email', 'password');

    if (auth()->guard('guru')->attempt($credentials)) {
  //    return redirect()->route('dashboard');
    } else {
      //return back()->with('error', 'Email atau password salah.');
    }
  }

  public function Logout()
  {
    auth()->guard('guru')->logout();
    return redirect()->route('form-login');
  }
}
