<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Berita;
use Faker\Factory;

class KomentarSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(User::all() as $user) {
            $berita = Berita::all()->random();
            $user->daftarKomentar()->attach($berita, [
                'isi' => Factory::create()->sentence(6)
            ]);
        }
    }

}
