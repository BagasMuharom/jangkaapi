<?php

namespace App\Http\Controllers;

use App\Berita;
use App\User;
use Illuminate\Http\Request;
use Smadia\LaravelGoogleDrive\Facades\LaravelGoogleDrive as LGD;

class BeritaController extends Controller
{

    public function index()
    {
        return Berita::all()->makeHidden('isi');
    }

    public function fromOffset(Request $request)
    {
        $idmin = $request->idmin;
        $count = $request->count;

        return response()->json(
            Berita::where('id', '>', $idmin)->limit($count)->get()->toArray()
        );
    }

    public function show($id)
    {
        $user = (request()->has('user') ? request()->user : -1);
        $id = (int) $id;
        $berita = Berita::find($id);
        $berita['like'] =  Berita::find($id)->daftarFeedback()->wherePivot('suka', true)->count();
        $berita['dislike'] =  Berita::find($id)->daftarFeedback()->wherePivot('suka', false)->count();

        
        if($user != -1) {
            // Jika login, maka dicek apakah user pernah memberi aksi
            // like atau dislike
            if($berita->daftarFeedback()->wherePivot('id_user', $user)->count() > 0) {
                $berita['user_feedback'] = true;
                $berita['user_like'] = (boolean)  Berita::find($id)->daftarFeedback()->wherePivot('id_user', $user)->first()->pivot->suka;
            }
            else
                $berita['user_feedback'] = false;

            if(User::find($user)->daftarBookmark()->wherePivot('id_berita', $id)->count() > 0) {
                $berita['user_bookmark'] = true;
            }
            else
                $berita['user_bookmark'] = false;
        }

        return response()->json([$berita]);
    }

    public function daftarKomentar($id)
    {
        return response()->json(Berita::find($id)->daftarKomentar()->get()->toArray());
    }

    public function daftarKategori($id)
    {
        return Berita::find($id)->daftarKategori()->get()->toJson();
    }

    public function lihatGambar($id)
    {
        $id = (int) $id;
        $berita = Berita::find($id);
        $thumb = $berita->thumbnail;

        $name = substr($thumb, 0, strrpos($thumb, '.'));
        $extension = substr($thumb, strrpos($thumb, '.') + 1, strlen($thumb));

        return LGD::file($name, $extension)->show();
    }

    public function tambahLike(Request $request)
    {
        $user = User::find($request->user);
        $berita = Berita::find($request->berita);
        
        $berita->daftarFeedback()->detach($user);
        $berita->daftarFeedback()->attach($user, [
            'suka' => true
        ]);

        return response()->json([
            'success' => true
        ]);
    }

    public function kurangiLike(Reuqest $request)
    {
        $user = User::find($request->user);
        $berita = Berita::find($request->berita);

        $berita->daftarFeedback()->detach($user);

        return response()->json([
            'success' => true
        ]);
    }

    public function tambahDislike(Reuqest $request)
    {
        $user = User::find($request->user);
        $berita = Berita::find($request->berita);

        $berita->daftarFeedback()->detach($user);        
        $berita->daftarFeedback()->attach($user, [
            'suka' => false
        ]);

        return response()->json([
            'success' => true
        ]);
    }
    
    public function kurangiDislike(Request $request)
    {
        $user = User::find($request->user);
        $berita = Berita::find($request->berita);

        $berita->daftarFeedback()->detach($user);

        return response()->json([
            'success' => true
        ]);
    }

}
