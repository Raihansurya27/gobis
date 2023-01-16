<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\ClassBus;
use App\Models\BusFacility;
use App\Models\Facility;
use Illuminate\Http\Request;

class BusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.bus.index',['buses'=>Bus::latest()->paginate(8),'facilities'=>Facility::all(),'bus_facilities'=>BusFacility::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.bus.create',['class_buses'=>ClassBus::all(),'facilities'=>Facility::all()]);
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
            'class_bus_id'=>'required',
            'deskripsi'=>'required',
            'bangku'=>'required|numeric',
            'foto'=>'image|mimes:jpeg,svg,png,jpg|max:4096'
        ]);
        if(!empty($request->foto)){
            $foto = $request->nama.'.'.$request->foto->extension();
            $request->foto->move(public_path('img/bus'),$foto);
            $validatedData['foto'] = $foto;
        }else{
            $validatedData['foto'] = null;
        }
        Bus::create($validatedData);
        $latest_bus = Bus::latest()->value('id');
        $facilities = $request->input('facilities');
        foreach ($facilities as $facility_id) {
            $FacilityData['bus_id'] = $latest_bus;
            $FacilityData['facility_id'] = $facility_id;
            BusFacility::create($FacilityData);
        }
        return redirect('/buses')->with('pesan','Data bus baru berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function show(Bus $bus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function edit(Bus $bus)
    {
        return view('dashboard.bus.update',['bus'=>$bus,
         'class_buses'=>ClassBus::all(),
         'facilities'=>Facility::all(),
         'bus_facilities'=>BusFacility::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bus $bus)
    {
        $validatedData=$request->validate([
            'nama'=>'required',
            'class_bus_id'=>'required',
            'deskripsi'=>'required',
            'bangku'=>'required|numeric',
            'foto'=>'image|mimes:jpeg,svg,png,jpg|max:4096'
        ]);
        if(!empty($request->foto)){
            $foto = $request->nama.'.'.$request->foto->extension();
            $request->foto->move(public_path('img/bus'),$foto);
            $validatedData['foto'] = $foto;
        }else{
            $validatedData['foto'] = null;
        }
        Bus::where('id',$bus->id)->update($validatedData);
        BusFacility::where('bus_id',$bus->id)->delete();
        $facilities = $request->input('facilities');
        foreach ($facilities as $facility_id) {
            $FacilityData['bus_id'] = $bus->id;
            $FacilityData['facility_id'] = $facility_id;
            BusFacility::create($FacilityData);
        }
        return redirect('/buses')->with('pesan','Data bus berhasil diupdate');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bus $bus)
    {
        Bus::destroy($bus->id);
        return redirect('/buses')->with('pesan','Data bus berhasil dihapus');
    }

    public function cariBus(Request $request){
        if(!empty(trim($request->cari))){
            $cari = $request['cari'];
            $buses = Bus::where('nama','like','%'.$cari.'%')
            ->orWhereHas('class_bus',function($query) use($cari){
                $query->where('nama','like','%'.$cari.'%');
            })
            ->orWhere('deskripsi','like','%'.$cari.'%')
            ->latest()->paginate(8);
            return view('dashboard.bus.index',['buses' => $buses,'facilities'=>Facility::all(),'bus_facilities'=>BusFacility::all()]);
        }else{
            return view('dashboard.bus.index',['buses' => Bus::latest()->paginate(8),'facilities'=>Facility::all(),'bus_facilities'=>BusFacility::all()]);
        }

    }
}
