<?php

namespace App\Http\Controllers;

use App\Models\Terminal;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Http\Request;

class TerminalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('',['terminals'=>Terminal::latest()->paginate(8)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('',['provinsis'=>Provinsi::all(),'kabupatens'=>Kabupaten::all(),'kecamatans'=>Kecamatan::all(),'kelurahans'=>Kelurahan::all()]);
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
            'provinsi_id'=>'required',
            'kabupaten_id'=>'required',
            'kecamatan_id'=>'required',
            'kelurahan_id'=>'required',
            'deskripsi'=>'required',
            'alamat'=>'required',
        ]);
        Terminal::create($validatedData);
        return redirect('/')->with('pesan','Data terminal baru berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Terminal  $terminal
     * @return \Illuminate\Http\Response
     */
    public function show(Terminal $terminal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Terminal  $terminal
     * @return \Illuminate\Http\Response
     */
    public function edit(Terminal $terminal)
    {
        return view('',['terminal'=>$terminal,'provinsis'=>Provinsi::all(),'kabupatens'=>Kabupaten::all(),'kecamatans'=>Kecamatan::all(),'kelurahans'=>Kelurahan::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Terminal  $terminal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Terminal $terminal)
    {
        $validatedData=$request->validate([
            'nama'=>'required',
            'provinsi_id'=>'required',
            'kabupaten_id'=>'required',
            'kecamatan_id'=>'required',
            'kelurahan_id'=>'required',
            'deskripsi'=>'required',
            'alamat'=>'required',
        ]);
        Terminal::where('id',$terminal->id)->update($validatedData);
        return redirect('/')->with('pesan','Data terminal berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Terminal  $terminal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Terminal $terminal)
    {
        Terminal::destroy($terminal->id);
        return redirect('/')->with('pesan','Data terminal berhasil dihapus');
    }
}
