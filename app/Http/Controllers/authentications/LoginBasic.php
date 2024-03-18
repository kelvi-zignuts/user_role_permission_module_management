<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginBasic extends Controller
{
  public function index()
  {
    $pageConfigs = ['myLayout' => 'blank'];
    return view('content.authentications.auth-login-basic', ['pageConfigs' => $pageConfigs]); 
  }
  // public function index(Request $request)
  //   {
  //       $credentials = $request->only('email', 'password');

  //       if (Auth::attempt($credentials)) {
  //           // Authentication passed...
  //           return redirect()->route('pages-page-2');
  //       }

  //       return redirect()->route('auth-login-basic')->with('error', 'Invalid credentials!');
  //   }
  
}