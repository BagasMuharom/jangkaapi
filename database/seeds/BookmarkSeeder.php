<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Berita;

class BookmarkSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(User::all() as $user) {
            $daftarBookmark = $user->daftarBookmark()->pluck('id')->all();
            
            for($i = 1; $i <= 10; $i++) {
                $berita = Berita::whereNotIn('id', $daftarBookmark)->get()->random();

                $user->daftarBookmark()->attach($berita);
            }
        }
    }

}
