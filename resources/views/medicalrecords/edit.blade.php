@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session('mensaje'))
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <strong>Información:</strong> {{ session('mensaje') }}.
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>Modificar Registro de Historia Médica</strong>
                    </div>

                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/medicalrecords/'.$medicalrecord->id) }}">
                            {{ method_field('PUT') }}
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="patient" class="col-md-4 control-label">Paciente</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" value="{{ $medicalrecord->appointment->patient->name." ".$medicalrecord->appointment->patient->lastname." | C.I. ". $medicalrecord->appointment->patient->idcard }}" readonly>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('reasonforappointment') ? ' has-error' : '' }}">
                                <label for="reasonforappointment" class="col-md-4 control-label">Motivo de la Consulta</label>

                                <div class="col-md-6">
                                    <textarea name="reasonforappointment" id="reasonforappointment" cols="50" rows="5" autofocus>{{ $medicalrecord->reasonforappointment or old('reasonforappointment') }}</textarea>
                                    @if($errors->has('reasonforappointment'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('reasonforappointment') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('physicalevaluation') ? ' has-error' : '' }}">
                                <label for="physicalevaluation" class="col-md-4 control-label">Evaluación Física</label>

                                <div class="col-md-6">
                                    <textarea name="physicalevaluation" id="physicalevaluation" cols="50" rows="8">{{ $medicalrecord->physicalevaluation or old('physicalevaluation') }}</textarea>
                                    @if($errors->has('physicalevaluation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('physicalevaluation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('medicalreport') ? ' has-error' : '' }}">
                                <label for="medicalreport" class="col-md-4 control-label">Informe Médico</label>

                                <div class="col-md-6">
                                    <textarea name="medicalreport" id="medicalreport" cols="50" rows="10">{{ $medicalrecord->medicalreport or old('medicalreport') }}</textarea>
                                    @if($errors->has('medicalreport'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('medicalreport') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Guardar
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
