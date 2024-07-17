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
    <div id="content" id="content" class="bg-white/10 col-span-9 rounded-lg p-6">
        <div class="w-full ">
            <div class="bg-white shadow-md rounded pt-2 pl-2 pr-2 ">

                <h1 class="font-bold py-4 uppercase">Pagos Realizados</h1>
                <table id="example1" class="min-w-max w-full table-auto">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="text-left py-3 px-2 rounded-l-lg">Id</th>
                            <th class="text-left py-3 px-2 ">Cliente</th>
                            <th class="text-left py-3 px-2">Celular</th>
                            <th class="text-left py-3 px-2">Plan</th>
                            <th class="text-left py-3 px-2">Ip</th>
                            <th class="text-left py-3 px-2">Estado</th>
                            <th class="text-left py-3 px-2">Fecha de pago</th>
                            <th class="text-left py-3 px-2">Forma de pago</th>
                            <th class="text-left py-3 px-2">Total, Pagado</th>
                            <th class="text-left py-3 px-2 rounded-r-lg">Acciones</th>
                        </tr>
                    </thead>

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
                <form action="" id="formularioPago" method="POST">
                    @csrf
                    <div class="grid gird-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <input type="text" id="pendiente_id" name="pendiente_id" hidden>
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
                        <div class="">
                            <label for="id_number" class="text-md text-gray-600">Forma de pago</label>

                            <select id="forma_pago" name="forma_pago"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>Transferencia</option>
                                <option value="US">Efectivo</option>
                            </select>
                        </div>
                        <div class="">
                            <label for="id_number" class="text-md text-gray-600">Acción al pagar</label>

                            <select id="action" name="action"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected value="1">Registrar pago y activar</option>
                                <option value="2">Solo registrar pago</option>

                            </select>
                        </div>
                        <div class="">
                            <label for="id_number" class="text-md text-gray-600">Total, a pagar</label>
                            <input type="number" id="monto" autocomplete="off" name="monto"
                                class="h-3 p-6 w-full border-2 border-gray-300 mb-5 rounded-md" placeholder="20">
                        </div>
                    </div>
                    <div class='flex items-center justify-center'>
                        <button type="button" id="botonProcesarPago"
                            class="bg-indigo-400 h-max w-max rounded-lg text-white font-bold hover:bg-indigo-300 ">
                            <div class="flex items-center justify-center m-[10px]">

                                <div class="ml-2"> Procesar pago<div>
                                    </div>
                        </button>
                    </div>
                </form>
            </div>
            <!-- End of Modal Content-->
        </div>
    </dialog>
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
        document.getElementById('botonProcesarPago').addEventListener('click', function() {
            // Obtener los datos del formulario
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            var formData = new FormData(document.getElementById('formularioPago'));
            formData.append('_token', csrfToken);
            fetch("/procesar-pago", {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Hubo un problema al procesar el pago.');
                    }
                    return response.json();
                })
                .then(data => {
                    // Aquí puedes manejar la respuesta del servidor, si es necesario
                    console.log('Pago procesado correctamente:', data);
                    $('#myModal').modal('hide');
                    $('#example1').DataTable().ajax.reload();
                })
                .catch(error => {
                    console.error('Error al procesar el pago:', error);
                });
        });
    </script>
    <script>
        function mostrarModal(elemento) {
            var nombre = elemento.getAttribute('data-nombre');
            var num_boleta = elemento.getAttribute('data-id');
            var mount = elemento.getAttribute('data-mount');
            var inst_id = elemento.getAttribute('data-inst_id');
            // Mostrar el modal y establecer el nombre en el contenido del modal
            document.getElementById('txt_data_cliente').value = nombre;
            document.getElementById('num_boleta').textContent = 'Recibo N° 000' + num_boleta;
            document.getElementById('monto').value = mount;
            document.getElementById('pendiente_id').value = num_boleta;
            document.getElementById('instalacion_id').value = inst_id;
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
                    url: "{{ route('pagos.realizados') }}",
                },
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'instalacion.cliente.nombre'
                    },
                    {
                        data: 'instalacion.cliente.celular'
                    },
                    {
                        data: 'instalacion.plan.nombre'
                    },
                    {
                        data: 'instalacion.ip'
                    },
                    {
                        data: 'instalacion.estado',
                        render: function(data, type, row) {
                            var clase = data == 0 ?
                                "flex items-center text-xs px-3 bg-red-200 text-red-800 rounded-full" :
                                "flex items-center text-xs px-3 bg-green-200 text-green-800 rounded-full";
                            return data == 0 ? '<div class="' + clase + '">Suspendido</div>' :
                                '<div class="' + clase + '">Activo</div>';
                        }
                    },
                    {
                        data: 'fecha_pago'
                    },
                    {
                        data: 'medio_pago'
                    },
                    {
                        data: 'monto_total'
                    },
                    {
                        data: 'id',
                        orderable: false,
                        searchable: false
                    }
                ],
                columnDefs: [{
                    // Definir botones de editar y eliminar en la última columna
                    targets: -1,
                    render: function(data, type, row) {
                        return '<div class="inline-flex items-center space-x-3" onclick="mostrarModal(this)" id="btn" data-inst_id="' +
                            row.instalacion.id + '" data-mount="' +
                            row.total + '" data-nombre="' +
                            row.instalacion.cliente.nombre + '" data-id="' +
                            row.id +
                            '"><a class="hover:text-white"> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"> <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg></a>' +
                            'Editar</div>';
                    }
                }]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        });
    </script>
@endsection
