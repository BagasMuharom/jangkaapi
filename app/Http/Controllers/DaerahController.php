<?php

namespace App\Http\Controllers;

use App\Daerah;
use Illuminate\Http\Request;

class DaerahController extends Controller
{

    public function index()
    {
        return Daerah::all();
    }

    public function show($daerah)
    {
        return Daerah::where('id', $daerah)->first()->daftarBerita()->get()->toJson();
    }

}
