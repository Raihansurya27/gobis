<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Rute;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.jadwal.index',['jadwals'=>Jadwal::latest()->paginate(8)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.jadwal.create',['rutes'=>Rute::all()]);
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
            'nama'=>'',
            'rute_id'=>'required',
            'keberangkatan'=>'required',
            //Y-m-d H:i:s
            'harga'=>'required|numeric',
        ]);
        $bangku = Rute::where('id',$validatedData['rute_id'])->get();
        $validatedData['jumlah_bangku'] = $bangku[0]->bus->bangku;
        Jadwal::create($validatedData);
        return redirect('/jadwal')->with('pesan','Data jadwal keberangkatan baru berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function show(Jadwal $jadwal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function edit(Jadwal $jadwal)
    {
        return view('dashboard.jadwal.update',['jadwal'=>$jadwal,'rutes'=>Rute::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        $validatedData=$request->validate([
            'nama'=>'',
            'rute_id'=>'required',
            'keberangkatan'=>'required',
            //Y-m-d H:i:s
            'harga'=>'required|numeric',
        ]);
        $bangku = Rute::where('id',$validatedData['rute_id'])->get();
        $validatedData['jumlah_bangku'] = $bangku[0]->bus->bangku;
        Jadwal::where('id',$jadwal->id)->update($validatedData);
        return redirect('/jadwal')->with('pesan','Data jadwal keberangkatan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jadwal $jadwal)
    {
        Jadwal::destroy($jadwal->id);
        return redirect('/jadwal')->with('pesan','Data jadwal keberangkatan berhasil dihapus');
    }

    public function cariJadwal(Request $request){
        if(!empty(trim($request->cari))){
            $cari = $request['cari'];
            $jadwals = Jadwal::whereHas('rute',function($query) use($cari){
                    $query->whereHas('awal',function($query) use($cari){
                        $query->where('nama','like','%'.$cari.'%')
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
                        });
                    })
                    ->orWhereHas('tujuan',function($query) use($cari){
                        $query->where('nama','like','%'.$cari.'%')
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
                        });
                    });
                })
            ->orWhere('harga','=',$cari)
            ->latest()->paginate(8);
            return view('dashboard.jadwal.index',['jadwals' => $jadwals]);
        }else{
            return view('dashboard.jadwal.index',['jadwals' => Jadwal::latest()->paginate(8)]);
        }

    }
}
