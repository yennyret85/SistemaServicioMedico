<?php

namespace App\Http\Controllers;

use App\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Validator;

class SpecialtiesController extends Controller
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
        $specialties = Specialty::paginate();
        return view('specialties.index', ['specialties'=>$specialties]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->hasPermissionTo('CrearEspecialidad'))
            abort(403);

        return view('specialties.create');
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

            Specialty::create([
                'name'=>$request->input('name'),
            ]);

        }catch(\Exception $e){
            \DB::rollback();
            return redirect('/specialties')->with('mensaje', 'No se pudo procesar su solicitud. Ocurrió un Error Inesperado');
        }finally{
            \DB::commit();
        }

        return redirect('/specialties')->with('mensaje', 'Especialidad creada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $specialty = Specialty::findOrFail($id);
        return view('specialties.show', ['specialty'=>$specialty]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Auth::user()->hasPermissionTo('EditarEspecialidad'))
            abort(403);

        $specialty = Specialty::findOrFail($id);
        return view('specialties.edit', ['specialty'=>$specialty]);
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
        $v = Validator::make($request->all(), [
            'name' => 'required|max:50',
        ]);

        if($v->fails()){
            return redirect()->back()->withErrors($v)->withInput();
        }

        try{
            \DB::beginTransaction();

            $specialty = Specialty::findOrFail($id);
            $specialty->update([
                'name'=>$request->input('name'),
            ]);

        }catch(\Exception $e){
            \DB::rollback();
            return redirect('/specialties')->with('mensaje', 'No se pudo procesar su solicitud. Ocurrió un Error Inesperado');
        }finally{
            \DB::commit();
        }

        return redirect('/specialties')->with('mensaje', 'Especialidad editada con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Auth::user()->hasPermissionTo('EliminarEspecialidad'))
            abort(403);

        try{
            \DB::beginTransaction();
            
            Specialty::destroy($id);
        
        }catch(\Exception $e){
            \DB::rollback();
            return redirect('/specialties')->with('mensaje', 'No se pudo procesar su solicitud. Ocurrió un Error Inesperado');
        }finally{
            \DB::commit();
        }
        return redirect('/specialties')->with('mensaje', 'Especialidad eliminada exitosamente');
    }
}
