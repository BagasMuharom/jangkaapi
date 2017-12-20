<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Kategori;

class Berita extends Model
{
    
    protected $table = 'berita';

    protected $fillable = [
        'judul', 'isi'
    ];

    public function daerah() {
        return $this->has(App\Daerah::class);
    }

    public function daftarKomentar()
    {
        return $this->belongsToMany(
            User::class,
            'komentar',
            'id_berita',
            'id_user'
        )->withPivot('id', 'id_berita', 'id_user', 'isi');
    }

    public function daftarKategori()
    {
        return $this->belongsToMany(
            Kategori::class,
            'kategori_berita',
            'id_berita',
            'id_kategori'
        );
    }

    public function daftarFeedback()
    {
        return $this->belongsToMany(
            User::class,
            'feedback_berita',
            'id_berita',
            'id_user'
        )->withPivot('suka');
    }

}
