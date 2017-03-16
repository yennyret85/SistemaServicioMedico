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
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>Módulo Historias Médicas</strong>
                    </div>
                        <div class="panel-body">
                        	<strong>Listado de Historias Médicas</strong>
                        <table class="table table-bordered">
                            <tr>
                                <th>Fecha de Creación</th>
                                <th>Paciente</th>
                                <th>Doctor</th>
                                <th>Informe Médico</th>
                                <th width="10%" colspan="3">Acciones</th>
                            </tr>
{{-- 
                               @if(Auth::user()->hasPermissionTo('VerRecipe'))
                                    <td>
                                    @if(Auth::user()->hasPermissionTo('VerRecipe') && $medicalrecord->recipe )
                                        <a href="{{ url('users/'.$user->id.'/permissions') }}"
                                           class="btn btn-warning">
                                            <i class="fa fa-id-card" title="Asignar Permiso"></i>
                                        </a>
                                    </td>
                                    @endif
                                    @if(Auth::user()->hasPermissionTo('EditarUsuario'))
                                    <td>
                                        <a href="{{ url('users/'.$user->id.'/edit') }}" class="btn btn-primary" title="Editar Usuario">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                    @endif
                                    <td>
                                    @if(Auth::user()->hasPermissionTo('EliminarUsuario'))
                                        <button class="btn btn-danger"
                                                data-action="{{ url('/users/'.$user->id) }}"
                                                data-name="{{ $user->name . " " . $user->lastname . " C.I.: " . $user->cedula  }}"
                                                data-toggle="modal" data-target="#confirm-delete" title="Eliminar Usuario">
                                            <i class="fa fa-trash fa-1x"></i>
                                        </button>
                                    @endif
                                    </td>              
                                </tr>
                            @endforeach
--}}
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
                        usuario?</p>
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
                        @if(Auth::user()->hasPermissionTo('EliminarUsuario'))
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