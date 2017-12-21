<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\berita;
use Smadia\LaravelGoogleDrive\Facades\LaravelGoogleDrive as LGD;

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

    public function unggahAvatar(Request $request)
    {
        $avatar = base64_decode($request->avatar);

        $filename = $request->user . '.jpg';

        LGD::dir('avatar')->put($filename, $avatar);

        return response()->json([
            'success' => true
        ]);
    }

    public function daftarBookmark(Request $request)
    {
        $user = User::find($request->id);

        return response()->json(
            $user->daftarBookmark()->get()->makehidden(['isi', 'created_at', 'updated_at'])->toArray()
        );
    }

    public function hapusBookmark(Request $request)
    {
        $user = User::find($request->user);
        $berita = User::find($request->berita);

        $user->daftarBookmark()->detach($berita);

        return response()->json([
            'success' => true
        ]);
    }

    public function tambahBookmark(Request $request)
    {
        $berita = Berita::find($request->berita);
        $user = User::find($request->user);

        $user->daftarBookmark()->detach($berita);
        $user->daftarBookmark()->attach($berita);        

        return response()->json([
            'success' => true
        ]);
    }

    public function lihatAvatar($id)
    {
        return LGD::dir('avatar')->file($id, 'jpg')->show();
    }

}
