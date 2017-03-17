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
                    <div class="panel-heading">
                        <strong>Listado de Récipes</strong>
                    </div>
                        <div class="panel-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Fecha de Emisión</th>
                                <th>Paciente</th>
                                <th>Doctor</th>
                                <th>Status</th>
                                <th width="10%" colspan="4">Acciones</th>
                            </tr>
	                        @foreach($recipes as $recipe)
                            	<tr>
	                            	<td>{{ $recipe->medicalrecord->appointment->appointment_date }}</td>
	                            	<td>{{ $recipe->medicalrecord->appointment->patient->name." ".$recipe->medicalrecord->appointment->patient->lastname." | C.I. ".$recipe->medicalrecord->appointment->patient->idcard }}</td>
	                            	<td>{{ $recipe->medicalrecord->appointment->doctor->name." ".$recipe->medicalrecord->appointment->doctor->lastname." (".$recipe->medicalrecord->appointment->doctor->specialty->name.")" }}</td>
	                            	<td>{{ $recipe->status }}</td>
                                    @if(Auth::user()->hasPermissionTo('VerRecipe'))
                                        <td>
                                            <a href="{{ url('/recipes/'.$recipe->id.'/verrecipe') }}" class="btn btn-success" title="Ver Recipe"><i class="fa fa-file-text"></i></a>
                                        </td>
                                    @else
                                        <td>
                                            <button class="btn btn-success" title="Ver Recipe" disabled><i class="fa fa-file-text"></i></button>
                                        </td>
                                    @endif
		                            @if(Auth::user()->hasPermissionTo('EditarRecipe') && ($recipe->status)=='Activo' )
                                        <td>
		                            		<a href="{{ url('/recipes/'.$recipe->id.'/edit') }}" class="btn btn-primary" title="Modificar Recipe"><i class="fa fa-file-text-o"></i></a>
                                        </td>
                                    @else
                                        <td>
                                            <button class="btn btn-primary" title="Modificar Recipe" disabled><i class="fa fa-file-text-o"></i></button>
                                        </td>
		                            @endif
		                            @if(Auth::user()->hasPermissionTo('CambiarStatusRecipe'))
                                        <td>
		                            		<a href="{{ url('recipes/'.$recipe->id.'/status') }}" class="btn btn-warning" title="Cambiar Status Recipe">
                                        <i class="fa fa-edit"></i></a>
                                        </td>
		                            @endif
	                            	@if(Auth::user()->hasRole('Administrador'))
                                        <td>
			                            	<button class="btn btn-danger"
                                                data-action="{{ url('/recipes/'.$recipe->id) }}"
                                                data-name="{{ $recipe->id }}"
                                                data-toggle="modal" data-target="#confirm-delete">
                                            <i class="fa fa-trash fa-1x"></i>
                                        </button>
                                        </td>    
		                            @endif
                        		</tr>
	                        @endforeach
                            <tr>
                                <td colspan="10" class="text-center">
                                    {{ $recipes->links() }}
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
                        récipe?</p>
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
