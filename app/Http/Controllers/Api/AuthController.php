<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Mail\emailVerificationMail;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{


    public function register(Request $request)
    {

        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors()
                ],  422);
            }
            $otp = rand(100000, 999999);
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->email_otp = $otp;
            $user->otp_expires_at = now()->addMinutes(1);
            $user->save();
            Mail::to($user->email)->send(new emailVerificationMail($user));
            return response()->json([
                'status' => 'success',
                'message' => 'User registered successfully',
                'user' => $user
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }



    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (!$token = Auth::guard('api')->attempt($credentials)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }


        $user = Auth::guard('api')->user();

        if (is_null($user->email_verified_at)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email not verified.',
                'url' => url('/emailverify/otp/resend')
            ], 403);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Login successful',
            'token' => $token,
            'user' => Auth::guard('api')->user(),
        ]);
    }


    public function logout()
    {
        try {
            $token = JWTAuth::getToken();
            if (!$token) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Token not provided',
                ], 401);
            }
            JWTAuth::invalidate($token);
            return response()->json([
                'status' => 'success',
                'message' => 'Logout successful',
            ], 200);
        } catch (\Exception $e) {

            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
                'error' => $e->getMessage(),
            ], 401);
        }
    }

    public function emailVerifyOtp(Request $request)
    {
        $request->validate([

            'otp' => 'required|digits:6',
        ]);
        try {
            $user = User::where('email_otp', $request->otp)->first();
            if ($user) {
                if ($user->otp_expires_at < now()) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'OTP expired',
                    ], 400);
                }
                $user->email_verified_at = now();
                $user->save();
                return response()->json([
                    'status' => 'success',
                    'message' => 'Email verified successfully',
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid OTP',
                ], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    public function emailVerifyOtpResend(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        try {
            $user = User::where('email', $request->email)->first();
            if ($user) {
                $otp = rand(100000, 999999);
                $user->email_otp = $otp;
                $user->otp_expires_at = now()->addMinutes(1);
                $user->save();
                Mail::to($user->email)->send(new emailVerificationMail($user));
                return response()->json([
                    'status' => 'success',
                    'message' => 'OTP sent successfully',
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User not found',
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function me($id)
    {
        try {
            $user = User::find($id)->makeHidden(['created_at', 'updated_at', 'email_verified_at', 'email_otp', 'otp_expires_at']);
            return response()->json([
                'status' => 'success',
                'message' => 'User details',
                'user' => $user,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    public function updateProfile(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }



        try {
            $user = User::find($id);
            $user->name = $request->name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->phone = $request->phone;
            if ($request->file('cover_image')) {
                $cover_image = $this->uploadImage(
                    $request->file('cover_image'),
                    null,
                    'uploads/logo',
                    300,
                    300,
                    'logo'
                );
                $user->cover_image = $cover_image;
            }
            if ($request->file('profile_image')) {
                $profile_image = $this->uploadImage(
                    $request->file('profile_image'),
                    null,
                    'uploads/logo',
                    300,
                    300,
                    'logo'
                );
                $user->profile_image = $profile_image;
            }


            $user->save();
            return response()->json([
                'status' => 'success',
                'message' => 'User updated successfully',
                'user' => $user,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
