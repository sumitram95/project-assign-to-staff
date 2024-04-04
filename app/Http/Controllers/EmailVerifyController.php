<?php

namespace App\Http\Controllers;

use App\Mail\ResendEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

date_default_timezone_set('Asia/Kathmandu');
class EmailVerifyController extends Controller
{
    public function emailunVerifiedpage()
    {
        if (auth()->user()->email_verified_at == null) {
            return view('emails.verify-again');
        }
        return redirect()->route('login');
    }
    public function emailVerified($crypt_id)
    {
        $data['id'] = Crypt::decrypt($crypt_id);
        $user = User::find($data['id']);
        if (!$user) {
            return redirect()->route('login')->with('error', 'sorry cannot that:user not found');
        }
        if ($user->email_verified_at !== null) {
            return redirect()->route('login')->with('error', 'Already Email Verified');
        }
        $user->email_verified_at = now();
        $user->save();
        return redirect()->route('login')->with('success', 'SuccessFully Email Verified');
    }
    public function againEmailVerify($crypt_id)
    {
        $decrypte = Crypt::decrypt($crypt_id);
        $user = User::find($decrypte);
        $data = [
            'id' => $user->id,
            'name' => $user->userInfo->full_name,
            'status' => $user->userInfo->status,
            'position' => $user->userInfo->userPosition->position,
            'role' => $user->getRoleNames()->first()
        ];
        Mail::to($user->email)->send(new ResendEmail($data));
        if (auth()->user()->can('staff management')) {
            return back()->with('success', 'SuccessFully sent mail');
        }
        return redirect()->route('email.unverified')->with('success', 'Successfully sent! check your mail and activate account');
    }
}
