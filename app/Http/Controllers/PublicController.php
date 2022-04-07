<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PublicController extends Controller
{
    public function send_otp(Request $request)
    {
        $user = User::where('email', $request->email)->get();

        if(count($user) == 0){
            return response()->json([
                'message' => 'No user with your email was found.'
            ]);
        }

        $user = $user[0];
        $otp = generate_otp();
        $user->otp = $otp;
        $user->save();

        Mail::raw('Your OTP is: ' . $otp, function($message) use($user) {
            $message->subject('SAT - One Time Password')->to($user->email);
        });


        return response()->json([
            'message' => 'OTP has been sent to '.$user->email.'.'
        ]);
    }

    public function verify_otp(Request  $request)
    {
        $user = User::where('email', $request->email)->where('otp', $request->otp)->get();

        if(count($user) == 0){
            return response()->json([
                'message' => 'Wrong OTP.'
            ]);
        }

        $user = $user[0];
        $user->otp = NULL;
        $user->save();

        return response()->json([
            'message' => 'OTP succesful.'
        ]);
    }
}
