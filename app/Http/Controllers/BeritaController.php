<?php

namespace App\Http\Controllers;

use App\Berita;
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
        $id = (int) $id;
        $berita = Berita::find($id);
        $berita['like'] = Berita::find($id)->daftarFeedback()->wherePivot('suka', true)->count();
        $berita['dislike'] = Berita::find($id)->daftarFeedback()->wherePivot('suka', false)->count();

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

}
