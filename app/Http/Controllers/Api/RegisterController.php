<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
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
            'npm' => 'required|max:8',
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        // Cek Validation
        if($validations->fails()) {
            return response()->json($validations->errors(), 422);
        }

        // Create User
        $user = User::create([
            'npm' => $request->npm,
            'name' => $request->name,
            'email' => $request->email,
            'status' => 'aktif',
            'password' => bcrypt($request->password),
        ]);

        // Return Response JSON User Is Created
        if($user) {
            // Assign Role Management
            $user->assignRole('user');

            return response()->json([
                'success' => true,
                'user' => $user,
            ], 201);
        }

        // Return Response JSON Process IS Failed
        return response()->json([
            'success' => false,
        ], 409);
    }
}
