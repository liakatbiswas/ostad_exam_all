<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Mail\OTPEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class UserController extends Controller
{
    public function userLogin(Request $request)
    {
        $user = User::where($request->input())->count();

        if ($user == 1) {
            $token = JWTToken::CreateToken($request->input('email'));

            return response()->json(['status' => 'success', 'data' => $token]);
        } else {
            return response()->json(['msg' => 'failed', 'data' => 'Unauthorized']);
        }
    }

    public function userRegistration(Request $request)
    {
        return User::create($request->input());
    }

    public function sendOtpToEmail(Request $request)
    {
        $userEmail = $request->input('email');
        $otp = rand(1000, 9999);
        $isUser = User::where($request->input())->count();

        if ($isUser == 1) {
            Mail::to($userEmail)->send(new OTPEmail($otp));
            User::where($request->input())->update(['otp' => $otp]);

            return response()->json(['msg' => 'success', 'data' => 'OTP send to your mail']);
        } else {
            return response()->json([
                'msg' => 'failed', 'data' => 'Unauthorized',
            ]);
        }
    }

    public function otpVerify(Request $request)
    {
        $isUser = User::where($request->input())->count();
        if ($isUser == 1) {
            User::where($request->input())->update(['otp' => '0']);

            return response()->json(['msg' => 'success', 'data' => 'Verified']);
        } else {
            return response()->json(['msg' => 'failed', 'data' => 'Unauthorized']);
        }
    }

    public function setPassword(Request $request)
    {
        User::where($request->input())->update(['password ' => $request->input('password')]);

        return response()->json(['msg' => 'success', 'data' => 'Verified']);
    }

    public function profileUpdate(Request $request)
    {
    }

}
