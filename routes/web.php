<?php

use App\Http\Controllers\bukuAjaxcontroller;
use App\Http\Controllers\jualAjaxcontroller;
use App\Http\Controllers\pegawaiAjaxcontroller;
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
//     return view('welcome');
// });

//pegawai
Route::get('/pegawai', function(){
    return view('pegawai.index');
});

Route::resource('pegawaiAjax', pegawaiAjaxcontroller::class);

//buku
Route::get('/buku', function(){
    return view('buku.index');
});

Route::resource('bukuAjax', bukuAjaxcontroller::class);

Route::get('/', function(){
    return view('penjualan.index');
});

Route::resource('jualanAjax', jualAjaxcontroller::class);
