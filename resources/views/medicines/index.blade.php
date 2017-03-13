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
                    <div class="panel-heading">Medicinas</div>

                    <div class="panel-body">
                            <a href="{{ url('/medicines/create') }}" class="btn btn-success">
                                <i class="fa fa-medkit"></i> Nueva Medicina
                            </a>
                        <table class="table table-bordered">
                            <tr>
                                <th>Nombre</th>
                                <th width="10%" colspan="3">Acciones</th>
                            </tr>
                            @foreach($medicines as $medicine)
                                <tr>
                                    <td>{{ $medicine->name }}</td>
                                    <td>
                                        <button class="btn btn-danger"
                                                data-action="{{ url('/medicines/'.$medicine->id) }}"
                                                data-name="{{ $medicine->name }}"
                                                data-toggle="modal" data-target="#confirm-delete">
                                            <i class="fa fa-trash fa-1x"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="4" class="text-center">
                                    {{ $medicines->links() }}
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
                    <p>¿Seguro que desea eliminar esta medicina?</p>
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
