<?php

namespace App\Http\Controllers\authentications;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginBasic extends Controller
{
    public function index()
    {
        $pageConfigs = ['myLayout' => 'blank'];
        return view('content.authentications.auth-login-basic', ['pageConfigs' => $pageConfigs]);
    }

    public function login(Request $request)
    {
        // $this->validate($request, [
        //     'email'    => 'required|email|exists:users',
        //     'password' => 'required|min:6|string',
        // ], [
        //     'email.required'    => 'The email is required.',
        //     'email.email'       => 'Please enter a valid email address.',
        //     'email.exists'      => 'The specified email does not exist in our records.',
        // ]);

        // Extract email and password from the request
        $credential = $request->only('email', 'password');
        $user = User::where('email', $credential['email'])->first();
        if ($user && Hash::check($credential['password'], $user->password)) {
            // Attempt authentication using the credentials
            if (Auth::attempt($credential)) {
              return redirect()->route('pages-home');
            }
        }
        else {
            // Authentication failed
            return redirect()->back()->withInput()->withErrors(['email' => 'Invalid credentials']);
        }
    }
}