<?php

namespace App\Http\Controllers;

use App\Models\Kelurahan;
use App\Models\Kecamatan;
use App\Models\Kabupaten;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class KelurahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.kelurahan.index',['kelurahans'=>Kelurahan::latest()->paginate(8)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.kelurahan.create',['kecamatans'=>Kecamatan::all(),'kabupatens'=>Kabupaten::all(),'provinsis'=>Provinsi::all()]);
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
            'nama'=>'required|unique:kelurahans',
            'kecamatan_id'=>'required',
        ]);
        Kelurahan::create($validatedData);
        return redirect('/kelurahan')->with('pesan','Data kelurahan baru berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelurahan  $kelurahan
     * @return \Illuminate\Http\Response
     */
    public function show(Kelurahan $kelurahan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelurahan  $kelurahan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelurahan $kelurahan)
    {
        return view('dashboard.kelurahan.update',['kelurahan'=>$kelurahan,'kecamatans'=>Kecamatan::all(),'kabupatens'=>Kabupaten::all(),'provinsis'=>Provinsi::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelurahan  $kelurahan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kelurahan $kelurahan)
    {
        $validatedData=$request->validate([
            'nama'=>'required|unique:kelurahans',
            'kecamatan_id'=>'required'
        ]);
        Kelurahan::where('id',$kelurahan->id)->update($validatedData);
        return redirect('/kelurahan')->with('pesan','Data kelurahan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelurahan  $kelurahan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelurahan $kelurahan)
    {
        Kelurahan::destroy($kelurahan->id);
        return redirect('/kelurahan')->with('pesan','Data kelurahan berhasil dihapus');
    }

    public function cariKelurahan(Request $request){
        if(!empty(trim($request->cari))){
            $cari = $request['cari'];
            $kelurahans = Kelurahan::where('nama','like','%'.$cari.'%')
            ->orWhereHas('kecamatan',function($query) use($cari){
                $query->where('nama','like','%'.$cari.'%')
                ->orWhereHas('kabupaten',function($query) use($cari){
                    $query->where('nama','like','%'.$cari.'%')
                    ->orWhereHas('provinsi',function($query) use($cari){
                        $query->where('nama','like','%'.$cari.'%');
                    });
                });
            })
            ->latest()->paginate(8);
            return view('dashboard.kelurahan.index',['kelurahans' => $kelurahans]);
        }else{
            return view('dashboard.kelurahan.index',['kelurahans'=>Kelurahan::latest()->paginate(8)]);
        }

    }
}
