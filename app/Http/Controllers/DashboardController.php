<?php

namespace App\Http\Controllers;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    public function index(){
        $total_harga = Pesanan::select(DB::raw('SUM(total) as total_harga'))
        ->where('status','dibayar')
        ->whereBetween(DB::raw('YEAR(tanggal_beli)'),[now(),now()])
        // ->orderBy('bulan','asc')
        // ->orderByRaw("DATE_FORMAT(tanggal_beli, '%Y-%m')")
        ->groupBy(DB::raw('MONTHNAME(tanggal_beli)'))
        ->pluck('total_harga');

        $bulan = Pesanan::select(DB::raw('MONTHNAME(tanggal_beli) as bulan'))
        ->where('status','dibayar')
        ->whereBetween(DB::raw('YEAR(tanggal_beli)'),[now(),now()])
        // ->orderByRaw("DATE_FORMAT(tanggal beli, '%Y-%m')")
        ->groupBy(DB::raw('MONTHNAME(tanggal_beli)'))
        ->pluck('bulan');

        // dd($total_harga, $bulan);
        return view('dashboard.index',compact('total_harga','bulan'));

    }

    public function cariTahun(){

    }

    public function download(){

    }
}
