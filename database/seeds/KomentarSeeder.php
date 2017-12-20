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
            for($i = 1; $i <= 5; $i++) {
                $berita = Berita::whereNotIn('id', $user->daftarKomentar()->get()->pluck('id')->toArray())->get()->random();
                $user->daftarKomentar()->attach($berita, [
                    'isi' => Factory::create()->sentence(6)
                ]);
            }
        }
    }

}
