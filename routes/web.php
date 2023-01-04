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
use App\Models\Kabupaten;
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
    return view('register');
});

Route::get('/home',function(){
    return view('home',['kabupatens'=>Kabupaten::all()]);
});

Route::get('/bis',function(){
    return view('caribus');
});

Route::get('/about',function(){
    return view('about');
});

Route::get('/loginbaru',function(){
    return view('loginbaru');
});

Route::get('/caribus',function(){
    return view('caribus');
});

Route::get('/kontak',function(){
    return view('kontak');
});

Route::get('/register',[LoginController::class,'register'])->name('register');
Route::post('/register',[LoginController::class,'registerStore']);
Route::get('/login',[LoginController::class,'login'])->name('login')->middleware('guest');
Route::post('/login',[LoginController::class,'authenticate']);
Route::post('/logout',[LoginController::class,'logout']);

Route::resource('provinsi', ProvinsiController::class);
Route::resource('kabupaten', KabupatenController::class);
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

Route::get('cari',[CariBusController::class,'cariBus']);
Route::get('cari-role',[RoleController::class,'cariRole']);
Route::get('cari-provinsi',[ProvinsiController::class,'cariProvinsi']);
Route::get('cari-kabupaten',[KabupatenController::class,'cariKabupaten']);
Route::get('cari-kecamatan',[KecamatanController::class,'cariKecamatan']);
Route::get('cari-kelurahan',[KelurahanController::class,'cariKelurahan']);
Route::get('cari-user',[UserController::class,'cariUser']);
Route::get('cari-tiket',[TiketController::class,'cariTiket']);
Route::get('cari-rute',[RuteController::class,'cariRute']);
Route::get('cari-pesanan',[PesananController::class,'cariPesanan']);
Route::get('cari-class',[ClassBusController::class,'cariClass']);
Route::get('cari-jadwal',[JadwalController::class,'cariJadwal']);
Route::get('cari-facilities',[FacilityController::class,'cariFacility']);
Route::get('cari-buses',[BusController::class,'cariBus']);
Route::get('cari-terminal',[TerminalController::class,'cariTerminal']);

//dashboard
Route::get('/', function () {
    return view('dashboard.index');
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
});

//role
Route::resource('/role', RoleController::class);

//user
Route::get('user', [UserController::class,'index']);
Route::get('user/create', [UserController::class,'create']);
Route::post('user', [UserController::class,'store']);
Route::delete('user/{user}', [UserController::class,'destroy']);
Route::get('user/{user}/edit', [UserController::class,'edit']);
Route::put('user/{user}', [UserController::class,'update']);
