<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Berita;

class Kategori extends Model
{
    
    protected $table = 'kategori';

    protected $hidden = [
        'pivot', 'created_at', 'updated_at'
    ];

    protected $fillable = [
        'nama'
    ];

    public function daftarBerita()
    {
        return $this->belongsToMany(
            Berita::class,
            'kategori_berita',
            'id_kategori',
            'id_berita'
        );
    }

}
