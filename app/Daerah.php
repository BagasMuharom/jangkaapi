<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Berita;

class Daerah extends Model
{
    
    protected $table = 'daerah';

    protected $fillable = [
        'nama'
    ];

    public function daftarBerita()
    {
        return $this->hasMany(
            Berita::class,
            'lokasi'
        );
    }

}
