<?php

namespace App\Http\Controllers;

use App\User;
use App\Specialty;
use App\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Validator;

class AppointmentsController extends Controller
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
        $appointments = Appointment::paginate();
        return view('appointments.index', ['appointments'=>$appointments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->hasPermissionTo('AsignarCita'))
            abort(403, 'Acceso Prohibido');

        $patients = User::role('Paciente')->get();
        $doctors = User::role('Medico')->get();
        return view('appointments.create', ['patients'=>$patients, 'doctors'=>$doctors]);
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
            'patient' => 'required',
            'doctor' => 'required',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
        ]);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v)->withInput();
        }

        try {
            $patient = User::findOrFail($request->input('patient'));
            $doctor = User::findOrFail($request->input('doctor'));

            \DB::beginTransaction();
            Appointment::create([
                'patient_id' => $request->input('patient'),
                'doctor_id' => $doctor->id,
                'specialty_id' => $doctor->specialty_id,
                'appointment_date' => $request->input('appointment_date'),
                'appointment_time' => $request->input('appointment_time'),
                'status' => ($request->input('status')!='')?$request->input('status'):'Asignada',
            ]);
        } catch (\Exception $e) {
            \DB::rollback();
            return redirect('/appointments')->with('mensaje', 'No se pudo procesar su solicitud. Ocurrió un Error Inesperado');
        } finally {
            \DB::commit();
        }
        return redirect('/appointments')->with('mensaje', 'Cita creada Exitosamente');
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
        if(!Auth::user()->hasPermissionTo('EditarCita'))
            abort(403, 'Acceso Prohibido');

        $appointment = Appointment::findOrFail($id);
        $patient = $appointment->patient;
        $doctor = $appointment->doctor;
        return view('appointments.edit', ['patient'=>$patient, 'doctor'=>$doctor, 'appointment'=>$appointment]);
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
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
        ]);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v)->withInput();
        }

        try {
            $doctor = Appointment::findOrFail($request->input('doctor'));
            $patient = Appointment::findOrFail($request->input('patient'));

            \DB::beginTransaction();

            $appointment = Appointment::findOrFail($id);

            $appointment->update([
                //'patient_id' => $request->input('patient_id'),
                //'doctor_id' => $doctor->id,
                'appointment_date' => $request->input('appointment_date'),
                'appointment_time' => $request->input('appointment_time'),
            ]);
        } catch (\Exception $e) {
            \DB::rollback();
            return redirect()->back()->with('mensaje', 'No se pudo procesar su solicitud. Ocurrió un Error Inesperado');
        } finally {
            \DB::commit();
        }
        return redirect('/appointments')->with('mensaje', 'Cita Modificada Exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::user()->hasPermissionTo('EliminarCita'))
            abort(403, 'Permiso Denegado.');

        try{
            \DB::beginTransaction();
            Appointment::destroy($id);
        }catch(\Exception $e){
            \DB::rollback();
            return redirect('/appointments')->with('mensaje', 'No se pudo procesar su solicitud. Ocurrió un Error Inesperado');
        }finally{
            \DB::commit();
        }
        return redirect('/appointments')->with('mensaje', 'Cita ha sido eliminada satisfactoriamente');
    }

    public function vistastatus($id)
    {
        $appointment = Appointment::findOrFail($id);
        $patient = $appointment->patient;
        $doctor = $appointment->doctor;
        $status = ['Asignada', 'Concluida', 'Cancelada'];
        return view('appointments.statusappointments', ['appointment'=>$appointment, 'patient'=>$patient, 'doctor'=>$doctor, 'status'=>$status]);
    }

    public function cambiarstatus(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        $v = Validator::make($request->all(), [
            'status' => Auth::user()->hasRole('Medico')? '' : 'required',
        ]);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v)->withInput();
        }

        try {
            
            \DB::beginTransaction();

            $appointment = Appointment::findOrFail($id);

            $appointment->update([
                'status' => Auth::user()->hasRole('Medico')? 'Concluida' : $request->input('status'),
            ]);
        } catch (\Exception $e) {
            \DB::rollback();

            return redirect()->back()->with('mensaje', 'No se pudo procesar su solicitud. Ocurrió un Error Inesperado');
        } finally {
            \DB::commit();
        }

        return redirect(Auth::user()->hasRole('Medico')? "/myappointments" : '/appointments')->with('mensaje', 'Cambio de Status de Cita realizado satisfactoriamente');
    }

    public function vermiscitas()
    {
        if(!Auth::user()->hasPermissionTo('VerMisCitas'))
            abort(403, 'Permiso Denegado.');

        if(Auth::user()->hasRole('Paciente'))
            return view('patients.myappointments');

        if(Auth::user()->hasRole('Medico'))
            return view('doctors.myappointments');
    }
}
