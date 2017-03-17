@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>Registro de Historia Médica</strong>
                    </div>

                    <div class="panel-body">
                        <form class="form-horizontal">
                            
                            <div class="form-group">
                                <label for="patient" class="col-md-4 control-label">Paciente</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" value="{{ $medicalrecord->appointment->patient->name." ".$medicalrecord->appointment->patient->lastname." | C.I. ". $medicalrecord->appointment->patient->idcard }}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="patient" class="col-md-4 control-label">Doctor</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" value="{{ $medicalrecord->appointment->doctor->name." ".$medicalrecord->appointment->doctor->lastname." (". $medicalrecord->appointment->doctor->specialty->name.")" }}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="reasonforappointment" class="col-md-4 control-label">Motivo de la Consulta</label>
                                <div class="col-md-6">
                                    <textarea cols="40" rows="5">{{ $medicalrecord->reasonforappointment or old('reasonforappointment') }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="physicalevaluation" class="col-md-4 control-label">Evaluación Física</label>
                                <div class="col-md-6">
                                    <textarea cols="40" rows="8">{{ $medicalrecord->physicalevaluation }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="medicalreport" class="col-md-4 control-label">Informe Médico</label>
                                <div class="col-md-6">
                                    <textarea cols="40" rows="10">{{ $medicalrecord->medicalreport }}</textarea>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="button" class=" back-button btn btn-primary">
                                        Regresar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
