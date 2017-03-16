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
                        <strong>Módulo de Citas</strong>
                    </div>

                    <div class="panel-body">
                        <strong>Listado de Citas</strong>
                        @if(Auth::user()->hasPermissionTo('AsignarCita'))
                            <a href="{{ url('/appointments/create') }}" class="btn btn-success">
                                <i class="fa fa-calendar"></i> Crear Cita
                            </a>
                        @endif
                        <table class="table table-bordered">
                            <tr>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Paciente</th>
                                <th>Medico</th>
                                <th>Especialidad</th>
                                <th>Status</th>
                                <th width="10%" colspan="3">Acciones</th>
                            </tr>
                            @foreach($appointments as $appointment)
                            <tr>
                                <td>{{ $appointment->appointment_date }}</td>
                                <td>{{ $appointment->appointment_time }}</td>
                                <td>{{ $appointment->patient->name." ".$appointment->patient->lastname }}</td>
                                <td>{{ $appointment->doctor->name." ".$appointment->doctor->lastname }}</td>
                                <td>{{ $appointment->specialty->name }}</td>
                                <td>{{ $appointment->status }}</td>

                                @if(Auth::user()->hasPermissionTo('EditarCita'))
                                <td>
                                <a href="{{ url('appointments/'.$appointment->id.'/edit') }}" class="btn btn-primary" title="Editar Cita">
                                        <i class="fa fa-calendar"></i>
                                    </a>
                                </td>
                                @endif
                                @if(Auth::user()->hasPermissionTo('CambiarStatusCita'))
                                <td>
                                    <a href="{{ url('appointments/'.$appointment->id.'/status') }}" class="btn btn-warning" title="Cambiar Status Cita">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                                @endif
                                @if(Auth::user()->hasPermissionTo('EliminarCita'))
                                <td>
                                    <button class="btn btn-danger"
                                            data-action="{{ url('/appointments/'.$appointment->id) }}"
                                            data-toggle="modal" data-target="#confirm-delete" title="Eliminar Cita">
                                        <i class="fa fa-trash fa-1x"></i>
                                    </button>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="9" class="text-center">
                                    {{ $appointments->links() }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="confirm-delete" tabindex="-1"
         role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                </div>
                <div class="modal-body">
                    <p>¿Seguro que desea eliminar esta cita?</p>
                    <p class="nombre"></p>
                </div>
                <div class="modal-footer">
                    <form class="form-inline form-delete"
                          role="form"
                          method="POST"
                          action="">
                        {!! method_field('DELETE') !!}
                        {!! csrf_field() !!}
                        <button type="button"
                                class="btn btn-default"
                                data-dismiss="modal">Cancelar
                        </button>
                        <button id="delete-btn"
                                class="btn btn-danger"
                                title="Eliminar">Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
