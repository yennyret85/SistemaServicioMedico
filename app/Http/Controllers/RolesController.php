<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Validator;
use Auth;

class RolesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        $roles = Role::paginate();
        return view('roles.index', ['roles'=>$roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->can('CrearRole'))
            abort(403);

        return view('roles.create');
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
            'name' => 'required|max:10|alpha',
        ]);

        if($v->fails()){
            return redirect()->back()->withErrors($v)->withInput();
        }

        try{
            \DB::beginTransaction();

            Role::create([
                'name'=>$request->input('name'),
            ]);

        }catch(\Exception $e){
            \DB::rollback();
        }finally{
            \DB::commit();
        }

        return redirect('/roles')->with('mensaje', 'Role ha sido creado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::findOrFail($id);
        return view('roles.show', ['role'=>$role]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Auth::user()->can('EditarRole'))
            abort(403);

        $role = Role::findOrFail($id);
        return view('roles.edit', ['role'=>$role]);
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
            'name' => 'required|max:50|alpha',
        ]);

        if($v->fails()){
            return redirect()->back()->withErrors($v)->withInput();
        }

        try{
            \DB::beginTransaction();

            $role = Role::findOrFail($id);
            $role->update([
                'name'=>$request->input('name'),
            ]);

        }catch(\Exception $e){
            \DB::rollback();
        }finally{
            \DB::commit();
        }

        return redirect('/roles')->with('mensaje', 'Role ha sido editado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            \DB::beginTransaction();
            Role::destroy($id);
        }catch(\Exception $e){
            \DB::rollback();
        }finally{
            \DB::commit();
        }
        return redirect('/roles')->with('mensaje', 'Role ha sido eliminado con exito');
    }

    public function permisos($id){
        if(!Auth::user()->can('PermisosRole'))
            abort(403);

        $role = Role::findOrFail($id);
        $permisos = Permission::all();
        return view('roles.permisos', ['role'=>$role, 'permisos'=>$permisos]);
    }

    public function asignarPermisos(Request $request, $id){
        $role = Role::findOrFail($id);
        $role->revokePermissionTo(Permission::all());
        if($request->input('permisos'))
            $role->givePermissionTo($request->input('permisos'));
        return redirect('/roles')->with('mensaje', 'Permisos Asignados Satisfactoriamente');
    }
    
}
