<?php

namespace App\Http\Controllers;

use App\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Validator;

class MedicinesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicines = Medicine::paginate();
        return view('medicines.index', ['medicines'=>$medicines]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->hasPermissionTo('CrearMedicina'))
            abort(403);

        return view('medicines.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|max:50',
        ]);

        if($v->fails()){
            return redirect()->back()->withErrors($v)->withInput();
        }

        try{
            \DB::beginTransaction();

            Medicine::create([
                'name'=>$request->input('name'),
            ]);

        }catch(\Exception $e){
            \DB::rollback();
            return redirect('/medicines')->with('mensaje', 'No se pudo procesar su solicitud. Ocurrió un Error Inesperado');
        }finally{
            \DB::commit();
        }

        return redirect('/medicines')->with('mensaje', 'Medicina creada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $medicine = Medicine::findOrFail($id);
        return view('medicines.show', ['medicine'=>$medicine]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Auth::user()->hasPermissionTo('EliminarMedicina'))
            abort(403);

        try{
            \DB::beginTransaction();
            Medicine::destroy($id);
        }catch(\Exception $e){
            \DB::rollback();
            return redirect('/medicines')->with('mensaje', 'No se pudo procesar su solicitud. Ocurrió un Error Inesperado');
        }finally{
            \DB::commit();
        }
        return redirect('/medicines')->with('mensaje', 'Medicina eliminada exitosamente');
    }
}
