<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            return redirect()->intended('home');
        }

        // // return back()->withErrors([
        // //     'email' => 'The provided credentials do not match our records.',
        // // ])->onlyInput('email');
        // return back()->with('errorLogin','Email or password Invalid !');
        return redirect()->intended('home');
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/home');
    }

    public function register(){
        return view('register');
    }

    public function registerStore(Request $request){
        // $validatedData=$request->validate([
        //     'name'=>'required',
        //     'email'=>'required|unique:users|email',
        //     'password'=>'required|min:8',
        //     'picture'=>'image|mimes:jpeg,svg,png,jpg|max:4096'
        // ]);
        // if(!empty($request->picture)){
        //     $foto = $request->name.'.'.$request->picture->extension();
        //     $request->picture->move(public_path('img/profil'),$foto);
        //     $validatedData['picture'] = $foto;
        // }else{
        //     $validatedData['picture'] = null;
        // }
        // $validatedData['email_verified_at'] = now();
        // $validatedData['remember_token'] = Str::random(10);
        // $validatedData['password'] = Hash::make($request->password);
        // User::create($validatedData);
        return redirect('/login')->with('daftar','Daftar berhasil, silahkan login');
    }
}
