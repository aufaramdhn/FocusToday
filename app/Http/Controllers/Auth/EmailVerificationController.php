<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class EmailVerificationController extends Controller
{
    public function notice()
    {

        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('onboarding.index');
        }

        return view('auth.verify-email');
    }

    public function verify(Request $request, $id)
    {
        $user = User::findOrFail($id);
    
        if (! hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
            abort(403, 'Link tidak valid.');
        }
    
        if (! $user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
            event(new Verified($user));
        }
    
        return view('auth.verify-success');
    }

    public function send(Request $request)
    {
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('onboarding.index');
        }

        $user->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
