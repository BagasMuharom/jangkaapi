<?php

Route::get('/', function () {
    return 'Jangka. Tajam dan Akurat';
});

Route::resource('berita', 'BeritaController');

Route::resource('daerah', 'DaerahController');

Route::resource('sejarah', 'SejarahController');

Route::resource('kategori', 'KategoriController');

Route::post('bookmark/tambah', 'UserController@tambahBookmark');

Route::get('user/{id}', 'UserController@show');

Route::group(['prefix' => 'berita'], function() {

    Route::get('{id}/komentar', 'BeritaController@daftarKomentar');

    Route::get('{id}/kategori', 'BeritaController@daftarKategori');

    Route::post('offset', 'BeritaController@fromOffset');

    Route::get('{id}/gambar', 'BeritaController@lihatGambar');

});

Route::group(['prefix' => 'komentar'], function() {

    Route::post('tambah', 'KomentarController@tambah');

});

Route::post('login', 'AuthController@login');

Route::post('register', 'RegisterController@register');

Route::post('user/unggah/avatar', 'UserController@unggahAvatar');

Route::get('user/lihat/avatar', 'UserController@lihatAvatar');