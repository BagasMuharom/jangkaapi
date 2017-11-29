<?php

use Illuminate\Database\Seeder;
use App\Berita;
use App\Kategori;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Berita::class, 50)->create();

        foreach(Berita::all() as $berita) {
            $jumlahKategori = rand() % 3;
            for($i = 1; $i <= $jumlahKategori; $i++) {
                $kategoriBerita = $berita->daftarKategori()->pluck('id_kategori')->toArray();
                $kategori = Kategori::whereNotIn('id', $kategoriBerita)->get()->random();
                $berita->daftarKategori()->attach($kategori);
            }
        }
    }
    
}
