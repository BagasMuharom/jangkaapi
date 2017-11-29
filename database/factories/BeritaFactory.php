<?php

use Faker\Generator as Faker;

$factory->define(App\Berita::class, function (Faker $faker) {

    return [
        'judul' => $faker->sentence(6),
        'isi' => $faker->paragraph(20),
        'lokasi' => App\Daerah::all()->random()->id,
        'berita_nasional' => (rand() % 2 == 0),
        'dilihat' => 0,
        'thumbnail' => 'thumbnail.jpg'
    ];

});
