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
                    <div class="panel-heading">Especialidades</div>

                    <div class="panel-body">
                    		@if(Auth::user()->hasPermissionTo('CrearEspecialidad'))
                            <a href="{{ url('/specialties/create') }}" class="btn btn-success" title="Nueva Especialidad">
                                <i class="fa fa-medkit"></i> Nueva Especialidad
                            </a>
                            @endif
                        <table class="table table-bordered">
                            <tr>
                                <th>Nombre</th>
                                <th width="10%" colspan="3">Acciones</th>
                            </tr>
                            @foreach($specialties as $specialty)
                                <tr>
                                    <td>{{ $specialty->name }}</td>
                                    @if(Auth::user()->hasPermissionTo('EditarEspecialidad'))
                                    <td>
                                        <a href="{{ url('specialties/'.$specialty->id.'/edit') }}" class="btn btn-primary" title="Editar Especialidad">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                    @endif
                                    @if(Auth::user()->hasPermissionTo('EliminarEspecialidad'))
                                    <td>
                                        <button class="btn btn-danger"
                                                data-action="{{ url('/specialties/'.$specialty->id) }}"
                                                data-name="{{ $specialty->name }}"
                                                data-toggle="modal" data-target="#confirm-delete" title="Eliminar Especialidad">
                                            <i class="fa fa-trash fa-1x"></i>
                                        </button>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="4" class="text-center">
                                    {{ $specialties->links() }}
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
                    <p>¿Seguro que desea eliminar esta especialidad?</p>
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
                        @if(Auth::user()->hasPermissionTo('EliminarEspecialidad'))
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
