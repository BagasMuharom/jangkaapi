<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    
    public function login(Request $request)
    {
        $response = [];

        if(Auth::attempt([
            'username' => $request->username,
            'password' => $request->password
        ])) {
            $response['user'] = User::where('username', $request->username)->first()->makeHidden('password')->toArray();
            $response['success'] = true;            
        }
        else {
            $response['success'] = false;
        }

        return response()->json($response);
    }
    
    public function register(Request $request)
    {
        if(User::where('username', $request->username)->count() > 0) {
            return response()->json([
                'success' => false,
                'errorCode' => 0
            ]);
        }

        if(User::where('email', $request->email)->count() > 0) {
            return response()->json([
                'success' => false,
                'errorCode' => 1
            ]);
        }

        if($request->password != $request->password_confirmation) {
            return response()->json([
                'success' => false,
                'errorCode' => 2
            ]);
        }

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return response()->json([
            'success' => true,
            'user' => $user->makeHidden('password')->toArray()
        ]);
    }

}
