<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users'],
            'mobile' => ['required', 'min:10'],
            'pan_card' => ['required', 'min:10'],
            'aadhar_card' => ['required', 'min:12'],
            'address' => ['required'],
            'password' => ['min:8', 'confirmed', 'required'],
            'password' => ['required'],


        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }


        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->pan_card = $request->pan_card;
        $user->aadhar_card = $request->aadhar_card;
        $user->address = $request->address;
        $user->password = $request->password;
        $user->password = $request->password;
        $user->save();
        
        $token = $user->createToken("auth_token")->accessToken;
        return response()->json(
            [
                'token' => $token,
                'user'  => $user,
                'message' => 'User created successfully',
                'status' => 201
            ]);
    }

    public function login(Request $request){
        $validatedData = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        if (Auth::attempt($validatedData)) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->accessToken;

            return response()->json([
                'user' => $user,
                'access_token' => $token,
            ]);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
