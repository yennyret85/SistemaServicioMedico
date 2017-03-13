<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Appointment;
use App\Specialty;
use App\User;
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
        if(!Auth::user()->can('AsignarCita'))
            abort(403, 'Acceso Prohibido');

        $patients = User::role('Paciente')->get();
        $doctors = User::role('Medico')->get();
        $specialties = Specialty::all();
        return view('appointments.create', ['patients'=>$patients, 'doctors'=>$doctors, 'specialties'=>$specialties]);
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
            'specialty' => 'required',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
        ]);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v)->withInput();
        }

        try {
            $patient = User::findOrFail($request->input('patient'));
            $specialty = User::findOrFail($request->input('specialty'));
            $doctor = User::findOrFail($request->input('doctor'));

            \DB::beginTransaction();
            Appointment::create([
                'patient_id' => $request->input('patient'),
                'doctor_id' => $doctor->id,
                'specialty_id' => $specialty->id,
                'appointment_date' => $request->input('appointment_date'),
                'appointment_time' => $request->input('appointment_time'),
            ]);
        } catch (\Exception $e) {
            var_dump($e);
            \DB::rollback();

            return redirect()->back()->with('mensaje', 'No se pudo procesar su solicitud. Ocurrió un Error Inesperado');
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
        if(!Auth::user()->can('EditarCita'))
            abort(403, 'Acceso Prohibido');

        $patient = User::role('Paciente')->get();
        $doctor = User::role('Medico')->get();
        $specialties = Specialty::all();
        return view('appointments.create', ['patient'=>$patient, 'doctor'=>$doctor, 'specialties'=>$specialties]);
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
        
        try {
            $doctor = User::findOrFail($request->input('doctor'));
            $patient = User::findOrFail($request->input('patient'));
            \DB::beginTransaction();
            Cita::edit([
                'patient_id' => $request->input('patient_id'),
                'specialty_id' => $doctor->specialty->id,
                'doctor_id' => $doctor->id,
                'appointment_date' => $request->input('appointment_date'),
                'appointment_time' => $request->input('appointment_time'),
                'status' => $request->input('status'),
                'reason_for_appointment' => $request->input('reason_for_appointment'),
            ]);
        } catch (\Exception $e) {
            \DB::rollback();
            return redirect('/appointments')->with('mensaje', 'No se pudo procesar su solicitud. Ocurrió un Error Inesperado');
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
        if (!Auth::user()->can('EliminarCita'))
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

    public function vermiscitas()
    {
        if(!Auth::user()->can('VerMisCitas'))
            abort(403, 'Permiso Denegado.');

        return view('patients.myappointments');
    }

    public function vertodaslascitas()
    {
        if(!Auth::user()->can('VerTodasLasCitas'))
            abort(403, 'Permiso Denegado.');
        
        return view('patients.allappointments');
    }
}
