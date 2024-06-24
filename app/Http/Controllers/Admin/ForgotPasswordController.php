<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Carbon;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function forgotPassword(){
        if (Auth::check() && Auth::user()->status === 'active') {
            return view('admin.home.index');
        }
        return view('admin.users.forgotPassword');
    }

    public function forgotPasswordStore(Request $request)
    {
        $this -> validate($request, [
            'email'           => 'required|email|exists:users',
        ],
        [
            'email.required'    => "E-Mail Field must not be empty !!",
            'email.exists'      => "E-Mail address is not Exist !!",
            'email.email'       => "E-Mail Address is not valid !!",
        ]);

        $email = $request->email;
        $existingToken = DB::table('password_reset_tokens')->where('email', $email)->first();

        if ($existingToken) {
            return redirect()->back()->with("error_message", "A reset token already exists for this email address.");
        }

        $token = Str::random(64);
        DB::table('password_reset_tokens')->insert([
            'email'       => $request->email,
            'token'       => $token,
            'created_at'  => Carbon::now(),
        ]);
        Mail::send('admin.users.emails.forgotPassword', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject("Reset Password");
        });
        return redirect() -> to(route("admin.forgotPassword")) -> with('message', 'We have sent an email to reset password. Please check your E-Mail.');
    }

    public function resetPassword($token){
        if (Auth::check() && Auth::user()->status === 'active') {
            return view('admin.home.index');
        }
        return view('admin.users.resetPassword', compact('token'));
    }

    public function resetPasswordStore(Request $request)
    {
        $this -> validate($request, [
            'email'           => 'required|email|exists:users',
            'password'        => 'required|confirmed',
            'password_confirmation' => 'required',
        ],
        [
            'email.required'    => "E-Mail Field must not be empty !!",
            'email.exists'      => "E-Mail address is not Exist !!",
            'email.email'       => "E-Mail Address is not valid !!",
            'password.required' => "Password Field must not be empty !!",
            'password_confirmation.required' => "Confirm Password Field must not be empty !!",
        ]);

        $updatePassword = DB::table('password_reset_tokens')->where([
            'email'=>$request->email,
            'token'=>$request->token,
        ])->first();
        if (!$updatePassword){
            return redirect()->back()->with("error_message", "Invalid");
            }

            User::where("email", $request->email)->update(["password" => Hash::make($request->password)]);

        DB::table('password_reset_tokens')->where(['email'=> $request->email])->delete();
        
        return redirect() -> to(route("admin.users.login")) -> with('message', 'Password reset success.');
    }
}