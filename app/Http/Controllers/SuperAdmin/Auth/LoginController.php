<?php

namespace App\Http\Controllers\SuperAdmin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;


class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm(Request $request)
    {
        return view('super_admins.auth.login');
    }


    public function login(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);
        $user = User::where('email', $request->email)->whereHas('roles', function ($q) {
            $q->whereIn('roles.role_code', [Role::$SuperAdmin]);
            $q->where('is_active', 1);
        })->where('is_active', 1)->first();
        if ($user) {
            if (Auth::attempt($request->only(['email', 'password']), $request->get('remember'))) {
                $request->session()->put('logged_in_as', 'super_admin');
                return redirect()->intended(route('super_admin.dashboard'));
            }
        }
        return redirect()->back()->with('message', 'Wrong Credentials')->with('message_type', 'error');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->forget('logged_in_as');
        return redirect()->route('super_admin.login')->with('message', 'Logout Successfully')->with('message_type', 'success');
    }
}
