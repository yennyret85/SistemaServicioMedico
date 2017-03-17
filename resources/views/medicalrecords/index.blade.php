@extends('layouts.app')

@section('content')
	<div class="container">
        @if(session('mensaje'))
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        <strong>Información:</strong> {{ session('mensaje') }}.
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
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
                                <th width="10%" colspan="4">Acciones</th>
                            </tr>
                            @foreach($medicalrecords as $medicalrecord)
                            <tr>
                                <td>
                                    {{ $medicalrecord->appointment->appointment_date }}
                                </td>
                                <td>
                                    {{ $medicalrecord->appointment->patient->name." ".$medicalrecord->appointment->patient->lastname." | C.I.".$medicalrecord->appointment->patient->idcard }}
                                </td>
                                <td>
                                    {{ $medicalrecord->appointment->doctor->name." ".$medicalrecord->appointment->doctor->lastname." (".$medicalrecord->appointment->doctor->specialty->name.")" }}
                                </td>
                                @if(Auth::user()->hasPermissionTo('VerHistoriaMedica'))
                                    <td>
                                        <a href="{{ url('/medicalrecords/'.$medicalrecord->id.'/verhistoriamedica') }}" class="btn btn-success" title="Ver Historia Médica"><i class="fa fa-h-square"></i></a>
                                    </td>
                                @endif
                                @if(Auth::user()->hasPermissionTo('VerRecipe') && $medicalrecord->recipe )
                                    <td>
                                        <a href="{{ url('/recipes/'.$medicalrecord->recipe->id.'/verrecipe') }}" class="btn btn-primary" title="Ver Recipe"><i class="fa fa-file-text-o"></i></a>
                                    </td>
                                @else(Auth::user()->hasPermissionTo('VerRecipe'))
                                    <td>
                                        <button class="btn btn-primary" title="Ver Recipe" disabled><i class="fa fa-file-text-o"></i></button>
                                    </td>
                                @endif
                                @if(Auth::user()->hasPermissionTo('EditarHistoriaMedica'))
                                    <td>
                                        <a href="{{ url('/medicalrecords/'.$medicalrecord->id.'/edit') }}" class="btn btn-warning" title="Modificar Historia Médica"><i class="fa fa-edit"></i></a>
                                    </td>
                                @endif
                                @if(Auth::user()->hasPermissionTo('EliminarHistoriaMedica'))
                                    <td>
                                        <button class="btn btn-danger"
                                            data-action="{{ url('/medicalrecords/'.$medicalrecord->id) }}"
                                            data-name="{{ $medicalrecord->id }}"
                                            data-toggle="modal" data-target="#confirm-delete">
                                            <i class="fa fa-trash fa-1x"></i>
                                        </button>
                                    </td>
                                @endif
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="7" class="text-center">
                                    {{ $medicalrecords->links() }}
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
                    <p>¿Seguro que desea eliminar este Registro Historia Médica?</p>
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