<?php

namespace App\Http\Controllers\SuperAdmin\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SuperAdmin\Auth\ForgotPasswordEmail;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showForgotPasswordForm(Request $request)
    {
        return view('super_admins.auth.forgot_password');
    }


    public function submitForgotPasswordForm(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email|exists:users,email'
            ]
        );

        $user = User::where('email', $request->email)->first();
        if ($user && $user->hasRole(Role::$SuperAdmin)) {
            $token = Str::random(64);
            DB::table('password_resets')->where('email', $request->email)->delete(); // revoke previous tokens
            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
            $emailData['token'] = $token;
            $emailData['redirect_url'] = config('app.url') . '/super_admin/reset_password?token=' . $emailData['token'];
            Mail::to($user->email)->send(new ForgotPasswordEmail($emailData));
            return redirect()->back()->with('message', 'Email Send Successfully')->with('message_type', 'success');
        }
        return redirect()->back()->with('message', 'Invalid Email')->with('message_type', 'error');
    }
    public function showResetPasswordForm(Request $request)
    {
        return view('super_admins.auth.reset_password');
    }

    public function submitResetPasswordForm(Request $request)
    {
        $password_reset = DB::table('password_resets')->where('token', $request->token)->first();
        if (!$password_reset) {
            return redirect()->back()->with('message', 'Invalid Token')->with('message_type', 'error');
        }
        $request->validate([
            'password' => 'required|confirmed',
            'token' => 'required|exists:password_resets,token',
        ]);
        $user = User::where('email', $password_reset->email)->first();
        if ($user && $user->hasRole(Role::$SuperAdmin)) {
            $user_data = [];
            $user_data['password'] = Hash::make($request->password);
            $user->update($user_data);
            DB::table('password_resets')->where('email', $user->email)->delete();
            return redirect(route('super_admin.login'))->with('message', 'Password Reset Successfully')->with('message_type', 'success');
        }
        return redirect()->back()->with('message', 'Invalid Token Provided')->with('message_type', 'success');
    }
}
