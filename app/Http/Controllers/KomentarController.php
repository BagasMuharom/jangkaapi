<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Berita;
use App\Komentar;

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
            'success' => true,
            'id_komentar' => $user->daftarKomentar()->last()->pivot->id
        ]);
    }

    public function hapus(Request $request)
    {
        Komentar::find($request->id_komentar)->delete();

        return response()->json([
            'success' => true
        ]);
    }

}
