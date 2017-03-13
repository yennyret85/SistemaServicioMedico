@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session('mensaje'))
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <strong>Info:</strong> {{ session('mensaje') }}.
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Listado de Pacientes
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                @if(Auth::user()->can('RegistrarPaciente'))
                                    <a href="{{ url('/users/create') }}" class="btn btn-success">
                                        <i class="fa fa-user"></i> Nuevo Paciente
                                    </a>
                                @endif
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Cedula</th>
                                <th width="10%" colspan="4">Acciones</th>
                            </tr>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->lastname }}</td>
                                    <td>{{ $user->idcard }}</td>
                                    @if(Auth::user()->can('PermisosUsuario'))
                                        <td>
                                            <a href="{{ url('users/'.$user->id.'/permissions') }}"
                                               class="btn btn-warning">
                                                <i class="fa fa-id-card"></i>
                                            </a>
                                        </td>
                                    @endif
                                    @if(Auth::user()->can('AsignarCita'))
                                        <td>
                                            <a href="{{ url('appointments/create') }}"
                                               class="btn btn-success">
                                                <i class="fa fa-calendar-plus-o" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    @endif
                                    @if(Auth::user()->can('EditarPaciente'))
                                        <td>
                                            <a href="{{ url('users/'.$user->id.'/edit') }}" class="btn btn-primary">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                    @endif
                                    @if(Auth::user()->can('EliminarUsuario'))
                                    <td>
                                        <button class="btn btn-danger"
                                                data-action="{{ url('/users/'.$user->id) }}"
                                                data-name="{{ $user->name . " " . $user->lastmane }}"
                                                data-toggle="modal" data-target="#confirm-delete">
                                            <i class="fa fa-trash fa-1x"></i>
                                        </button>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
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
                    <p>¿Seguro que desea eliminar este
                        paciente?</p>
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
                        @if(Auth::user()->can('EliminarUsuario'))
                            <button id="delete-btn"
                                    class="btn btn-danger"
                                    title="Eliminar">Eliminar
                            </button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
