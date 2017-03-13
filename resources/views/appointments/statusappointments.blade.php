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
                <div class="panel-heading">Cambiar Status de Cita</div>
                
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/appointments/'.$appointment->id.'/status') }}">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="patient" class="col-md-4 control-label">Paciente</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control"  value="{{ $patient->name." ".$patient->lastname }}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="doctor" class="col-md-4 control-label">Médico</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control"  value="{{ $doctor->name." ".$doctor->lastname." (".$doctor->specialty->name.")" }}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="appointment_date" class="col-md-4 control-label">Fecha</label>
                            <div class="col-md-6">
                                <input type="date" class="form-control" value="{{ $appointment->appointment_date }}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="appointment_time" class="col-md-4 control-label">Hora</label>
                            <div class="col-md-6">
                                <input type="time" class="form-control" value="{{ $appointment->appointment_time }}" readonly>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            <label for="status" class="col-md-4 control-label">Status</label>
                            <div class="col-md-6">
                                <select name="status" id="status" class="form-control">
                                    <option value="">Seleccione</option>
                                    @foreach($status as $stat)
                                        <option value="{{ $stat }}" @if($appointment->status==$stat) selected @endif >
                                        {{ $stat }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('status'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
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
