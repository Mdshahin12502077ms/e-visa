<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
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

        return response()->json([
            'status' => 'success',
            'message' => 'Login successful',
            'token' => $token,
            'user' => Auth::guard('api')->user(),
        ]);
    }


    public function logout(){
        try{
            $token = JWTAuth::getToken();
            if(!$token){
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
        }
        catch(\Exception $e){
            
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
                'error' => $e->getMessage(),
            ], 401);
        }
    }
}
