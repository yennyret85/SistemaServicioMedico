@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Asignar Permisos Usuario</div>

                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST"
                              action="{{ url('/users/'.$user->id.'/asignarpermisos') }}">
                            {{ method_field('PUT') }}
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Nombre</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{ $user->name or old('name') }}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="lastname" class="col-md-4 control-label">Apellido</label>
                                <div class="col-md-6">
                                    <input id="lastname" type="text" class="form-control" name="lastname"
                                           value="{{ $user->lastname or old('lastname') }}" readonly>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('permissions') ? ' has-error' : '' }}">
                                <label for="permissions" class="col-md-4 control-label">Permisos</label>

                                <div class="col-md-6">
                                    @foreach($permissions as $permission)
                                        <label class="checkbox-inline">
                                            <input class="i-check" type="checkbox" id="permissions" name="permissions[]"
                                                   value="{{ $permission->name }}"
                                                   @if($user->hasPermissionTo($permission->name)) checked @endif>
                                            @if(str_contains($permission->name,'Modulo'))
                                                <strong>{{ $permission->name  }}</strong>
                                            @else
                                                {{ $permission->name  }}
                                            @endif
                                        </label><br>
                                    @endforeach
                                    @if($errors->has('permissions'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('permissions') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Guardar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection