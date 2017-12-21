<?php

namespace App\Http\Controllers;

use App\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{

    public function index()
    {
        return Kategori::all();
    }

    public function show($kategori)
    {
        return 
            response()->json(
                Kategori::where('id', $kategori)->first()->daftarBerita()->get()->toArray()
            );
    }

    public function daftarBerita($id)
    {
        return response()->json(
            Kategori::find($id)->daftarBerita()->get()->toArray()
        );
    }

}
