<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Kabupaten;
use App\Models\BusFacility;
use Carbon\Carbon;




class CariBusController extends Controller
{
    public function cariBus(Request $request){
        $validatedData=$request->validate([
            'awal_id'=>'required',
            'tujuan_id'=>'required',
            'dari'=>'required',
            'sampai'=>'required',
        ]);
        $jadwals = Jadwal::whereHas('rute',function($query) use($validatedData){
            $query->whereHas('awal', function($query) use($validatedData){
                $query->whereHas('kelurahan',function($query) use($validatedData){
                    $query->whereHas('kecamatan',function($query) use($validatedData){
                        $query->whereHas('kabupaten',function($query) use($validatedData){
                            $query->where('nama','like','%'.$validatedData["awal_id"]."%");
                        });
                    });
                });
            });
        })
        ->whereHas('rute',function($query) use($validatedData){
            $query->whereHas('tujuan', function($query) use($validatedData){
                $query->whereHas('kelurahan',function($query) use($validatedData){
                    $query->whereHas('kecamatan',function($query) use($validatedData){
                        $query->whereHas('kabupaten',function($query) use($validatedData){
                            $query->where('nama','like','%'.$validatedData["awal_id"]."%");
                        });
                    });
                });
            });
        })
        ->whereDate('keberangkatan','>=',$validatedData['dari'])
        ->whereDate('keberangkatan','<=',$validatedData['sampai'])
        ->whereDate('keberangkatan','>',now())
        ->where('jumlah_bangku','>',0)
        ->get();

        // $jadwals = Jadwal::whereBetween('keberangkatan', [$validatedData['dari'], $validatedData['sampai']])->get();

        // dump($jadwals);

        // setlocale(LC_TIME, 'id_ID.UTF-8');

        $dari = Carbon::parse($validatedData['dari'])->isoFormat("dddd, D MMMM Y");
        $sampai = Carbon::parse($validatedData['sampai'])->isoFormat("dddd, D MMMM Y");

        // dd($jadwals);
        return view('cariBus',['jadwals'=>$jadwals,
        'tujuan'=>Kabupaten::where('nama','like','%'.$validatedData['tujuan_id'].'%')->first(),
        'awal'=>Kabupaten::where('nama','like','%'.$validatedData['awal_id'].'%')->first(),
        'berangkat' => "dari ".$dari." sampai ".$sampai,
        'kabupatens'=>Kabupaten::all(),
        'facilities'=>BusFacility::all()]);
    }
}
