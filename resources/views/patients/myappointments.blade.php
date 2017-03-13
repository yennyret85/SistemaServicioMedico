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
                    <div class="panel-heading">Mis Citas</div>

                    <div class="panel-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Medico</th>
                                <th>Especialidad</th>
                                <th>Status</th>
                            </tr>
                            @foreach(Auth::user()->appointments_patient as $appointment)
                            <tr>
                                <td>{{ $appointment->appointment_date }}</td>
                                <td>{{ $appointment->appointment_time }}</td>
                                <td>{{ $appointment->doctor->name." ".$appointment->doctor->lastname }}</td>
                                <td>{{ $appointment->doctor->specialty->name }}</td>
                                <td>{{ $appointment->status }}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
