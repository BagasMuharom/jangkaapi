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

    public function toggleFeedback(Request $request) {
        $suka = $request->suka;
        $user = $request->user;
        $berita = Berita::find($request->berita);
        $response = [];

        if($suka) {
            if($berita->daftarFeedback()->wherePivot('id_user', $user)->wherePivot('suka', true)->count() > 0) {
                $berita->daftarFeedback()->detach($user);
                $response['disukai'] = false;
            }
            else {
                $berita->daftarFeedback()->detach($user);
                $berita->daftarFeedback()->attach($user, [
                    'suka' => true
                ]);
                $response['disukai'] = true;                
            }
            $response['tidak_disukai'] = false;
        }
        else {
            if($berita->daftarFeedback()->wherePivot('id_user', $user)->wherePivot('suka', false)->count() > 0) {
                $berita->daftarFeedback()->detach($user);
                $response['tidak_disukai'] = false;                
            }
            else {
                $berita->daftarFeedback()->detach($user);
                $berita->daftarFeedback()->attach($user, [
                    'suka' => false
                ]);
                $response['tidak_disukai'] = true;                
            }
            $response['disukai'] = false;            
        }

        $response['success'] = true;
        return response()->json($response);
    }

}
