@extends('home')


@section('links')

    <title>Pacientes</title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="/assets/img/favicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css">

    <!-- Lineawesome CSS -->
    <link rel="stylesheet" href="/assets/css/line-awesome.min.css">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="/assets/css/select2.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="assets/js/html5shiv.min.js"></script>
        <script src="assets/js/respond.min.js"></script>
    <![endif]-->
@endsection

@section('contenido')

    <!-- Page Wrapper -->
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Detalles del Paciente</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('pacientes.index') }}">Pacientes</a></li>
                            <li class="breadcrumb-item active">Detalles del Paciente</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="card mb-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-view">
                                <div class="profile-img-wrap">
                                    <div class="profile-img">
                                        <a href="">
                                            <img src="/assets/img/profiles/pacientes.png" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="profile-info-left">
                                                <h3 class="user-name m-t-0">{{ $pacientes_show->nombre }}</h3>
                                                <div class="staff-id">{{ $estado->descripcion }}</div>
                                                <div class="staff-id">Cédula : {{ $pacientes_show->cedula }}</div>
                                                <a href="{{ route('pacientes.index') }}" class="btn btn-danger mt-3">Ver todos los pacientes</a>
                                                <a href="{{ URL::to('pacientes/' . $pacientes_show->id .'/edit') }}" class="btn btn-success mt-3">Editar Paciente</a>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="personal-info">
                                                <li>
                                                    <span class="title">Telefono:</span>
                                                    <span class="text">
                                                        @if($pacientes_show->telefono ?? '')
                                                            <a href="">{{ $pacientes_show->telefono }}</a>
                                                        @else
                                                            Desconocido
                                                        @endif
                                                    </span>
                                                </li>
                                                <li>
                                                    <span class="title">Correo Electrónico:</span>
                                                    <span class="text">
                                                        @if($pacientes_show->email ?? '')
                                                            <a href="">{{ $pacientes_show->email }}</a>
                                                        @else
                                                            Desconocido
                                                        @endif
                                                    </span>
                                                </li>
                                                <li>
                                                    <span class="title">Fecha de Nacimiento:</span>
                                                    <span class="text">
                                                        @if($pacientes_show->fec_nacimiento ?? '')
                                                            {{ date('d-m-Y', strtotime($pacientes_show->fec_nacimiento)) }}
                                                        @else
                                                            Desconocida
                                                        @endif
                                                    </span>
                                                </li>
                                                <li>
                                                    <span class="title">Direccion:</span>
                                                    <span class="text">
                                                    @if($pacientes_show->direccion ?? '')
                                                        {{ $pacientes_show->direccion }}
                                                    @else
                                                        Desconocida
                                                    @endif
                                                    </span>
                                                </li>
                                                <li>
                                                    <span class="title">Numero de Paciente:</span>
                                                    <span class="text"> {{ $pacientes_show->id }}</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card tab-box">
                <div class="row user-tabs">
                    <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
                        <ul class="nav nav-tabs nav-tabs-bottom">
                            <li class="nav-item col-sm-3"><a class="nav-link active" data-toggle="tab" href="#myprojects">Atenciones</a></li>
                        </ul>
                        <ul>
                            <div class="staff-msg"><a href="{{ route('pacientes.index') }}" class="btn btn-custom">Ver todas los atenciones</a></div>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="tab-content profile-tab-content">

                        <!-- Projects Tab -->
                        <div id="myprojects" class="tab-pane fade show active">
                            @if($atenciones ?? '')
                                    <div class="row">
                                        @foreach ($atenciones as $atencion)
                                            <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="dropdown profile-action">
                                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_project"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_project"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                            </div>
                                                        </div>
                                                    <h4 class="project-title mb-5"><a href="project-view.html">{{$atencion->hospital}}</a></h4>
                                                        <div class="pro-deadline m-b-15">
                                                            <div class="sub-title">
                                                                Estado de Atención:
                                                            </div>
                                                            <span class="badge bg-inverse-success">Activo</span>
                                                        </div>
                                                        <div class="pro-deadline m-b-15">
                                                            <div class="sub-title">
                                                                Fecha de Entrada:
                                                            </div>
                                                            <div class="text-muted">
                                                                {{date('d-m-Y', strtotime($atencion->fec_inicio))}}
                                                            </div>
                                                        </div>
                                                        <div class="pro-deadline m-b-15">
                                                            <div class="sub-title">
                                                                Fecha de Salida:
                                                            </div>
                                                            <div class="text-muted">
                                                                {{date('d-m-Y', strtotime($atencion->fec_fin))}}
                                                            </div>
                                                        </div>
                                                        <div class="project-members m-b-15">
                                                            <div class="sub-title">
                                                                Doctor:
                                                            </div>
                                                            <div class="text-muted">
                                                                Dr. Sandoval
                                                            </div>
                                                        </div>
                                                        <div class="staff-msg"><a href="{{ route('pacientes.index') }}" class="btn btn-warning">Ver Atención</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                            @endif
                        </div>
                        <!-- /Projects Tab -->



                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->

    </div>
    <!-- /Page Wrapper -->
@endsection

@section('scripts')
    <!-- jQuery -->
    <script src="/assets/js/jquery-3.2.1.min.js"></script>
    <script src="/assets/js/jquery.inputmask.min.js"></script>

    <!-- Bootstrap Core JS -->
    <script src="/assets/js/popper.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>

    <!-- Slimscroll JS -->
    <script src="/assets/js/jquery.slimscroll.min.js"></script>

    <!-- Select2 JS -->
    <script src="/assets/js/select2.min.js"></script>

    <!-- Custom JS -->
    <script src="/assets/js/app.js"></script>

    <script>
        $(document).ready(function() {
            $(".alert").delay(4000).slideUp(200, function() {
                $(this).alert('close');
            });
            $("#fec_nacimiento").inputmask("9999/99/99",{ "placeholder": "aaaa/mm/dd" });

        });
    </script>

@endsection
