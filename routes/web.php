<?php

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

// Route::get('/home', 'HomeController@index')->name('home');

// mahasiswa
Route::get('/', function () {
    return redirect(route('login'));
});

Auth::routes();
Route::group(['middleware' => ['auth', 'role:mahasiswa']], function() {
    //mahasiswa
    Route::prefix('mahasiswa')->group(function () {
        Route::get('home', 'CollegeStudentController@index')->name('mahasiswa.home');
        Route::get('progress', 'CollegeStudentController@progress');
        Route::get('mahasiswa-cek', 'GroupProjectController@show')->name('mahasiswa.index');
        Route::post('daftar', 'GroupProjectController@store')->name('mahasiswa.daftar');
        Route::get('project/{id}', 'CollegeStudentController@show');
        Route::put('project/{id}/edit', 'CollegeStudentController@update');
        Route::put('project/{id}/upload', 'CollegeStudentController@upload')->name('upload-laporan');
        Route::get('getVerif/{id}', 'GroupProjectController@getVerif');
        Route::put('daftarSeminar/{id}/edit', 'GroupProjectController@accSeminar');
    });   

});
Route::group(['middleware' => ['auth', 'role:koordinator']], function() {  
    // koordinator
    Route::prefix('koor')->group(function () {
        Route::get('dashboard', 'CoordinatorController@index')->name('coordinator.home');
        Route::get('mahasiswa', 'CoordinatorController@project_team');
        Route::get('bimbingan', 'GroupProjectProgressController@index');
        Route::get('bimbingan/show', 'GroupProjectProgressController@show');
        Route::get('seminar', 'CoordinatorController@seminar');
        Route::get('daftarSeminar/show', 'SeminarController@get');
        Route::get('seminar/show', 'SeminarController@seminar');
        Route::get('detailDaftarSem/{id}', 'SeminarController@detailDaftar');
        Route::get('terimaSeminar/{id}', 'SeminarController@terima');
        Route::get('updateSeminar/{id}', 'SeminarController@show');
        Route::get('arsip-pk', 'CoordinatorController@showArsip');
        Route::get('arsip-pk/show', 'AdminController@arsipKoor');
        Route::get('detailArsip/{id}', 'SeminarController@detailArsip');
        Route::get('jobdesc', 'JobdescController@index');
        Route::get('jobdesc/{id}', 'JobdescController@edit');
        Route::put('jobdesc/{id}/edit', 'JobdescController@update');
        Route::get('getDataTableJobdesc', 'JobdescController@get');
        Route::post('simpanDataJobdesc', 'JobdescController@store');
        Route::delete('jobdesc/{id}', 'JobdescController@destroy')->name('jobdesc.destroy');
        Route::post('jobdesc/import', 'JobdescController@import')->name('jobdesc-import');
        Route::get('getDataTablePK', 'CoordinatorController@get');
        Route::get('getDataVerified', 'CoordinatorController@getVerified');
        Route::get('getDataTableVerif/{id}', 'CoordinatorController@getVerif');
        Route::get('getIsVerif/{id}', 'CoordinatorController@getIsVerif');
        Route::put('getIsVerif/{id}/edit', 'CoordinatorController@verifikasi');
        Route::get('updateSupervisor/{id}', 'CoordinatorController@getSupervisor');
        Route::put('updateSupervisor/{id}/edit', 'CoordinatorController@updateSupervisor');
        Route::delete('tolakProject/{id}', 'CoordinatorController@tolak');
        Route::delete('hapusProject/{id}', 'CoordinatorController@hapus');
        Route::get('bimbingan/{id}', 'GroupProjectProgressController@tampil');
        Route::put('bimbingan/{id}/update', 'GroupProjectProgressController@update');
        Route::put('verifSeminar/{id}/edit', 'SeminarController@verifikasi');
        Route::get('seminar/{id}', 'AdminController@show');
        Route::delete('tolakSeminar/{id}', 'SeminarController@destroy');
        Route::get('getSeminar/{id}', 'SeminarController@getSeminar');
        Route::put('updateSeminar/{id}/edit', 'SeminarController@update');
        Route::put('isDone/{id}/edit', 'SeminarController@isDone');
        Route::get('newsReport/{id}', 'GroupProjectNewsReportController@get');
        Route::put('newsReport/{id}/edit', 'GroupProjectNewsReportController@store');
        Route::get('exportExcel', 'GroupProjectController@export');
        });
    });
Route::group(['middleware' => ['auth', 'role:admin']], function() {  
    // admin
    Route::prefix('admin')->group(function () {
        Route::get('mahasiswa', 'AdminController@showStudent')->name('admin.home');
        Route::get('getDataTableMhs', 'AdminController@get');
        Route::post('simpanDataMhs', 'AdminController@save');
        Route::get('mahasiswa/{id}', 'AdminController@show');
        Route::put('mahasiswa/{id}/edit', 'AdminController@update');
        Route::post('mahasiswa/import', 'AdminController@import')->name('student-import');
        Route::get('dosen', 'LecturerController@showLecturer');
        Route::get('getDataTableDosen', 'LecturerController@get');
        Route::post('simpanDataDosen', 'LecturerController@save');
        Route::get('dosen/{id}', 'LecturerController@show');
        Route::put('dosen/{id}/edit', 'LecturerController@update');
        Route::post('dosen/import', 'LecturerController@import')->name('lecturer-import');
        Route::get('arsip-pk', 'AdminController@showArsip');
        Route::get('arsip-pk/show', 'AdminController@arsipAdmin');
        Route::get('detailArsip/{id}', 'SeminarController@detailArsip');
        Route::get('newsReport/{id}', 'GroupProjectNewsReportController@getNews');
        Route::put('newsReport/{id}/edit', 'GroupProjectNewsReportController@storeNews');
        Route::get('exportExcel', 'GroupProjectController@export');
        });
    });
        // user
    Route::get('profil', 'ProfileController@index')->name('profil');
    Route::post('profilUpdate/{id}', 'ProfileController@store');
    Route::get('changePassword', 'PasswordController@index');
    Route::post('changePassword', 'PasswordController@update')->name('change.password');
