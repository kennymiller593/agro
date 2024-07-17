@extends('admin-layout')
@section('content')
    <!-- CSS de DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- CSS de DataTables en español -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/plug-ins/1.11.5/i18n/Spanish.json">


    <!-- JavaScript de jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- JavaScript de DataTables -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <div id="content" class="bg-white/10 col-span-9 rounded-lg p-6">
        <div class="w-full ">
            <div class="bg-white shadow-md rounded pt-2 pl-2 pr-2 ">

                <button type="button"
                    class=" bg-indigo-400 h-max w-max rounded-lg text-white font-bold hover:bg-indigo-300 " disabled>

                    <a href="{{ route('client.create') }}">
                        <div class="flex items-center justify-center m-[10px]">
                            Agregar
                        </div>
                    </a>
                </button>


                <table id="example1" class="min-w-max w-full table-auto">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="text-left py-3 px-2 rounded-l-lg">Id</th>
                            <th class="text-left py-3 px-2 ">Cliente</th>

                            <th class="text-left py-3 px-2">DNI</th>
                            <th class="text-left py-3 px-2">Celular</th>
                            <th class="text-left py-3 px-2">Fecha Instalacion</th>
                            <th class="text-left py-3 px-2">Dia de cobro</th>
                            <th class="text-left py-3 px-2">Plan</th>
                            <th class="text-left py-3 px-2">Zona</th>
                            <th class="text-left py-3 px-2">Ip</th>
                            <th class="text-left py-3 px-2 rounded-r-lg">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <dialog id="myModal" class=" w-11/12 md:w-1/2 p-5  bg-white rounded-md ">
        <div class="flex flex-col w-full  ">
            <!-- Header -->
            <div class="flex w-full h-auto justify-center items-center">
                <div class="flex w-10/12 h-auto py-3 justify-center items-center text-2xl font-bold" id="num_boleta">

                </div>
                <div onclick="document.getElementById('myModal').close();"
                    class="flex w-1/12 h-auto justify-center cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-x">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </div>
                <!--Header End-->
            </div>
            <!-- Modal Content-->
            <!--Body-->
            <div class="my-5 mr-5 ml-5 flex justify-center">
                <form action="" id="formularioPendiente" method="POST">
                    @csrf
                    <div class="grid gird-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <input type="text" id="instalacion_id" name="instalacion_id" hidden>
                        <div class="">
                            <label for="names" class="text-md text-gray-600">Cliente</label>
                            <input type="text" id="txt_data_cliente" autocomplete="off" name="txt_data_cliente"
                                class="h-3 p-6 w-full border-2 border-gray-300 mb-5 rounded-md" disabled
                                placeholder="Jhon Does">
                        </div>
                        <div class="">
                            <label for="phone" class="text-md text-gray-600">Fecha de pago</label>
                            <input type="datetime-local" id="txt_fecha_pago" autocomplete="off" name="txt_fecha_pago"
                                class="h-3 p-6 w-full border-2 border-gray-300 mb-5 rounded-md"
                                value="{{ now()->format('Y-m-d\TH:i') }}">
                        </div>
                        <div class="">
                            <label for="id_number" class="text-md text-gray-600">Fecha de vencimiento</label>

                            <input type="datetime-local" id="txt_fecha_vencimiento" autocomplete="off"
                                name="txt_fecha_vencimiento" class="h-3 p-6 w-full border-2 border-gray-300 mb-5 rounded-md"
                                value="{{ now()->format('Y-m-d\TH:i') }}">
                        </div>
                    </div>
                    <div class="grid gird-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div class="">
                            <label for="id_number" class="text-md text-gray-600">Cantidad</label>

                            <input type="number" id="cantidad" autocomplete="off" name="cantidad"
                                class="h-3 p-6 w-full border-2 border-gray-300 mb-5 rounded-md" placeholder="1"
                                value="1">
                        </div>
                        <div class="">
                            <label for="id_number" class="text-md text-gray-600">Descripción</label>
                            <textarea
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-blue-500 ring-1 ring-inset ring-blue-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-400 sm:text-sm sm:leading-6"
                                id="descripcion" name="descripcion" rows="2" placeholder=""></textarea>
                        </div>
                        <div class="">
                            <label for="id_number" class="text-md text-gray-600">Precio</label>
                            <input type="number" id="monto_ind" autocomplete="off" name="monto_ind"
                                class="h-3 p-6 w-full border-2 border-gray-300 mb-5 rounded-md" placeholder="20">
                        </div>
                        <div class="">
                            <label for="id_number" class="text-md text-gray-600">Total</label>
                            <input type="number" id="monto" autocomplete="off" name="monto"
                                class="h-3 p-6 w-full border-2 border-gray-300 mb-5 rounded-md" placeholder="20">
                        </div>
                    </div>
                    <div class='flex items-center justify-center'>
                        <button type="button" id="botonProcesarPendiente"
                            class="bg-indigo-400 h-max w-max rounded-lg text-white font-bold hover:bg-indigo-300 ">
                            <div class="flex items-center justify-center m-[10px]">

                                <div class="ml-2"> Generar<div>
                                    </div>
                        </button>
                    </div>
                </form>
            </div>
            <!-- End of Modal Content-->
        </div>
    </dialog>
    <!-- DataTables  & Plugins -->

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
    <style>
        input[type="search"] {
            outline: none;
            border: 1px solid #107C41;
            /* Establece un borde sólido de 1 píxel con el color deseado */
            border-radius: 4px;
            /* Opcional: agrega esquinas redondeadas al borde */
        }



        .buttons-colvis {}

        .dataTables_wrapper {
            padding-top: 4px;
        }

        .buttons-csv {
            background-color: #107C41;
            color: white;
            border-radius: 2px;

        }

        .buttons-excel {
            background-color: #107C41;
            color: white;
            border-radius: 2px;

        }

        .buttons-pdf {
            background-color: #B30B00;
            color: white;
            border-radius: 2px;

        }
    </style>
    <script>
        document.getElementById('botonProcesarPendiente').addEventListener('click', function() {
            // Obtener los datos del formulario
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            var formData = new FormData(document.getElementById('formularioPendiente'));
            formData.append('_token', csrfToken);
            fetch("/crear-pendientes", {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Hubo un problema al generar.');
                    }
                    return response.json();
                })
                .then(data => {
                    toastr.success('La operación se realizó exitosamente', 'Bien hecho', {
                        progressBar: true,
                        positionClass: 'toast-top-center'
                    });
                    document.getElementById('myModal').close()
                    //  $('#example1').DataTable().ajax.reload();
                })
                .catch(error => {
                    console.error('Error al generar:', error);
                });
        });
    </script>
    <script>
        function mostrarModal(elemento) {
            var nombre = elemento.getAttribute('data-nombre');
            var num_boleta = elemento.getAttribute('data-id');
            var mount = elemento.getAttribute('data-mount');
            var inst_id = elemento.getAttribute('data-inst_id');
            var desc = elemento.getAttribute('data-desc');
            // Mostrar el modal y establecer el nombre en el contenido del modal
            document.getElementById('txt_data_cliente').value = nombre;
            document.getElementById('num_boleta').textContent = 'Recibo N° 000' + num_boleta;
            document.getElementById('monto_ind').value = mount;
            document.getElementById('monto').value = mount;

            document.getElementById('instalacion_id').value = inst_id;
            document.getElementById('descripcion').value = 'INTERNET ILIMITADO ' + desc;
            document.getElementById('myModal').showModal();
        }
    </script>
    <script>
        $(function() {
            $("#example1").DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.18/i18n/Spanish.json'
                },

                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                dom: 'Bfrtip',

                "buttons": ["csv", "excel", "pdf", "colvis"],
                "ajax": {
                    url: "{{ route('clientes.index') }}",
                },
                columns: [{
                        data: 'id'
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return row.cliente.nombre + ' ' + row.cliente.apellidos;
                        }
                    },
                    {
                        data: 'cliente.dni'
                    },
                    {
                        data: 'cliente.celular'
                    },
                    {
                        data: 'fecha_instalacion'
                    },
                    {
                        data: 'dia_cobro'
                    },
                    {
                        data: 'plan.nombre'
                    },
                    {
                        data: 'zona.nombre'
                    },
                    {
                        data: 'ip'
                    },
                    {
                        data: 'ip',
                        orderable: false,
                        searchable: false
                    },
                ],
                columnDefs: [{
                    // Definir botones de editar y eliminar en la última columna
                    targets: -1,
                    render: function(data, type, row) {
                        return '<div class="inline-flex items-center space-x-3" onclick="mostrarModal(this)" id="btn" data-desc="' +
                            row.plan.nombre + '" data-inst_id="' +
                            row.id + '" data-mount="' +
                            row.plan.precio + '" data-nombre="' +
                            row.cliente.nombre + '" data-id="' +
                            row.id +
                            '"><a class="text-green-500 cursor-pointer" title="Generar Factura"> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"> <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg></a>' +
                            '</div>';
                    }
                }],
                order: [
                    [0, 'desc'] // Ordenar por la primera columna (ID) de forma ascendente
                ]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        });
    </script>
@endsection
