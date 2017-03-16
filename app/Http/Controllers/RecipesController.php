<?php

namespace App\Http\Controllers;

use App\Recipe;
use App\MedicalRecord;
use App\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Validator;

class RecipesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipes = Recipe::paginate();
        return view('recipes.index', ['recipes'=>$recipes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id=null)
    {
        if(!Auth::user()->hasPermissionTo('CrearRecipe'))
            abort(403, 'Acceso Prohibido');

        $medicalrecord = MedicalRecord::findOrFail($id);
        $medicines = Medicine::all();
        return view('recipes.create', ['medicines'=>$medicines, 'medicalrecord'=>$medicalrecord]);
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
            'medicalrecord_id' =>'required',
            'indications' => 'required',
        ]);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v)->withInput();
        }

        try {
            \DB::beginTransaction();

            $recipe = Recipe::create([
                'medicalrecord_id'=>$request->input('medicalrecord_id'),
                'indications'=> $request->input('indications'),
            ]);

            //$recipe->medicines()->sync($request->input('medicines'));

        } catch (\Exception $e) {
            var_dump($e);
            \DB::rollback();
            return redirect('/myappointments')->with('mensaje', 'No se pudo procesar su solicitud. Ocurrió un Error Inesperado');
        } finally {
            \DB::commit();
        }
        return redirect('/myappointments')->with('mensaje', 'Recipe creado con Éxito');
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
        if (!Auth::user()->hasPermissionTo('EliminarRecipe'))
            abort(403, 'Permiso Denegado.');

        try{
            \DB::beginTransaction();
            Appointment::destroy($id);
        }catch(\Exception $e){
            \DB::rollback();
            return redirect('/myappointments')->with('mensaje', 'No se pudo procesar su solicitud. Ocurrió un Error Inesperado');
        }finally{
            \DB::commit();
        }
        return redirect('/myappointments')->with('mensaje', 'Recipe eliminado satisfactoriamente');
    }
}
