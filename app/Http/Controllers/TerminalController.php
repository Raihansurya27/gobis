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
        return view('dashboard.terminal.index',['terminals'=>Terminal::latest()->paginate(8)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.terminal.create',['provinsis'=>Provinsi::all(),'kabupatens'=>Kabupaten::all(),'kecamatans'=>Kecamatan::all(),'kelurahans'=>Kelurahan::all()]);
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
            'kelurahan_id'=>'required',
            'deskripsi'=>'required',
            'alamat'=>'required',
        ]);
        Terminal::create($validatedData);
        return redirect('/terminal')->with('pesan','Data terminal baru berhasil ditambah');
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
        return view('dashboard.terminal.update',['terminal'=>$terminal,'provinsis'=>Provinsi::all(),'kabupatens'=>Kabupaten::all(),'kecamatans'=>Kecamatan::all(),'kelurahans'=>Kelurahan::all()]);
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
            'kelurahan_id'=>'required',
            'deskripsi'=>'required',
            'alamat'=>'required',
        ]);
        Terminal::where('id',$terminal->id)->update($validatedData);
        return redirect('/terminal')->with('pesan','Data terminal berhasil diupdate');
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
        return redirect('/terminal')->with('pesan','Data terminal berhasil dihapus');
    }

    public function cariTerminal(Request $request){
        if(!empty(trim($request->cari))){
            $cari = $request['cari'];
            $terminals = Terminal::where('nama','like','%'.$cari.'%')
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
            })
            ->orWhere('alamat','like','%'.$cari.'%')
            ->orWhere('deskripsi','like','%'.$cari.'%')
            ->latest()->paginate(8);
            return view('dashboard.terminal.index',['terminals' => $terminals]);
        }else{
            return view('dashboard.terminal.index',['terminals' => Terminal::latest()->paginate(8)]);
        }

    }
}
