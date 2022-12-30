<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function login(){
        return view('login');
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            return redirect()->intended('/home');
        }

        // // return back()->withErrors([
        // //     'email' => 'The provided credentials do not match our records.',
        // // ])->onlyInput('email');
        return back()->with('errorLogin','Email or password Invalid !');
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/home');
    }

    public function register(){
        return view('daftar',[
            'provinsis' => Provinsi::all(),
            'kabupatens' => Kabupaten::all(),
            'kecamatans' => Kecamatan::all(),
            'kelurahans' => Kelurahan::all()
        ]);
    }

    public function registerStore(Request $request){
        $validatedData=$request->validate([
            'nama'=>'required',
            'email'=>'required|unique:users|email',
            'password'=>'required|min:8',
            'alamat'=>'required',
            'kelurahan_id'=>'required',
        ]);
        $validatedData['remember_token'] = Str::random(10);
        $validatedData['password'] = Hash::make($request->password);
        User::create($validatedData);
        return redirect('/login')->with('daftar','Daftar berhasil, silahkan login');
    }
}
