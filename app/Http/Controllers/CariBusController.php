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
        $jadwals = Jadwal::with(['rute'=>function($query) use($validatedData){
            $query->with(['awal'=>function($query) use($validatedData){
                $query->with(['kelurahan'=>function($query) use($validatedData){
                    $query->with(['kecamatan'=>function($query) use($validatedData){
                        $query->where('kabupaten_id',$validatedData['awal_id']);
                    }]);
                }]);
            },'tujuan'=>function($query) use($validatedData){
                $query->with(['kelurahan'=>function($query) use($validatedData){
                    $query->with(['kecamatan'=>function($query) use($validatedData){
                        $query->where('kabupaten_id',$validatedData['tujuan_id']);
                    }]);
                }]);
            }]);
        }])
        ->whereDate('keberangkatan','>=',$validatedData['dari'])
        ->whereDate('keberangkatan','<=',$validatedData['sampai'])
        ->get();

        // $jadwals = Jadwal::whereBetween('keberangkatan', [$validatedData['dari'], $validatedData['sampai']])->get();

        // dump($jadwals);

        // setlocale(LC_TIME, 'id_ID.UTF-8');

        $dari = Carbon::parse($validatedData['dari'])->isoFormat("dddd, D MMMM Y");
        $sampai = Carbon::parse($validatedData['sampai'])->isoFormat("dddd, D MMMM Y");


        return view('cariBus',['jadwals'=>$jadwals,
        'tujuan'=>Kabupaten::where('id',$validatedData['tujuan_id'])->get(),
        'awal'=>Kabupaten::where('id',$validatedData['awal_id'])->get(),
        'berangkat' => "dari ".$dari." sampai ".$sampai,
        'kabupatens'=>Kabupaten::all(),
        'facilities'=>BusFacility::all()]);
    }
}
