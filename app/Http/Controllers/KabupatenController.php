<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class KabupatenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.kabupaten.index',['kabupatens'=>Kabupaten::latest()->paginate(8)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.kabupaten.create',['provinsis'=>Provinsi::all()]);
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
            'nama'=>'required|unique:kabupatens',
            'provinsi_id'=>'required',
        ]);
        Kabupaten::create($validatedData);
        return redirect('/kabupaten')->with('pesan','Data kabupaten baru berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kabupaten  $kabupaten
     * @return \Illuminate\Http\Response
     */
    public function show(Kabupaten $kabupaten)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kabupaten  $kabupaten
     * @return \Illuminate\Http\Response
     */
    public function edit(Kabupaten $kabupaten)
    {
        return view('dashboard.kabupaten.update',['kabupaten'=>$kabupaten,'provinsis'=>Provinsi::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kabupaten  $kabupaten
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kabupaten $kabupaten)
    {
        $validatedData=$request->validate([
            'nama'=>'required|unique:kabupatens',
            'provinsi_id'=>'required'
        ]);
        Kabupaten::where('id',$kabupaten->id)->update($validatedData);
        return redirect('/kabupaten')->with('pesan','Data kabupaten berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kabupaten  $kabupaten
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kabupaten $kabupaten)
    {
        Kabupaten::destroy($kabupaten->id);
        return redirect('/kabupaten')->with('pesan','Data kabupaten berhasil dihapus');
    }


    public function cariKabupaten(Request $request){
        if(!empty(trim($request->cari))){
            $cari = $request['cari'];
            $kabupatens = Kabupaten::where('nama','like','%'.$cari.'%')->orWhereHas('provinsi',function($query) use($cari){
                $query->where('nama','like','%'.$cari.'%');
            })->latest()->paginate(8);
            return view('dashboard.kabupaten.index',['kabupatens' => $kabupatens]);
        }else{
            return view('dashboard.kabupaten.index',['kabupatens'=>Kabupaten::latest()->paginate(8)]);
        }

    }
}
