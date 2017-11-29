<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{

    public function show($id)
    {
        return response()->json([
            User::find($id)->toArray()
        ]);
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|unique:user',
            'password' => 'required|min:8',
            'email' => 'required|email'
        ]);

        $userId = User::create([
            'username' => $request->username,
            'password' => $request->password,
            'email' => $request->email
        ]);

        return response()->json([
            'success' => true,
            'id' => $userId
        ]);
    }

    public function login(Request $request)
    {
        $response = [];

        $response['success'] = (User::where('username', $request->username)->where('password', $request->password)->count() == 1);

        if($response['success']) {
            $response['id'] = User::where('username', $request->username)->where('password', $request->password)->first()->id;
        }

        return response()->json($response);
    }

    public function changeAvatar(Request $request)
    {

    }

    public function changeProfile(Request $request)
    {
        
    }

    public function daftarBookmark(Request $request)
    {
        $user = User::find($request->id);

        return response()->json(
            $user->daftarBookmark()->get()->toArray()
        );
    }

    public function hapusdariBookmark(Request $request)
    {

    }

    public function tambahBookmark(Request $request)
    {
        $berita = Berita::find($request->berita);
        $user = User::find($request->user);

        if($user->daftarBookmark()->where('id_berita', '!=', $berita->id)->count() == 0) {
            $user->daftarBookmark()->attach($berita);

            return response()->json([
                'success' => true
            ]);
        }
        else if($user->daftarBookmark()->where('id_berita', '!=', $berita->id)->count() > 0) {
            return response()->json([
                'success' => true
            ]);
        }

    }

    public function unggahAvatar(Request $request)
    {
        $avatar = $request->avatar;
    }

}
