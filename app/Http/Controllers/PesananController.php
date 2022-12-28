<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\User;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.pesanan.index',['pesanans'=>Pesanan::latest()->paginate(8)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pesanan.create',['jadwals'=>Jadwal::all(),'users'=>User::all()]);
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
            'jadwal_id'=>'required',
            'tanggal_pesan'=>'required',
            'jumlah'=>'required',
            'user_id'=>'required',
            'status'=>'required',
            'tanggal_beli'=>'',
            'total'=>'',
        ]);
        // $validatedData['user_id'] = Auth::user()->id;
        Pesanan::create($validatedData);
        return redirect('/pesanan')->with('pesan','Data pesanan baru berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pesanan  $pesanan
     * @return \Illuminate\Http\Response
     */
    public function show(Pesanan $pesanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pesanan  $pesanan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pesanan $pesanan)
    {
        return view('dashboard.pesanan.update',['pesanan'=>$pesanan,'jadwals'=>Jadwal::all(),'users'=>User::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pesanan  $pesanan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pesanan $pesanan)
    {
        $validatedData=$request->validate([
            'jadwal_id'=>'required',
            'tanggal_pesan'=>'required',
            'jumlah'=>'required',
            'user_id'=>'required',
            'status'=>'required',
            'tanggal_beli'=>'',
            'total'=>'',
        ]);
        // $validatedData['user_id'] = Auth::user()->id;
        Pesanan::where('id',$pesanan->id)->update($validatedData);
        return redirect('/pesanan')->with('pesan','Data pesanan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pesanan  $pesanan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pesanan $pesanan)
    {
        Pesanan::destroy($pesanan->id);
        return redirect('/pesanan')->with('pesan','Data pesanan berhasil dihapus');
    }
}
