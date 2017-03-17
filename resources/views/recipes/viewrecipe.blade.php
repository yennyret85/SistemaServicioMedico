@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>Recipe</strong>
                    </div>

                    <div class="panel-body">
                        <form class="form-horizontal">
	                        <div class="form-group">
	                            <label for="doctor" class="col-md-4 control-label">Médico</label>
	                            <div class="col-md-6">
	                                <input type="text" class="form-control"  value="{{ $recipe->medicalrecord->appointment->doctor->name." ".$recipe->medicalrecord->appointment->doctor->lastname." (".$recipe->medicalrecord->appointment->doctor->specialty->name.")" }}" readonly>
	                            </div>
	                        </div>

	                        <div class="form-group">
	                            <label for="patient" class="col-md-4 control-label">Paciente</label>
	                            <div class="col-md-6">
	                                <input type="text" class="form-control"  value="{{ $recipe->medicalrecord->appointment->patient->name." ".$recipe->medicalrecord->appointment->patient->lastname." | C.I. ".$recipe->medicalrecord->appointment->patient->idcard }}" readonly>
	                            </div>
	                        </div>

	                        <div class="form-group{{ $errors->has('medicines') ? ' has-error' : '' }}">
	                            <label for="medicines" class="col-md-4 control-label"> Medicinas</label>
	                            <div class="col-md-6">
	                                <input type="text" class="form-control"  value="{{ $recipe->medicines ? join(', ', $recipe->medicines->pluck('name')->toArray()) : 'N/A' }}" readonly>
	                            </div>
	                        </div>

	                        <div class="form-group">
	                            <label for="indications" class="col-md-4 control-label">Indicaciones</label>
	                            <div class="col-md-6">
	                                <textarea cols="40" rows="8" readonly="">{{ $recipe->indications or old('indications') }}</textarea>
	                            </div>
	                        </div>

	                        <div class="form-group">
	                            <label for="Status" class="col-md-4 control-label">Status</label>
	                            <div class="col-md-6">
	                                <input type="text" class="form-control"  value="{{ $recipe->status }}" readonly>
	                            </div>
	                        </div>

	                        @if($recipe->status!='Activo')
		                        <div class="form-group">
		                            <label for="pharmacist_id" class="col-md-4 control-label">Farmaceuta Encargado</label>
		                            <div class="col-md-6">
		                                <input type="text" class="form-control"  value="{{ $recipe->pharmacist->name." ".$recipe->pharmacist->lastname." | C.I. ".$recipe->pharmacist->idcard }}" readonly>
		                            </div>
		                        </div>
		                    @endif

	                        <div class="form-group">
	                            <div class="col-md-6 col-md-offset-4">
	                                <button type="button" class="back-button btn btn-primary">
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
