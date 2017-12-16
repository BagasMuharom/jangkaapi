<?php

Route::get('/', function () {
    return 'Jangka. Tajam dan Akurat';
});

Route::resource('berita', 'BeritaController');

Route::resource('daerah', 'DaerahController');

Route::resource('sejarah', 'SejarahController');

Route::resource('kategori', 'KategoriController');

Route::post('bookmark/tambah', 'UserController@tambahBookmark');

Route::post('bookmark/hapus', 'UserController@hapusBookmark');

Route::group(['prefix' => 'berita'], function() {

    Route::get('{id}/komentar', 'BeritaController@daftarKomentar');

    Route::get('{id}/kategori', 'BeritaController@daftarKategori');

    Route::post('offset', 'BeritaController@fromOffset');

    Route::get('{id}/gambar', 'BeritaController@lihatGambar');

    Route::post('tambah/like', 'BeritaController@tambahLike');

    Route::post('tambah/dislike', 'BeritaController@tambahDislike');

    Route::post('kurangi/like', 'BeritaController@kurangiLike');

    Route::post('kurangi/dislike', 'BeritaController@kurangiDislike');

});

Route::group(['prefix' => 'komentar'], function() {

    Route::post('tambah', 'KomentarController@tambah');

});

Route::group(['prefix' => 'user'], function() {

    Route::post('unggah/avatar', 'UserController@unggahAvatar');
    
    Route::get('lihat/avatar', 'UserController@lihatAvatar');
    
    Route::get('{id}/bookmark', 'UserController@daftarBookmark');

    Route::get('{id}', 'UserController@show');

});

Route::post('login', 'AuthController@login');

Route::post('register', 'AuthController@register');