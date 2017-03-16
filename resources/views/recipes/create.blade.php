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
                        <strong>Crear Recipe</strong>
                    </div>

                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/recipes') }}">
                            {{ method_field('POST') }}
                            {{ csrf_field() }}

                        <div class="form-group">
                            <label for="doctor" class="col-md-4 control-label">Médico</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control"  value="{{ $medicalrecord->appointment->doctor->name." ".$medicalrecord->appointment->doctor->lastname." (".$medicalrecord->appointment->doctor->specialty->name.")" }}" readonly>
                                <input type="hidden" name="medicalrecord_id" id="medicalrecord_id" value="{{ $medicalrecord->id }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="patient" class="col-md-4 control-label">Paciente</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control"  value="{{ $medicalrecord->appointment->patient->name." ".$medicalrecord->appointment->patient->lastname." | C.I. ".$medicalrecord->appointment->patient->idcard }}" readonly>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('medicines') ? ' has-error' : '' }}">
                            <label for="medicines" class="col-md-4 control-label">Agregar Medicinas</label>
                            <div class="col-md-6">
                                <select name="medicines[]" id="medicines" class="form-control selectpicker" multiple data-max-options="5" data-live-search="true" autofocus>
                                    @foreach($medicines as $medicine)
                                        <option value="{{ $medicine->id }}" @if(old('medicine')==$medicine->id) selected @endif>
                                        {{ $medicine->name }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('medicines'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('medicines') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('indications') ? ' has-error' : '' }}">
                            <label for="indications" class="col-md-4 control-label">Indicaciones</label>

                            <div class="col-md-6">
                                <textarea name="indications" id="indications" cols="50" rows="8">{{ old('indications') }}</textarea>
                                @if($errors->has('indications'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('indications') }}</strong>
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
