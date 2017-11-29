<?php

use Illuminate\Database\Seeder;

class DaerahSeeder extends Seeder
{

    private $daftarDaerah = [
        'Sumatra',
        'DKI Jakarta',
        'Banten',
        'Jawa Barat',
        'Jawa Tengah',
        'DI Yogyakarta',
        'Jawa Timur',
        'Bali',
        'Kalimantan',
        'Sulawesi',
        'Maluku',
        'Papua',
        'Nusa Tenggara'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->daftarDaerah as $daerah) {
            App\Daerah::create([
                'nama' => $daerah
            ]);
        }
    }
}
