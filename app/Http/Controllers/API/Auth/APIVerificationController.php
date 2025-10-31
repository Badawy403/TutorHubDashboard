<?php

namespace App\Http\Controllers\API\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


class APIVerificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function verifyEmail(EmailVerificationRequest $request){
        $request->fulfill();
        request()->session()->flash('alert', [
            'type' => 'success',
            'message' => 'Email verified Successfully',
        ]);
        return redirect()->route('account');
    }

    public function resendVerificationEmail(Request $request){
        if(auth()->user()->hasVerifiedEmail()){
            request()->session()->flash('alert', [
                'type' => 'info',
                'message' => 'You are Already a verified User',
            ]);
            return redirect()->intended(route('account'));
        }
        auth()->user()->sendEmailVerificationNotification();
        request()->session()->flash('alert', [
            'type' => 'success',
            'message' => 'Email Send Successfully',
        ]);
        request()->session()->flash('status','verification-link-sent' );
        return back()->with('message', 'Verification link sent!');
    }
}
