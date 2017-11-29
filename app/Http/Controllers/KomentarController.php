<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Berita;

class KomentarController extends Controller
{
    
    public function tambah(Request $request) {
        $user = User::find($request->user);
        $komentar = $request->komentar;
        $berita = Berita::find($request->berita);

        $user->daftarKomentar()->attach($berita, [
            'isi' => $komentar
        ]);

        return response()->json([
            'success' => true
        ]);
    }

    public function hapus(Request $request)
    {
        $user = User::find($request->id_user);
        $komentar = $user->daftarKomentar()->wherePivot('id', $request->id_komentar)->first();

        $komentar->delete();

        return response()->json([
            'success' => true
        ]);
        
    }

}
