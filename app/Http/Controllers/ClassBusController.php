<?php

namespace App\Http\Controllers;

use App\Models\ClassBus;
use Illuminate\Http\Request;

class ClassBusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.kelas.index',['class_buses'=>ClassBus::latest()->paginate(8)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.kelas.create');
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
            'nama'=>'required|unique:class_buses',
        ]);
        ClassBus::create($validatedData);
        return redirect('/class-buses')->with('pesan','Data kelas bus baru berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClassBus  $classBus
     * @return \Illuminate\Http\Response
     */
    public function show(ClassBus $classBus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClassBus  $classBus
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassBus $classBus)
    {
        return view('dashboard.kelas.update',['class_bus'=>$classBus]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClassBus  $classBus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClassBus $classBus)
    {
        $validatedData=$request->validate([
            'nama'=>'required|unique:class_buses',
        ]);
        ClassBus::where('id',$classBus->id)->update($validatedData);
        return redirect('/class-buses')->with('pesan','Data kelas bus berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClassBus  $classBus
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClassBus $classBus)
    {
        ClassBus::destroy($classBus->id);
        return redirect('/class-buses')->with('pesan','Data kelas bus berhasil dihapus');
    }

    public function cariClass(Request $request){
        if(!empty(trim($request->cari))){
            $cari = $request['cari'];
            $classbuses = ClassBus::where('nama','like','%'.$cari.'%')->latest()->paginate(8);
            return view('dashboard.kelas.index',['class_buses' => $classbuses]);
        }else{
            return view('dashboard.kelas.index',['class_buses' => ClassBus::latest()->paginate(8)]);
        }

    }
}
