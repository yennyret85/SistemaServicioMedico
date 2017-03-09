<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/font-awesome.css">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Acceder</a></li>
                        <li><a href="{{ url('/register') }}">Registrarse</a></li>
                        @else
                            @hasrole ('Administrador')
                                <li><a href="{{ url('/patients') }}">Pacientes</a></li>
                                <li><a href="{{ url('/users') }}">Empleados</a></li>
                                <li><a href="{{ url('/recipes') }}">Recipes</a></li>
                                <li><a href="{{ url('/medicalrecords') }}">Historias Médicas</a></li>
                                <li><a href="{{ url('/appointments') }}">Citas</a></li>
                                <li><a href="{{ url('/roles') }}">Roles</a></li>
                                <li><a href="{{ url('/permissions') }}">Permisos</a></li>
                                <li><a href="{{ url('/medicines') }}">Medicinas</a></li>
                                <li><a href="{{ url('/especialties') }}">Especialidades</a></li>
                            @endhasrole
                            @hasrole('Secretaria')
                            <li><a href="{{ url('/appointments') }}">Citas</a></li>
                            <li><a href="{{ url('/patients') }}">Pacientes</a></li>
                            <li><a href="{{ url('/doctors') }}">Médicos</a></li>
                            @endhasrole
                            @hasrole('Medico')
                                <li><a href="{{ url('/appointments') }}">Citas</a></li>
                                <li><a href="{{ url('/medicines') }}">Medicinas</a></li>
                                <li><a href="{{ url('/recipes') }}">Recipes</a></li>
                                <li><a href="{{ url('/medicalrecords') }}">Historias Médicas</a></li>
                            @endhasrole
                            @hasrole('Farmaceuta')
                                <li><a href="{{ url('/medicines') }}">Medicinas</a></li>
                                <li><a href="{{ url('/recipes') }}">Recipes</a></li>
                            @endhasrole
                            @hasrole('Paciente')
                                <li><a href="{{ url('/myappointments') }}">Mis Citas</a></li>
                            @endhasrole
                            
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name . " " . Auth::user()->lastname }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Salir
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>

    <script type="application/javascript"> //Script para Eliminar Usuarios
        $('#confirm-delete').on('show.bs.modal', function (e) {
            $(this).find('.form-delete').attr('action', $(e.relatedTarget).data('action'));
            $(this).find('.name').text($(e.relatedTarget).data('name'));
            });
    </script>

    <script> //Script para mostrar Div de Especialidad.
        $('#role').on('change', function (e){
            if ($(e.target).val()=='Medico'){
                $('#specialtyDiv').show();
            }else {
                $('#specialtyDiv').hide();
            }
        });
    </script>
</body>
</html>
