<?php

namespace App\Http\Controllers\authentications;

use App\Models\User;
use App\Mail\ForgotPassword;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;


class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;
    
    public function index()
  {
    $pageConfigs = ['myLayout' => 'blank'];
    return view('content.authentications.forgot-password', ['pageConfigs' => $pageConfigs]);
  }
  
  public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            
        ]);

        // Get the email address from the form
        $email = $request->email;
        $user = User::where('email', $email)->first();

        // Send email
        Mail::to($email)->send(new ForgotPassword($email));
        // Redirect back with success message or any other logic
        return redirect()->back()->with('success', 'Reset link sent successfully!')->with(['user' => $user]);
    }
    /**
     * Show the reset password form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function showResetPasswordForm(Request $request)
    {
        $pageConfigs = ['myLayout' => 'blank'];
        $email = $request->query('email');
        return view('auth.reset-password', ['pageConfigs' => $pageConfigs, 'email' => $email]);
    }

    /**
     * Reset the user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resetPassword(Request $request)
    {
        // Validate request
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Find the user by email
        $user = User::where('email', $request->email)->first();

        // Set user's password
        $user->password = bcrypt($request->password);
        $user->save();

        // Send email
        Mail::to($user->email)->send(new ForgotPassword($user, $request->password));

        // Redirect user to dashboard or wherever you want
        return redirect()->route('auth-login-basic')->with('success', 'Password reset successfully!');
    }

// public function showResetForm(Request $request, $token)
//     {
//         return view('auth.reset-password', ['token' => $token, 'email' => $request->email]);
//     }

//     public function reset(Request $request)
//     {
//         $request->validate([
//             'token' => 'required',
//             'email' => 'required|email',
//             'password' => 'required|confirmed|min:8',
//         ]);

//         $status = Password::reset($request->only('email', 'password', 'password_confirmation', 'token'), function ($user, $password) {
//             $user->password = bcrypt($password);
//             $user->save();
//         });

//         return $status == Password::PASSWORD_RESET
//             ? redirect()->route('login')->with('status', __($status))
//             : back()->withErrors(['email' => [__($status)]]);
//     }
}