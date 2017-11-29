<?php

use Illuminate\Database\Seeder;
use App\Kategori;

class KategoriSeeder extends Seeder
{

    private $daftarKategori = [
        'Sosial',
        'Olahraga',
        'Ekonomi',
        'Teknologi',
        'Gaya Hidup',
        'Otomatif',
        'Travel',
        'Internasional'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->daftarKategori as $kategori) {
            Kategori::create([
                'nama' => $kategori
            ]);
        }
    }

}
