<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Kelas;
use Illuminate\Http\Request;

class BusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.bus.index',['buses'=>Bus::latest()->paginate(8)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.bus.create',['kelas'=>Kelas::all()]);
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
            'nama_bus'=>'required',
            'kelas_id'=>'required',
            'deskripsi'=>'required',
            'foto'=>'image|mimes:jpeg,svg,png,jpg|max:4096'
        ]);
        if(!empty($request->foto)){
            $foto = $request->nama.'.'.$request->foto->extension();
            $request->foto->move(public_path('img/bus'),$foto);
            $validatedData['foto'] = $foto;
        }else{
            $validatedData['foto'] = null;
        }
        Bus::create($validatedData);
        return redirect('/bus')->with('pesan','Data bus baru berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function show(Bus $bus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function edit(Bus $bus)
    {
        return view('dashboard.bus.update',['buses'=>$bus, 'kelas'=>Kelas::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bus $bus)
    {
        $validatedData=$request->validate([
            'nama'=>'required',
            'kelas_id'=>'required',
            'deskripsi'=>'required',
            'foto'=>'image|mimes:jpeg,svg,png,jpg|max:4096'
        ]);
        if(!empty($request->foto)){
            $foto = $request->nama.'.'.$request->foto->extension();
            $request->foto->move(public_path('img/bus'),$foto);
            $validatedData['foto'] = $foto;
        }else{
            $validatedData['foto'] = null;
        }
        Bus::where('id',$bus->id)->update($validatedData);
        return redirect('/bus')->with('pesan','Data bus berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bus $bus)
    {
        Bus::destroy($bus->id);
        return redirect('/bus')->with('pesan','Data bus berhasil dihapus');
    }
}
