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
                    <div class="panel-heading">Mis Citas</div>

                    <div class="panel-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Paciente</th>
                                <th>Status</th>
                                <th>Acciones</th>
                            </tr>
                            @foreach(Auth::user()->appointments_doctor as $appointment)
                            <tr>
                                <td>{{ $appointment->appointment_date }}</td>
                                <td>{{ $appointment->appointment_time }}</td>
                                <td>{{ $appointment->patient->name." ".$appointment->patient->lastname." | C.I. ".$appointment->patient->idcard }}</td>
                                <td>{{ $appointment->status }}</td>
                                <td>
                                    @if(Auth::user()->hasPermissionTo('VerRecipe'))
                                        <a href="{{ url('/recipes') }}" class="btn btn-primary" title="Ver Recipes" ><i class="fa fa-vcard"></i>
                                        </a>
                                    @endif
                                    @if(Auth::user()->hasPermissionTo('VerHistoriaMedica'))
                                        <a href="{{ url('/medicalrecords') }}" class="btn btn-success" title="Ver Historia Médica"><i class="fa fa-h-square"></i></a>
                                    @endif
                                    @if(Auth::user()->hasPermissionTo('ConcluirCita'))
                                        <a href="{{ url('appointments/'.$appointment->id.'/status') }}" class="btn btn-warning" title="Concluir Cita"><i class="fa fa-calendar-times-o"></i></a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
