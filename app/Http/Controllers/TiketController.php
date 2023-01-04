<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class TiketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.tiket.index',['tikets'=>Tiket::latest()->paginate(8)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.tiket.create',['pesanans'=>Pesanan::all()]);
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
            'kode_tiket'=>'required',
            'pesanan_id'=>'required',
        ]);
        Tiket::create($validatedData);
        return redirect('/tiket')->with('pesan','Data tiket baru berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tiket  $tiket
     * @return \Illuminate\Http\Response
     */
    public function show(Tiket $tiket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tiket  $tiket
     * @return \Illuminate\Http\Response
     */
    public function edit(Tiket $tiket)
    {
        return view('dashboard.tiket.update',['tiket'=>$tiket,'pesanans'=>Pesanan::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tiket  $tiket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tiket $tiket)
    {
        $validatedData=$request->validate([
            'kode_tiket'=>'required',
            'pesanan_id'=>'required',
        ]);
        Tiket::where('id',$tiket->id)->update($validatedData);
        return redirect('/tiket')->with('pesan','Data tiket berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tiket  $tiket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tiket $tiket)
    {
        Tiket::destroy($tiket->id);
        return redirect('/tiket')->with('pesan','Data tiket berhasil dihapus');
    }

    public function cariTiket(Request $request){
        if(!empty(trim($request->cari))){
            $cari = $request['cari'];
            $tikets = Tiket::where('kode_tiket','like','%'.$cari.'%')
            ->orWhereHas('pesanan',function($query) use($cari){
                $query->whereHas('user',function($query) use($cari){
                    $query->where('nama','like','%'.$cari.'%');
                });
            })
            ->latest()->paginate(8);
            return view('dashboard.tiket.index',['tikets' => $tikets]);
        }else{
            return view('dashboard.tiket.index',['tikets'=>Tiket::latest()->paginate(8)]);
        }

    }
}
