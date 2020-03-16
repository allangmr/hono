@extends('home')


@section('links')

    <title>Pacientes</title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">

    <!-- Lineawesome CSS -->
    <link rel="stylesheet" href="assets/css/line-awesome.min.css">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="assets/css/select2.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

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
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Pacientes</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                            <li class="breadcrumb-item active">Pacientes</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_client"><i class="fa fa-plus"></i> Agregar Paciente</a>
                    </div>
                    @if($pacientes_show ?? '')
                        @foreach ($pacientes_show as $paciente_show)
                            <h5 class="user-name m-t-10 mb-0 text-ellipsis"><a href="client-profile.html">{{ $paciente_show->cedula }}</a></h5>
                        @endforeach
                    @endif
                </div>
            </div>
            <!-- /Page Header -->
            <!-- Search Filter -->
            <form method="POST">
            <div class="row filter-row">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" name="busc_id">
                            <label class="focus-label">Identificación</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" name="busc_nombre">
                            <label class="focus-label">Nombre</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus select-focus">
                            <select class="select floating" name="busc_estado">
                                <option value="0">Seleccione un estado</option>
                                <option value="1">Activo</option>
                                <option value="2">En Atención</option>
                                <option value="3">En Cobros</option>
                                <option value="4">Cerrado</option>
                            </select>
                            <label class="focus-label">Estado</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <button class="btn btn-success btn-block"  type="submit" >Buscar</button>
                    </div>
            </div>
            </form>
            <!-- Search Filter -->
            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

            @endif

            @if (\Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Genial!</strong> {{ \Session::get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="row staff-grid-row">

                @foreach ($pacientes as $paciente)

                <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
                    <div class="profile-widget">
                        <div class="profile-img">
                            <a href="{{ URL::to('pacientes/' . $paciente->id) }}" class="avatar"><img alt="" src="assets/img/profiles/pacientes.png"></a>
                        </div>
                        <div class="dropdown profile-action">
                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item"  href="{{ URL::to('pacientes/' . $paciente->id) }}"><i class="fa fa-eye m-r-5"></i> Ver</a>
                            <a class="dropdown-item" href="{{ URL::to('pacientes/' . $paciente->id .'/edit') }}" ><i class="fa fa-pencil m-r-5"></i> Editar</a>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_client"><i class="fa fa-trash-o m-r-5"></i> Eliminar</a>
                        </div>
                        </div>
                        <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="{{ URL::to('pacientes/' . $paciente->id) }}">{{ $paciente->nombre }}</a></h4>
                        <h5 class="user-name m-t-10 mb-0 text-ellipsis"><a href="{{ URL::to('pacientes/' . $paciente->id) }}">{{ $paciente->cedula }}</a></h5>
                        <div class="small text-muted">{{ $paciente->descripcion }}</div>
                        <a href="{{ URL::to('pacientes/' . $paciente->id) }}" class="btn btn-white btn-sm m-t-10">Atenciones</a>
                        <a href="{{ URL::to('pacientes/' . $paciente->id) }}" class="btn btn-white btn-sm m-t-10">Proced.</a>
                    </div>
                </div>
                @endforeach
            </div>
            {{ $pacientes->links() }}
        </div>
        <!-- /Page Content -->


        <!-- Show Client Modal -->
        <div id="show_client" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Información del Paciente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                                <div class="row" id="vista_pacientes">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Nombre Completo</label>
                                            <input class="form-control" name="show_nombre" type="text" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Fecha de Nacimiento</label>
                                            <input class="form-control" name="show_fec_nacimiento" value="" type="text" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Telefono</label>
                                            <input class="form-control" name="show_telefono"  type="text" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Email</label>
                                            <input class="form-control floating" name="show_email"  type="email" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Direccion Residencial</label>
                                            <input class="form-control floating"  name="show_direccion"  type="text" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Cédula</label>
                                            <input class="form-control" name="show_cedula"  type="text" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Estado</label>
                                            <input class="form-control" name="show_estado"  type="text" readonly>
                                        </div>
                                    </div>
                                </div>
                        <div class="submit-section">
                            <button type="button" class="btn btn-primary submit-btn"  data-dismiss="modal" aria-label="Close">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Show Client Modal -->

        <!-- Add Client Modal -->
        <div id="add_client" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Nuevo Paciente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Nombre Completo<span class="text-danger">*</span></label>
                                        <input class="form-control" id="nombre" name="nombre" type="text" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Fecha de Nacimiento</label>
                                        <input class="form-control" id="fec_nacimiento" name="fec_nacimiento" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Telefono</label>
                                        <input class="form-control" id="telefono"  name="telefono" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Email</label>
                                        <input class="form-control floating" id="email" name="email" type="email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Direccion Residencial</label>
                                        <input class="form-control floating"  id="direccion" name="direccion" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Cédula<span class="text-danger">*</span></label>
                                        <input class="form-control" id="cedula" name="cedula" required type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Estado<span class="text-danger">*</span></label>
                                        <div class="form-group form-focus select-focus">
                                            <select id="id_estado" name="id_estado" required class="select floating">
                                                <option value="1">Activo</option>
                                                <option value="2">En Atención</option>
                                                <option value="3">En Cobros</option>
                                                <option value="4">Cerrado</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <input class="btn btn-primary submit-btn"  type="reset" value="Limpiar formulario">
                                <button class="btn btn-success submit-btn"  type="submit" >Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Add Client Modal -->

        <!-- Edit Client Modal -->
        <div id="edit_client" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Paciente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Nombre Completo<span class="text-danger">*</span></label>
                                        <input class="form-control" id="nombre" name="nombre" type="text" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Fecha de Nacimiento</label>
                                        <input class="form-control" id="fec_nacimiento" name="fec_nacimiento" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Telefono</label>
                                        <input class="form-control" id="telefono"  name="telefono" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Email</label>
                                        <input class="form-control floating" id="email" name="email" type="email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Direccion Residencial</label>
                                        <input class="form-control floating"  id="direccion" name="direccion" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Cédula<span class="text-danger">*</span></label>
                                        <input class="form-control" id="cedula" name="cedula" required type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group form-focus select-focus">
                                            <select class="select floating">
                                                <option>Select Company</option>
                                                <option>Global Technologies</option>
                                                <option>Delta Infotech</option>
                                            </select>
                                            <label class="focus-label">Company</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <input class="btn btn-primary submit-btn"  type="reset" value="Limpiar formulario">
                                <button class="btn btn-success submit-btn"  type="submit" >Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Edit Client Modal -->

        <!-- Delete Client Modal -->
        <div class="modal custom-modal fade" id="delete_client" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Delete Client</h3>
                            <p>Are you sure want to delete?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <div class="row">
                                <div class="col-6">
                                    <a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a>
                                </div>
                                <div class="col-6">
                                    <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Delete Client Modal -->

    </div>
    <!-- /Page Wrapper -->
@endsection

@section('scripts')
    <!-- jQuery -->
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/jquery.inputmask.min.js"></script>

    <!-- Bootstrap Core JS -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Slimscroll JS -->
    <script src="assets/js/jquery.slimscroll.min.js"></script>

    <!-- Select2 JS -->
    <script src="assets/js/select2.min.js"></script>

    <!-- Custom JS -->
    <script src="assets/js/app.js"></script>

    <script>
        $(document).ready(function() {
            $(".alert").delay(4000).slideUp(200, function() {
                $(this).alert('close');
            });
            $("#fec_nacimiento").inputmask("9999/99/99",{ "placeholder": "aaaa/mm/dd" });

        });
    </script>

@endsection
