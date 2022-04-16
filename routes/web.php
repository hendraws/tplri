<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('admin.dashboard');
// });

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@cek');

    Route::group(['middleware' => ['role:super-admin|administrator']], function () {
        Route::get('/dashboard', 'HomeController@index')->name('home');

        Route::resource('/manajemen-pengguna', 'UserController');
        Route::PUT('/manajemen-pengguna/{manajemen_pengguna}/aktifkan-akun', 'UserController@aktifkanAkun');
        Route::PUT('/manajemen-pengguna/{manajemen_pengguna}/reset-password', 'UserController@resetPassword');

        Route::resource('/master/program-akademik', 'ProgramAkademikController');
        Route::resource('/master/kelas', 'KelasController');
        Route::resource('/master/matapelajaran', 'MataPelajaranController');
        Route::resource('/master/ref-option', 'RefOptionController');

        Route::get('/soal-tiu/{kategori}', 'SoalCatSkdController@tiu');
        Route::get('/soal-tiu/{kategori}/create', 'SoalCatSkdController@createTiu');
        Route::post('/soal-tiu/store', 'SoalCatSkdController@storeTiu');
        Route::get('/soal-tiu/{kategori}/edit/{id}', 'SoalCatSkdController@editTiu');
        Route::put('/soal-tiu/{id}/update', 'SoalCatSkdController@updateTiu');
        Route::delete('/soal-tiu/{id}/delete', 'SoalCatSkdController@deleteTiu');

        Route::get('soal-twk', 'SoalCatSkdController@twk');
        Route::get('soal-twk/create', 'SoalCatSkdController@createTwk');
        Route::post('soal-twk/store', 'SoalCatSkdController@storeTwk');
        Route::get('soal-twk/{id}/edit', 'SoalCatSkdController@editTwk');
        Route::put('soal-twk/{id}/update', 'SoalCatSkdController@updateTwk');
        Route::delete('soal-twk/{id}/delete', 'SoalCatSkdController@deleteTwk');

        Route::get('soal-tkp', 'SoalCatSkdController@tkp');
        Route::get('soal-tkp/crate', 'SoalCatSkdController@createTkp');
        Route::post('soal-tkp/store', 'SoalCatSkdController@storeTkp');
        Route::get('soal-tkp/{id}/edit', 'SoalCatSkdController@editTkp');
        Route::put('soal-tkp/{id}/update', 'SoalCatSkdController@updateTkp');
        Route::delete('soal-tkp/{id}/delete', 'SoalCatSkdController@deleteTkp');

        Route::post('/soal/upload', 'SoalCatSkdController@upload')->name('upload');
        // Route::get('/pengaturan-ujian/asd', 'UjianController@soalUjian');


        Route::resource('/pengaturan-ujian', 'UjianController');
        Route::PUT('/pengaturan-ujian/{id}/is-aktive', 'UjianController@is_active');
        Route::get('/pengaturan-ujian-soal/{kategori}', 'UjianController@soalUjian');
        Route::get('/pengaturan-ujian/{kategori}/{ujian}/tambah-soal', 'UjianController@tambahSoal');
        Route::post('/pengaturan-ujian/simpan-soal', 'UjianController@simpanSoal');
        Route::post('/pengaturan-ujian/hapus-soal', 'UjianController@hapusSoal');
        Route::get('/pengaturan-ujian/generate-token/{id}', 'UjianController@generate');

        Route::resource('/matapelajaran-ujian', 'UjianMataPelajaranController');
        Route::resource('/matapelajaran-ujian-soal', 'UjianSoalController');

        Route::resource('/banksoal/kecerdasan', 'KecerdasanController');
        Route::resource('/banksoal/kecermatan', 'KecermatanController');

        Route::get('/banksoal/kepribadian/sesi-1', 'KepribadianController@sesi1');
        Route::get('/banksoal/kepribadian/sesi-1/create', 'KepribadianController@create_sesi1');
        Route::post('/banksoal/kepribadian/sesi-1/store', 'KepribadianController@store_sesi1');
        Route::get('/banksoal/kepribadian/sesi-1/{kepribadian}/edit', 'KepribadianController@edit_sesi1');
        Route::put('/banksoal/kepribadian/sesi-1/{kepribadian}/update', 'KepribadianController@update_sesi1');
        Route::delete('/banksoal/kepribadian/sesi-1/{id}/destroy', 'KepribadianController@destroy_sesi1');

        Route::get('/banksoal/kepribadian/sesi-2', 'KepribadianController@sesi2');
        Route::get('/banksoal/kepribadian/sesi-2/create', 'KepribadianController@create_sesi2');
        Route::post('/banksoal/kepribadian/sesi-2/store', 'KepribadianController@store_sesi2');
        Route::get('/banksoal/kepribadian/sesi-2/{kepribadian}/edit', 'KepribadianController@edit_sesi2');
        Route::put('/banksoal/kepribadian/sesi-2/{kepribadian}/update', 'KepribadianController@update_sesi2');
        Route::delete('/banksoal/kepribadian/sesi-2/{id}/destroy', 'KepribadianController@destroy_sesi2');

        Route::get('/list-ujian', 'UjianNilaiController@index');
        Route::get('/list-ujian/{id}/detail', 'UjianNilaiController@detail');

        Route::get('/import-soal', 'KecermatanController@import');
        Route::post('/import-soal/save', 'KecermatanController@saveImport');

        Route::resource('/pengaturan-soal', 'PengaturanSoalController');
        Route::resource('/pengaturan-soal', 'PengaturanSoalController');


    });

    Route::group(['middleware' => ['role:siswa']], function () {
        Route::post('/edit-profile/update', 'SiswaController@updateProfile');
        Route::get('/edit-profile', 'SiswaController@editProfile');
        Route::get('/ruang-ujian', 'UjianSiswaController@ruangUjian');
        Route::post('/ujian', 'UjianSiswaController@mulaiUjian');
        Route::post('/ujian/ujian-siswa', 'UjianSiswaController@ujianSiswa');
        Route::post('/ujian/ujian-siswa/store-ujian', 'UjianSiswaController@simpanJawabanKecerdasan');
        Route::post('/ujian/ujian-siswa/store-ujian-kecermatan', 'UjianSiswaController@simpanJawabanKecermatan');
        Route::post('/ujian/ujian-siswa/ujian-kepribadian-sesi-2', 'UjianSiswaController@simpanJawabanKepribadian');
        Route::post('/ujian/ujian-siswa/store-ujian-kepribadian', 'UjianSiswaController@simpanJawabanKepribadian2');
        Route::post('/ujian/ujian-kecerdasan', 'UjianSiswaController@ujianKecerdasan');
        Route::post('/ujian/ujian-kecermatan', 'UjianSiswaController@ujianKecermatan');
        Route::post('/ujian/ujian-kepribadian', 'UjianSiswaController@ujianKepribadian');
        // Route::post('/ujian/ujian-kepribadian-sesi-2', 'UjianSiswaController@ujianKepribadian2');
        Route::get('/hasil-Ujian/{nilai}', 'UjianSiswaController@hasilUjian');
        Route::get('/riwayat-test-psikologi', 'UjianSiswaController@riwayatUjian');

        Route::post('cat-akademik/matematika', 'AkademikUjianSiswaController@halamanUjian');
        Route::post('cat-akademik/simpan-jawaban-cat-akademik', 'AkademikUjianSiswaController@storeJawaban');
        Route::post('cat-akademik/cek-token', 'AkademikUjianSiswaController@cekToken');
    });
});
Route::get('token', 'HomeController@token');
Route::view('under-contruction', 'maintance');
Route::get('reboot', function () {
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
});
Route::get('migrate', function () {
    Artisan::call('migrate');
});
