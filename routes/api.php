<?php

use Illuminate\Http\Request;

Route::post('/register', 'UserController@register');
Route::post('/login', 'UserController@login');

Route::group(['middleware' => ['jwt.verify']], function ()
{
    Route::group(['middleware' => ['api.superadmin']], function ()
    {
        Route::delete('/kelas/{id}', 'kelasController@destroy');
        Route::delete('/buku/{id}', 'bukuController@destroy');
        Route::delete('/siswa/{id}', 'siswaController@destroy');
        Route::delete('/peminjaman_buku/{id}', 'peminjamanbukuController@destroy');
        Route::delete('/pengembalian_buku/{id}', 'pengembalianbukuController@destroy');
        Route::delete('/detail_peminjaman_buku/{id}', 'detailpeminjamanbukuController@destroy');
    });   
    
    Route::group(['middleware' => ['api.admin']], function ()
    {
        Route::put('/kelas/{id}', 'kelasController@update');
        Route::post('/kelas', 'kelasController@store');

        Route::put('/buku/{id}', 'bukuController@update');
        Route::post('/buku', 'bukuController@store');

        Route::put('/siswa/{id}', 'siswaController@update');
        Route::post('/siswa', 'siswaController@store');

        Route::put('/peminjaman_buku/{id}', 'peminjamanbukuController@update');
        Route::post('/peminjaman_buku', 'peminjamanbukuController@store');

        Route::put('/pengembalian_buku/{id}', 'pengembalianbukuController@update');
        Route::post('/pengembalian_buku', 'pengembalianbukuController@store');

        Route::put('/detail_peminjaman_buku/{id}', 'detailpeminjamanbukuController@update');
        Route::post('/detail_peminjaman_buku', 'detailpeminjamanbukuController@store');
        
        Route::post('pinjamBuku','transaksiController@pinjamBuku');

        Route::post('tambahItem/{id}','transaksiController@tambahItem');
        Route::post('mengembalikanBuku','transaksiController@mengembalikanBuku');

    }); 

Route::get('/kelas', 'kelasController@show');
Route::get('/kelas/{id}', 'kelasController@detail');

Route::get('/buku', 'bukuController@show');
Route::get('/buku/{id}', 'bukuController@detail');

Route::get('/siswa', 'siswaController@show');
Route::get('/siswa/{id}', 'siswaController@detail');

Route::get('/peminjaman_buku', 'peminjamanbukuController@show');
Route::get('/peminjaman_buku/{id}', 'peminjamanbukuController@detail');

Route::get('/pengembalian_buku', 'pengembalianbukuController@show');
Route::get('/pengembalian_buku/{id}', 'pengembalianbukuController@detail');

Route::get('/detail_peminjaman_buku', 'detailpeminjamanbukuController@show');
Route::get('/detail_peminjaman_buku/{id}', 'detailpeminjamanbukuController@detail');


});