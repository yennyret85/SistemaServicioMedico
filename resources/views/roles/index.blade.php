@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session('mensaje'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Información:</strong> {{ session('mensaje') }}.
                </div>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>Módulo de Roles</strong>
                    </div>

                    <div class="panel-body">
                        <strong>Listado de Roles</strong>

                        @if(Auth::user()->hasPermissionTo('CrearRol'))
                            <a href="{{ url('/roles/create') }}" class="btn btn-success">
                                <i class="fa fa-user"></i> Nuevo Role
                            </a>
                        @endif

                        <table class="table table-bordered">
                            <tr>
                                <th>Nombre</th>
                                <th width="10%" colspan="3">Acciones</th>
                            </tr>
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{ $role->name }}</td>
                                    @if(Auth::user()->hasPermissionTo('AsignarPermiso'))
                                    <td>
                                        <a href="{{ url('roles/'.$role->id.'/permissions') }}" class="btn btn-warning" title="Asignar Permiso">
                                            <i class="fa fa-id-card"></i>
                                        </a>
                                    </td>
                                    @endif
                                    @if(Auth::user()->hasPermissionTo('EditarRol'))
                                    <td>
                                        <a href="{{ url('roles/'.$role->id.'/edit') }}" class="btn btn-primary" title="Editar Rol">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                    @endif
                                    @if(Auth::user()->hasPermissionTo('EliminarRol'))
                                    <td>
                                        <button class="btn btn-danger"
                                                data-action="{{ url('/roles/'.$role->id) }}"
                                                data-name="{{ $role->name }}"
                                                data-toggle="modal" data-target="#confirm-delete" title="Eliminar Rol">
                                            <i class="fa fa-trash fa-1x"></i>
                                        </button>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="4" class="text-center">
                                    {{ $roles->links() }}
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
                    <p>¿Seguro que desea eliminar este
                        registro?</p>
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
                        @if(Auth::user()->hasPermissionTo('EliminarRol'))
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
