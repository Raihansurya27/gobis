<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Pesanan;
use App\Models\User;
use App\Models\Tiket;
use Carbon\Carbon;
use PDF;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notif = Pesanan::where('user_id',Auth::user()->id)->where('status','dipesan')->orderBy('status','desc')->get();
        return view('tiket',['notif'=>$notif,'pesanans'=>Pesanan::where('user_id',Auth::user()->id)->orderBy('status','desc')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dump($request->jadwal_id);
        $validatedData=$request->validate([
            'jadwal_id'=>'required',
            'jumlah'=>'required',
        ]);
        $jadwal = Jadwal::where('id',$validatedData['jadwal_id'])->first();
        $validatedData['user_id'] = Auth::user()->id;
        $validatedData['total'] = ($validatedData['jumlah'] * $jadwal->harga);
        // dump($validatedData['total']);
        if($validatedData['jumlah'] > $jadwal->jumlah_bangku){
            return back();
            // return redirect()->back()->withErrors($validator)->withInput();
        }else{
            if($validatedData['jumlah'] <= 0){
                return back();
            }else{
                Pesanan::create($validatedData);
                $jumlah_bangku = Jadwal::find($validatedData['jadwal_id']);
                $jumlah_bangku->jumlah_bangku = $jadwal->jumlah_bangku - $validatedData['jumlah'];
                $jumlah_bangku->save();
            }
        }

        return redirect('/order')->with('pesan','Tiket bus anda berhasil dipesanan');

        // $validatedData['total'] =
        // $validatedData['user_id'] = Auth::user()->id;
        // Pesanan::create($validatedData);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dump(Jadwal::where('id',$id)->get());
        return view('detailbus',['jadwal'=>Jadwal::where('id',$id)->first()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pesanan = Pesanan::where('id',$id)->first();
        // dump($pesanan);
        return view('detailbus-update',['pesanan'=>$pesanan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData=$request->validate([
            'jumlah'=>'required',
        ]);

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
                $pesanan->jumlah = $validatedData['jumlah'];
                $pesanan->total = ($validatedData['jumlah'] * $jadwal->harga);
                $jadwal->save();
                $pesanan->save();
            }
        }

        return redirect('/order')->with('pesan','Tiket bus anda berhasil dipesanan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $pesanan = Pesanan::find($id);
        $jadwal = Jadwal::find($pesanan->jadwal_id);
        $jadwal->jumlah_bangku = $jadwal->jumlah_bangku + $pesanan->jumlah;
        $jadwal->save();
        Pesanan::destroy($id);
        return redirect('/order')->with('pesan','Tiket pesanan berhasil dihapus');
    }

    public function tampilTiket($id){
        $tikets = Tiket::where('pesanan_id',$id)->get();
        $pdf = PDF::loadView('tiket2',compact('tikets'));
        $pdf->setPaper('A4','landscape');
        return $pdf->stream('Tiket '.Auth::user()->nama.'.pdf');
        // return view('tiket2',['tikets'=>$tikets]);
    }

    public function bayar($id){
        // echo "disini";
        $pesanan = Pesanan::find($id);
        $pesanan->status = "dibayar";
        $pesanan->tanggal_beli = now();
        $pesanan->save();
        for ($i=0; $i <$pesanan->jumlah; $i++) {
            $validatedTickets['kode_tiket'] = "TKT".now();
            $validatedTickets['pesanan_id'] = $pesanan->id;
            Tiket::create($validatedTickets);
        }

        return redirect('/order')->with('pesan','Pembayaran tiket berhasil');
    }
}
