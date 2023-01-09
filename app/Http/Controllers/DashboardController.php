<?php

namespace App\Http\Controllers;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use DB;
use PDF;

class DashboardController extends Controller
{
    public function index(){
        $total_harga = Pesanan::select(DB::raw('SUM(total) as total_harga'))
        ->where('status','dibayar')
        ->whereBetween(DB::raw('YEAR(tanggal_beli)'),[now(),now()])
        ->orderBy('total_harga','desc')
        // ->orderByRaw("DATE_FORMAT(tanggal_beli, '%Y-%m')")
        ->groupBy(DB::raw('MONTHNAME(tanggal_beli)'))
        ->pluck('total_harga');

        $bulan = Pesanan::select(DB::raw('MONTHNAME(tanggal_beli) as bulan'))
        ->where('status','dibayar')
        ->whereBetween(DB::raw('YEAR(tanggal_beli)'),[now(),now()])
        ->orderBy('bulan','desc')
        ->groupBy(DB::raw('MONTHNAME(tanggal_beli)'))
        ->pluck('bulan');

        // dd($total_harga, $bulan);
        return view('dashboard.index',compact('total_harga','bulan'));

    }


    public function download(){
        $total_hargas = Pesanan::select(DB::raw('MONTHNAME(tanggal_beli) as bulan'),DB::raw('SUM(total) as total_harga'),DB::raw('COUNT(*) as tiket'))
        ->where('status','dibayar')
        ->whereBetween(DB::raw('YEAR(tanggal_beli)'),[now(),now()])
        ->orderBy('bulan','desc')
        ->groupBy(DB::raw('MONTHNAME(tanggal_beli)'))
        ->get();
        $pdf = PDF::loadView('laporan',compact('total_hargas'));
        $pdf->setPaper('A4','landscape');
        return $pdf->stream('Penjualan-'.now()->year.'.pdf');
        // return view('laporan',compact('total_hargas'));
    }
}
