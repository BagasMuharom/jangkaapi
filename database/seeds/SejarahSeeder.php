<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory;
use App\Sejarah;

class SejarahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menambah dari tanggal sekarang sampai 15 hari kedepan
        for($i = 0; $i <= 15; $i ++) {
            for($j = 1; $j <= 5; $j ++) {
                $faker = Factory::create();
                $waktu = Carbon::today()->addDay($i);
                Sejarah::create([
                    'judul' => $faker->sentence(6),
                    'isi' => $faker->sentence(20),
                    'tgl_terjadi' => $waktu,
                    'gambar' => 'sejarah.jpg'
                ]);
            }
        }
    }

}
