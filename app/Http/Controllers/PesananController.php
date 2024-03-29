<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\User;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'status'=>'required',
            'tanggal_beli'=>'',
            'total'=>'',
        ]);
        $validatedData['user_id'] = Auth::user()->id;
        Pesanan::create($validatedData);
        $jumlah_bangku = Jadwal::find($validatedData['jadwal_id']);
        $jumlah_bangku->jumlah_bangku = $jumlah_bangku->jumlah_bangku - $validatedData['jumlah'];
        $jumlah_bangku->save();
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
            'status'=>'required',
            'tanggal_beli'=>'',
            'total'=>'',
        ]);
        $validatedData['user_id'] = Auth::user()->id;
        $pesanan = Pesanan::find($id);
        $jadwal = Jadwal::find($pesanan->jadwal_id);
        $jadwal->jumlah_bangku = $jadwal->jumlah_bangku + $pesanan->jumlah;

        if($validatedData['jumlah'] > $jadwal->jumlah_bangku){
            return back()->with('pesan','Jumlah bangku yang dimasukkan tidak sesuai dengan jumlah bangku yang tersisa');
            // return redirect()->back()->withErrors($validator)->withInput();
        }else{
            if($validatedData['jumlah'] <= 0){
                return back()->with('pesan','Masukkan jumlah bangku dengan benar');
            }else{
                $jadwal->jumlah_bangku = $jadwal->jumlah_bangku - $validatedData['jumlah'];
                $validatedData['total'] = ($validatedData['jumlah'] * $jadwal->harga);
                $jadwal->save();
                Pesanan::where('id',$pesanan->id)->update($validatedData);
            }
        }
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
        $pesanan = Pesanan::find($id);
        $jadwal = Jadwal::find($pesanan->jadwal_id);
        $jadwal->jumlah_bangku = $jadwal->jumlah_bangku + $pesanan->jumlah;
        $jadwal->save();
        Pesanan::destroy($pesanan->id);
        return redirect('/pesanan')->with('pesan','Data pesanan berhasil dihapus');
    }

    public function cariPesanan(Request $request){
        if(!empty(trim($request->cari))){
            $cari = $request['cari'];
            $pesanans = Pesanan::whereHas('user',function($query) use($cari){
                $query->where('nama','like','%'.$cari.'%');
            })
            ->orWhereHas('jadwal',function($query) use($cari){
                $query->whereHas('rute',function($query) use($cari){
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
                });
            })
            ->orWhere('status','like','%'.$cari.'%')
            ->orWhere('jumlah','=',$cari)
            ->orWhere('total','=',$cari)
            ->latest()->paginate(8);
            return view('dashboard.pesanan.index',['pesanans' => $pesanans]);
        }else{
            return view('dashboard.pesanan.index',['pesanans' => Pesanan::latest()->paginate(8)]);
        }

    }
}
