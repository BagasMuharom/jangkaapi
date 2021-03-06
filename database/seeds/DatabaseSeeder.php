<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call('UserSeeder');
        $this->call('KategoriSeeder');
        $this->call('DaerahSeeder');
        $this->call('BeritaSeeder');
        $this->call('KomentarSeeder');
        $this->call('FeedbackSeeder');
        $this->call('BookmarkSeeder');
        $this->call('SejarahSeeder');
    }

}
