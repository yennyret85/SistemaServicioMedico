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
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Mis Citas</div>

                    <div class="panel-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Paciente</th>
                                <th>Status</th>
                                <th width="10%" colspan="5">Acciones</th>
                            </tr>
                            @foreach(Auth::user()->appointments_doctor as $appointment)
                            <tr>
                                <td>{{ $appointment->appointment_date }}</td>
                                <td>{{ $appointment->appointment_time }}</td>
                                <td>{{ $appointment->patient->name." ".$appointment->patient->lastname." | C.I. ".$appointment->patient->idcard }}</td>
                                <td>{{ $appointment->status }}</td>
                                <td>
                                    @if(Auth::user()->hasPermissionTo('CrearHistoriaMedica') && !$appointment->medicalrecord )
                                        <a href="{{ url('/medicalrecords/create/'.$appointment->id) }}" class="btn btn-success" title="Crear Historia Médica"><i class="fa fa-h-square"></i></a>
                                    @else
                                        <button class="btn btn-success" title="Crear Historia Médica" disabled><i class="fa fa-h-square"></i></button>
                                    @endif
                                </td>

                                <td>
                                    @if(Auth::user()->hasPermissionTo('EditarHistoriaMedica') && $appointment->medicalrecord)
                                        <a href="{{ url('/medicalrecords/'.$appointment->medicalrecord->id.'/edit') }}" class="btn btn-success" title="Modificar Historia Médica"><i class="fa fa-edit"></i></a>
                                    @else
                                        <button class="btn btn-success" title="Modificar Historia Médica" disabled><i class="fa fa-edit"></i></button>
                                    @endif
                                </td>

                                <td>
                                    @if(Auth::user()->hasPermissionTo('CrearRecipe') && $appointment->medicalrecord && !$appointment->medicalrecord->recipe)
                                        <a href="{{ url('/recipes/create/'.$appointment->medicalrecord->id) }}" class="btn btn-primary" title="Crear Recipe"><i class="fa fa-file-text"></i></a>
                                    @else
                                        <button class="btn btn-info" title="Crear Recipe" disabled><i class="fa fa-file-text"></i></button>
                                    @endif
                                </td>
                                
                                <td>
                                    @if(Auth::user()->hasPermissionTo('EditarRecipe') && $appointment->medicalrecord && $appointment->medicalrecord->recipe )
                                        <a href="{{ url('/recipes/'.$appointment->medicalrecord->recipe->id.'/edit') }}" class="btn btn-primary" title="Modificar Recipe"><i class="fa fa-file-text-o"></i></a>
                                    @else
                                        <button class="btn btn-info" title="Modificar Recipe" disabled><i class="fa fa-file-text-o"></i></button>
                                    @endif
                                </td>
                                
                                <td>
                                    @if(Auth::user()->hasPermissionTo('ConcluirCita') && $appointment->medicalrecord)
                                        <form role="form" method="POST" action="{{ url('/appointments/'.$appointment->id.'/status') }}">
                                            {{ method_field('PUT') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger" title="Concluir Cita"><i class="fa fa-calendar-times-o"></i></button>
                                        </form>
                                    @else
                                        <button class="btn btn-danger" title="Concluir Cita" disabled><i class="fa fa-calendar-times-o"></i></button>
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
