<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Berita;

class FeedbackSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(User::all() as $user) {
            $user->daftarFeedback()->attach(Berita::all()->random(), [
                'suka' => (rand() % 2 == 0)
            ]);
        }
    }

}
