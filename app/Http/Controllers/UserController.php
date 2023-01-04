<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.user.index', ['users'=>User::latest()->paginate(8)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.user.create',[
            'roles' => Role::all(),
            'provinsis' => Provinsi::all(),
            'kabupatens' => Kabupaten::all(),
            'kecamatans' => Kecamatan::all(),
            'kelurahans' => Kelurahan::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData=$request->validate([
            'nama'=>'required',
            'email'=>'required|unique:users|email',
            'password'=>'min:8|required',
            'role_id'=>'required',
            'kelurahan_id'=>'required',
            'alamat'=>'required',
        ]);
        $validatedData['remember_token'] = Str::random(10);
        $validatedData['password'] = Hash::make($request->password);
        User::create($validatedData);
        return redirect('/user')->with('pesan','Data pengguna berhasil diupdate');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('dashboard.user.update',['user' => $user,
            'roles' => Role::all(),
            'provinsis' => Provinsi::all(),
            'kabupatens' => Kabupaten::all(),
            'kecamatans' => Kecamatan::all(),
            'kelurahans' => Kelurahan::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData=$request->validate([
            'nama'=>'required',
            'email'=>'required|email',
            'password'=>'min:8|required',
            'role_id'=>'required',
            'kelurahan_id'=>'required',
            'alamat'=>'required',
        ]);
        $validatedData['remember_token'] = Str::random(10);
        $validatedData['password'] = Hash::make($request->password);
        User::where('id',$id)->update($validatedData);
        return redirect('/user')->with('pesan','Data pengguna berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect('/user')->with('pesan','Data pengguna berhasil dihapus');
    }

    public function cariUser(Request $request){
        if(!empty(trim($request->cari))){
            $cari = $request['cari'];
            $users = User::where('nama','like','%'.$cari.'%')
            ->orWhereHas('role',function($query) use($cari){
                $query->where('nama','like','%'.$cari.'%');
            })->orWhere('email','like','%'.$cari.'%')
            ->orWhere('alamat','like','%'.$cari.'%')
            ->orWhereHas('kelurahan',function($query) use($cari){
                $query->where('nama','like','%'.$cari.'%')
                ->orWhereHas('kecamatan',function($query) use($cari){
                    $query->where('nama','like','%'.$cari.'%')
                    ->orWhereHas('kabupaten',function($query) use($cari){
                        $query->where('nama','like','%'.$cari.'%')
                        ->orWhereHas('provinsi',function($query) use($cari){
                            $query->where('nama','like','%'.$cari.'%');
                        });
                    });
                });
            })->latest()->paginate(8);
            return view('dashboard.user.index',['users' => $users]);
        }else{
            return view('dashboard.user.index',['users'=>User::latest()->paginate(8)]);
        }

    }
}
