<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AuthController extends Controller
{
    
    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        $response = [];

        $response['success'] = (User::where('username', $request->username)->where('password', $password)->count() == 1);

        return response()->json($response);
    }
    
    public function register(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|unique:user',
            'email' => 'required|unique:user',
            'password' => 'required|confirmed',
        ]);

        $user = User::create([
            'username' => $request->user,
            'email' => $request->email,
            'password' => $request->password
        ]);

        return response()->json([
            'success' => true,
            'id' => $user->id
        ]);
    }

}
