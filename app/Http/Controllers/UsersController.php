<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Validator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::paginate();
        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create()
    {
        if(!Auth::user()->can('CrearUsuario'))
            abort(403, 'Acceso Prohibido');

        $roles = Role::all();
        $specialties = Specialty::all();
        return view('users.create', ['roles'=>$roles, 'specialties'=>$specialties]);
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
            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            'idcard' => 'required|max:8|unique:users',
            'sex' => 'required|max:1',
            'birtdate' => 'required|date',
            'phone' => 'max:255',
            'cellphone' => 'max:255',
            'address' => 'max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'role' => 'required',
            'specialty' => 'required_if:role,Medico',
        ]);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v)->withInput();
        }

        try {
            \DB::beginTransaction();

            $user = User::create([
                'name' => $request->input('name'),
                'lastname' => $request->input('lastname'),
                'idcard' => $request->input('idcard'),
                'sex' => $request->input('sex'),
                'birtdate' => $request->input('birtdate'),
                'phone' => $request->input('phone'),
                'cellphone' => $request->input('cellphone'),
                'address' => $request->textarea('address'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'specialty_id' => $request->input('specialty'),
            ]);

            $user->assignRole($request->input('role'));

        } catch (\Exception $e) {
            \DB::rollback();
        } finally {
            \DB::commit();
        }
        return redirect('/users')->with('mensaje', 'Usuario creado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Auth::user()->can('EditarUsuario'))
            abort(403,'Acceso Prohibido');

        $user = User::findOrFail($id);
        $roles = Role::all();
        $specialties = Specialty::all();
        return view('users.edit', ['user'=>$user, 'roles'=>$roles, 'specialties'=>$specialties]);
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
            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            'idcard' => 'required|max:8|unique:users,idcard,'.$id.',id',
            'sex' => 'required|max:1',
            'birtdate' => 'required|date',
            'phone' => 'max:255',
            'cellphone' => 'max:255',
            'address' => 'max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$id.',id',
            'role' => 'required',
            'specialty' => 'required_if:role,Medico',
        ]);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v)->withInput();
        }

        try {
            \DB::beginTransaction();

            $user = User::findOrFail($id);

            $user->update([
                'name' => $request->input('name'),
                'lastname' => $request->input('lastname'),
                'idcard' => $request->input('idcard'),
                'sex' => $request->input('sex'),
                'birtdate' => $request->input('birtdate'),
                'phone' => $request->input('phone'),
                'cellphone' => $request->input('cellphone'),
                'address' => $request->textarea('address'),
                'email' => $request->input('email'),
                'specialty_id' => $request->input('specialty'),
            ]);

            if($request->input('password')){
                $v = Validator::make($request->all(),
                    [
                        'password' => 'required|min:6|confirmed',
                    ]);

                if ($v->fails())
                {
                    return redirect()->back()->withErrors($v)->withInput();
                }
                $user->update([
                    'password' => bcrypt($request->input('password')),
                ]);
            }

            $user->syncRoles($request->input('role'));

        }catch (\Exception $e){
            echo $e->getMessage();
            \DB::rollback();
        }finally{
            \DB::commit();
        }

        return redirect('/users')->with('mensaje', 'Usuario actualizado satisfactoriamente');
    } //AQUI EL RETURN PUEDO CAMBIARLO PARA QUE DE ACUERDO AL ROL DE LA PERSONA ME REDIRIJA  A LA PAGINA DE INDEX DE ESE ROL.

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        //
    }
}
