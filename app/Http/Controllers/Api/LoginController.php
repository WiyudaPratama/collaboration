<?php

namespace App\Http\Controllers\Api;

use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // Set Validation
        $validations = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        // Cek Validation
        if($validations->fails()) {
            return response()->json($validations->errors(), 422);
        }

        // Get Credentials From Request
        $credentials = $request->only('email', 'password');

        // Cek Auth Failed
        if(!$token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Email Atau Password Kamu Salah',
            ], 401);
        }

        // Cek Auth Success
        return response()->json([
            'success' => true,
            'user' => auth()->user(),
            'token' => $token,
        ], 200);
    }
}
