@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <!-- /.card -->

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">DataTable with default features</h3>
                            <button type="button" class="btn btn-primary">Primary</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Apellidos</th>
                                        <th>DNI</th>
                                        <th>Celular</th>
                                        <th>Dirección</th>
                                        <th>Maps</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>

                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Apellidos</th>
                                        <th>DNI</th>
                                        <th>Celular</th>
                                        <th>Dirección</th>
                                        <th>Maps</th>
                                        <th>Acciones</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>

@stop

@section('css')


    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
        crossorigin="anonymous"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>


    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                dom: 'Bfrtip',
                
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                "ajax": {
                    url: "{{ route('clientes.index') }}",
                },
                "columns": [{
                        data: 'id'
                    }, {
                        data: 'nombre'
                    }, {
                        data: 'apellidos'
                    }, {
                        data: 'dni'
                    }, {
                        data: 'celular'
                    }, {
                        data: 'direccion'
                    }, {
                        data: 'urlmaps'
                    },
                    {
                        data: 'direccion'
                    },
                ],
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        });
    </script>
    <script>
        /* $(document).ready(function() {
                        var tablaCliente = $('#example1').DataTable({
                            "responsive": true, "lengthChange": false, "autoWidth": false,
                            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                                ajax: {
                                    url: "{{ route('clientes.index') }}",
                                },
                                  columns: [{
                                    data: 'id'
                                }, {
                                    data: 'nombre'
                                }, {
                                    data: 'apellidos'
                                }, {
                                    data: 'dni'
                                }, {
                                    data: 'celular'
                                }, {
                                    data: 'direccion'
                                }, {
                                    data: 'urlmaps'
                                },
                                {
                                    data: 'direccion'
                                },
                            ],
                               
                              
                            }).columns.adjust()
                            .responsive.recalc().buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');;
                    });*/

        /*  $(document).ready(function() {
              var tablaAnimal = $('.table').DataTable({
                      aaSorting: [],
                      destroy: true,
                      cache: false,
                      // dom: 'Bfrtip',
                      ajax: {
                          url: "{{ route('clientes.index') }}",
                      },
                      language: {
                          "decimal": "",
                          "emptyTable": "No hay información",
                          "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                          "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                          "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                          "infoPostFix": "",
                          "thousands": ",",
                          "lengthMenu": "Mostrar _MENU_ Entradas",
                          "loadingRecords": "Cargando...",
                          "processing": "Cargando...",
                          "search": "Buscar:",
                          "zeroRecords": "Sin resultado",
                          "paginate": {
                              "first": "Primero",
                              "last": "Ultimo",
                              "next": "Siguiente",
                              "previous": "Anterior"
                          }
                      },
                      columns: [{
                              data: 'id'
                          }, {
                              data: 'nombre'
                          }, {
                              data: 'apellidos'
                          }, {
                              data: 'dni'
                          }, {
                              data: 'celular'
                          }, {
                              data: 'direccion'
                          }, {
                              data: 'urlmaps'
                          },
                          {
                              data: 'direccion'
                          },
                      ],
                      responsive: true
                  }).columns.adjust()
                  .responsive.recalc();
          });*/
    </script>
@stop
