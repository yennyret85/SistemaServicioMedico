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
                        <strong>Mis Recipes</strong>
                    </div>

                    <div class="panel-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Paciente</th>
                                <th>Status</th>
                                <th width="10%" colspan="5">Acciones</th>
                            </tr>
                            @foreach(Auth::user()->recipes_doctor as $recipe)
                            <tr>
                                <td>{{ $recipe->timestamps() }}</td>
                                <td>{{ $recipe->medicalrecord->appointment->patient->name." ".$recipe->medicalrecord->appointment->patient->lastname." | C.I. ".$recipe->medicalrecord->appointment->patient->idcard }}</td>
                                <td>{{ $recipe->medicines}}</td>
                                <td>{{ $recipe->indications }}</td>
                                <td>{{ $recipe->status }}</td> {{-- Si el estatus es != Asignado mostrar entre () el nombre del farmaceuta que le cambió el status--}}
                                <td>
                                    @if(Auth::user()->hasPermissionTo('CrearHistoriaMedica') && !$appointment->medicalrecord )
                                        <a href="{{ url('/medicalrecords/create/'.$appointment->id) }}" class="btn btn-success" title="Crear Historia Médica"><i class="fa fa-h-square"></i></a>
                                    @else
                                        <button class="btn btn-success" title="Crear Historia Médica" disabled><i class="fa fa-h-square"></i></button>
                                    @endif
                                </td>

                                {{-- 
                                <td>
                                    @if(Auth::user()->hasPermissionTo('EditarRecipe') && $appointment->medicalrecord )
                                        <a href="{{ url('/recipes/'.$appointment->medicalrecord->id.'/edit') }}" class="btn btn-primary" title="Modificar Recipe"><i class="fa fa-file-text-o"></i></a>
                                    @else
                                        <button class="btn btn-info" title="Modificar Recipe" disabled><i class="fa fa-file-text-o"></i></button>
                                    @endif
                                </td>
                                --}}
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
