@extends('layouts.app')

@section('content')
<div class="container">
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
                <div class="panel-heading">Cambiar Cita</div>
                
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/appointments/'.$appointment->id) }}">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="patient" class="col-md-4 control-label">Paciente</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control"  value="{{ $patient->name." ".$patient->lastname }}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="doctor" class="col-md-4 control-label">Medico</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control"  value="{{ $doctor->name." ".$doctor->lastname." (".$doctor->specialty->name.")" }}" readonly>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('appointment_date') ? ' has-error' : '' }}">
                            <label for="appointment_date" class="col-md-4 control-label">Fecha</label>

                            <div class="col-md-6">
                                <input id="appointment_date" type="date" class="form-control" name="appointment_date" value="{{ $appointment->appointment_date or old('appointment_date') }}">

                                @if ($errors->has('appointment_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('appointment_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('appointment_time') ? ' has-error' : '' }}">
                            <label for="appointment_time" class="col-md-4 control-label">Hora</label>

                            <div class="col-md-6">
                                <input id="appointment_time" type="time" class="form-control" name="appointment_time" value="{{ $appointment->appointment_time or old('appointment_time') }}">

                                @if ($errors->has('appointment_time'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('appointment_time') }}</strong>
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
