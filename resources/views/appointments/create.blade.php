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
                <div class="panel-heading">Crear Cita</div>
                
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/appointments') }}">
                        {{ method_field('POST') }}
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('patient') ? ' has-error' : '' }}">
                            <label for="patient" class="col-md-4 control-label">Paciente</label>

                            <div class="col-md-6">
                            <select name="patient" id="patient" class="form-control">
                                <option value="">Seleccione</option>
                                @foreach($patients as $patient)
                                    <option value="{{ $patient->id }}" @if(old('patient')==$patient->id) selected @endif> {{ $patient->name}} {{ $patient->lastname}}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('patient'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('patient') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('specialty') ? ' has-error' : '' }}">
                            <label for="specialty" class="col-md-4 control-label">Especialidad</label>

                            <div class="col-md-6">
                            <select name="specialty" id="specialty" class="form-control">
                                <option value="">Seleccione</option>
                                @foreach($specialties as $specialty)
                                    <option value="{{ $specialty->id }}" @if(old('specialty')==$specialty->id) selected @endif> {{ $specialty->name}} {{ $specialty->lastname}}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('specialty'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('specialty') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('doctor') ? ' has-error' : '' }}">
                            <label for="doctor" class="col-md-4 control-label">Médico</label>

                            <div class="col-md-6">
                            <select name="doctor" id="doctor" class="form-control">
                                <option value="">Seleccione</option>
                                @foreach($doctors as $doctor)
                                    <option value="{{ $doctor->id }}" @if(old('doctor')==$doctor->id) selected @endif> {{ $doctor->name}} {{ $doctor->lastname}}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('doctor'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('doctor') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('appointment_date') ? ' has-error' : '' }}">
                            <label for="appointment_date" class="col-md-4 control-label">Fecha</label>

                            <div class="col-md-6">
                                <input id="appointment_date" type="date" class="form-control" name="appointment_date" value="{{ old('appointment_date') }}">

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
                                <input id="appointment_time" type="time" class="form-control" name="appointment_time" value="{{ old('appointment_time') }}">

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
