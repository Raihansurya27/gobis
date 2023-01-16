<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProvinsiController;
use App\Http\Controllers\KabupatenController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\KelurahanController;
use App\Http\Controllers\ClassBusController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\TerminalController;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\RuteController;
use App\Http\Controllers\CariBusController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
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

Route::get('/welcome', function () {
    return view('welcome');
});


Route::get('/login',function(){
    return view('login');
});

Route::get('/register',function(){
    return view('daftar');
});

Route::get('/',function(){
    return view('home');
});


Route::get('/about',function(){
    return view('about');
});

Route::get('/register',[LoginController::class,'register'])->name('register');
Route::post('/register',[LoginController::class,'registerStore']);
Route::get('/login',[LoginController::class,'login'])->name('login')->middleware('guest');
Route::post('/login',[LoginController::class,'authenticate']);
Route::post('/logout',[LoginController::class,'logout']);

Route::resource('provinsi', ProvinsiController::class)->middleware('auth');
Route::resource('kabupaten', KabupatenController::class)->middleware('auth');
Route::resource('kecamatan', KecamatanController::class);
Route::resource('kelurahan', KelurahanController::class);
Route::resource('class-buses', ClassBusController::class);
Route::resource('facilities', FacilityController::class);
Route::resource('terminal', TerminalController::class);
Route::resource('rute', RuteController::class);
Route::resource('buses', BusController::class);
Route::resource('jadwal', JadwalController::class);
Route::resource('tiket', TiketController::class);
Route::resource('pesanan', PesananController::class);

Route::get('cari',[CariBusController::class,'cariBus'])->middleware('auth');
Route::get('cari-role',[RoleController::class,'cariRole'])->middleware('auth');
Route::get('cari-provinsi',[ProvinsiController::class,'cariProvinsi'])->middleware('auth');
Route::get('cari-kabupaten',[KabupatenController::class,'cariKabupaten'])->middleware('auth');
Route::get('cari-kecamatan',[KecamatanController::class,'cariKecamatan'])->middleware('auth');
Route::get('cari-kelurahan',[KelurahanController::class,'cariKelurahan'])->middleware('auth');
Route::get('cari-user',[UserController::class,'cariUser'])->middleware('auth');
Route::get('cari-tiket',[TiketController::class,'cariTiket'])->middleware('auth');
Route::get('cari-rute',[RuteController::class,'cariRute'])->middleware('auth');
Route::get('cari-pesanan',[PesananController::class,'cariPesanan'])->middleware('auth');
Route::get('cari-class',[ClassBusController::class,'cariClass'])->middleware('auth');
Route::get('cari-jadwal',[JadwalController::class,'cariJadwal'])->middleware('auth');
Route::get('cari-facilities',[FacilityController::class,'cariFacility'])->middleware('auth');
Route::get('cari-buses',[BusController::class,'cariBus'])->middleware('auth');
Route::get('cari-terminal',[TerminalController::class,'cariTerminal'])->middleware('auth');

//dashboard
Route::get('/dashboard', [DashboardController::class,'index'])->middleware('auth');
Route::get('download-pdf',[DashboardController::class,'download'])->middleware('auth');

//role
Route::resource('/role', RoleController::class)->middleware('auth');

//user
Route::get('user', [UserController::class,'index'])->middleware('auth');
Route::get('user/create', [UserController::class,'create'])->middleware('auth');
Route::post('user', [UserController::class,'store'])->middleware('auth');
Route::delete('user/{user}', [UserController::class,'destroy'])->middleware('auth');
Route::get('user/{user}/edit', [UserController::class,'edit'])->middleware('auth');
Route::put('user/{user}', [UserController::class,'update'])->middleware('auth');

// bisnis
Route::resource('order', OrderController::class)->middleware('auth');
Route::get('tiketku/{id}',[OrderController::class,'tampilTiket'])->middleware('auth');
Route::put('bayar/{id}',[OrderController::class,'bayar']);
