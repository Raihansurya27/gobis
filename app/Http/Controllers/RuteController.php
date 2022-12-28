<?php

namespace App\Http\Controllers;

use App\Models\Rute;
use App\Models\Terminal;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Bus;
use Illuminate\Http\Request;

class RuteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.rute.index',['rutes'=>Rute::latest()->paginate(8)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.rute.create',
        ['terminals'=>Terminal::all(),
        'buses'=>Bus::all(),
        'provinsis'=>Provinsi::all(),
        'kabupatens'=>Kabupaten::all(),
        'kecamatans'=>Kecamatan::all(),
        'kelurahans'=>Kelurahan::all()]);
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
            'awal_id'=>'required',
            'tujuan_id'=>'required',
            'bus_id'=>'required',
        ]);
        Rute::create($validatedData);
        return redirect('/rute')->with('pesan','Data rute baru berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rute  $rute
     * @return \Illuminate\Http\Response
     */
    public function show(Rute $rute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rute  $rute
     * @return \Illuminate\Http\Response
     */
    public function edit(Rute $rute)
    {
        return view('dashboard.rute.update',['rute'=>$rute,'terminals'=>Terminal::all(),'buses'=>Bus::all(),
        'provinsis'=>Provinsi::all(),
        'kabupatens'=>Kabupaten::all(),
        'kecamatans'=>Kecamatan::all(),
        'kelurahans'=>Kelurahan::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rute  $rute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rute $rute)
    {
        $validatedData=$request->validate([
            'awal_id'=>'required',
            'tujuan_id'=>'required',
            'bus_id'=>'required',
        ]);
        Rute::where('id',$rute->id)->update($validatedData);
        return redirect('/rute')->with('pesan','Data rute berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rute  $rute
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rute $rute)
    {
        Rute::destroy($rute->id);
        return redirect('/rute')->with('pesan','Data rute berhasil dihapus');
    }
}
