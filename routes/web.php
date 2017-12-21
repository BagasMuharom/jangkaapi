<?php

Route::get('/', function () {
    return 'Jangka. Tajam dan Akurat';
});

Route::resource('berita', 'BeritaController');

Route::resource('daerah', 'DaerahController');

Route::resource('sejarah', 'SejarahController');

Route::resource('kategori', 'KategoriController');

Route::get('kategori/{id}/berita', 'KategoriController@daftarberita');

Route::post('bookmark/tambah', 'UserController@tambahBookmark');

Route::post('bookmark/hapus', 'UserController@hapusBookmark');

Route::group(['prefix' => 'berita'], function() {

    Route::get('{id}/komentar', 'BeritaController@daftarKomentar');

    Route::get('{id}/kategori', 'BeritaController@daftarKategori');

    Route::post('offset', 'BeritaController@fromOffset');

    Route::get('{id}/gambar', 'BeritaController@lihatGambar');

    Route::post('toggle/feedback', 'BeritaController@toggleFeedback');

});

Route::group(['prefix' => 'komentar'], function() {

    Route::post('tambah', 'KomentarController@tambah');

    Route::post('hapus', 'KomentarController@hapus');

});

Route::group(['prefix' => 'user'], function() {

    Route::post('unggah/avatar', 'UserController@unggahAvatar');
    
    Route::get('{id}/avatar', 'UserController@lihatAvatar');
    
    Route::get('{id}/bookmark', 'UserController@daftarBookmark');

    Route::get('{id}', 'UserController@show');

});

Route::post('login', 'AuthController@login');

Route::post('register', 'AuthController@register');