<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\MedicalRecord;
use App\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use Validator;
 

class MedicalRecordsController extends Controller
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
        $medicalrecords = MedicalRecord::paginate();
        return view('medicalrecords.index', ['medicalrecords'=>$medicalrecords]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id=null)
    {
        if (!Auth::user()->hasPermissionTo('CrearHistoriaMedica'))
            abort(403, 'Acceso Prohibido');

        $appointment = Appointment::findOrFail($id);

        return view('medicalrecords.create', [ 'appointment'=>$appointment]);
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
            'appointment_id' => 'required',
            'reasonforappointment' => 'required',
            'physicalevaluation' => 'required',
            'medicalreport' => 'required'
        ]);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v)->withInput();
        }

        try {
            \DB::beginTransaction();

            $medicalrecord = MedicalRecord::create([
                'appointment_id'=>$request->input('appointment_id'),
                'reasonforappointment' => $request->input('reasonforappointment'),
                'physicalevaluation' => $request->input('physicalevaluation'),
                'medicalreport' => $request->input('medicalreport'),
            ]);

        } catch (\Exception $e) {
            \DB::rollback();
            if(Auth::user()->hasRole('Medico'))
                return redirect('/myappointments')->with('mensaje', 'No se pudo procesar su solicitud. Ocurrió un Error Inesperado');
            else
                return redirect('/appointments')->with('mensaje', 'No se pudo procesar su solicitud. Ocurrió un Error Inesperado');
        } finally {
            \DB::commit();
        }
        if(Auth::user()->hasRole('Medico'))
            return redirect('/myappointments')->with('mensaje', 'Registro de Historia Médica creado con Éxito');
        else
            return redirect('/appointments')->with('mensaje', 'Registro de Historia Médica creado con Éxito');
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
        if (!Auth::user()->hasPermissionTo('EditarHistoriaMedica'))
            abort(403, 'Acceso Prohibido');

        $medicalrecord = MedicalRecord::findOrFail($id);

        return view('medicalrecords.edit', [ 'medicalrecord'=>$medicalrecord]);
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
            'reasonforappointment' => 'required',
            'physicalevaluation' => 'required',
            'medicalreport' => 'required'
        ]);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v)->withInput();
        }

        try {
            \DB::beginTransaction();

            $medicalrecord = MedicalRecord::findOrFail($id);

            $medicalrecord->update([
                'reasonforappointment' => $request->input('reasonforappointment'),
                'physicalevaluation' => $request->input('physicalevaluation'),
                'medicalreport' => $request->input('medicalreport'),
            ]);

        } catch (\Exception $e) {
            \DB::rollback();
            if(Auth::user()->hasRole('Medico'))
                return redirect('/myappointments')->with('mensaje', 'No se pudo procesar su solicitud. Ocurrió un Error Inesperado');
            else
                return redirect('/medicalrecords')->with('mensaje', 'No se pudo procesar su solicitud. Ocurrió un Error Inesperado');
        } finally {
            \DB::commit();
        }

        if(Auth::user()->hasRole('Medico'))
            return redirect('/myappointments')->with('mensaje', 'Registro de Historia Médica Modificado Exitosamente');
        else
            return redirect('/medicalrecords')->with('mensaje', 'Registro de Historia Médica Modificado Exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::user()->hasPermissionTo('EliminarHistoriaMedica'))
            abort(403, 'Permiso Denegado.');

        try{
            \DB::beginTransaction();
            $medicalrecord = MedicalRecord::findOrFail($id);
            if ($medicalrecord->recipe) {
                $medicalrecord->recipe->medicines()->sync([]);
                $medicalrecord->recipe->destroy($medicalrecord->recipe->id);
            }
            $medicalrecord->destroy($id);
        }catch(\Exception $e){
            \DB::rollback();
            return redirect('/medicalrecords')->with('mensaje', 'No se pudo procesar su solicitud. Ocurrió un Error Inesperado');
        }finally{
            \DB::commit();
        }
        return redirect('/medicalrecords')->with('mensaje', 'Registro de Historia Médica eliminado Exitosamente');
    }

    public function verhistoriamedica($id)
    {
        if(!Auth::user()->hasPermissionTo('VerHistoriaMedica'))
            abort(403, 'Permiso Denegado.');

        $medicalrecord = MedicalRecord::findOrFail($id);    

        return view('medicalrecords.viewmedicalrecord', ['medicalrecord'=>$medicalrecord]);
    }

}
