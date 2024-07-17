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
    <div id="content" id="content" class="bg-white/10 col-span-9 rounded-lg p-6">
        <div class="w-full ">
            <div class="bg-white shadow-md rounded pt-2 pl-2 pr-2 ">

                <h1 class="font-bold py-4 uppercase">Pagos Pendientes</h1>


                <table id="example1" class="min-w-max w-full table-auto">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="text-left py-3 px-2 rounded-l-lg">Id</th>
                            <th class="text-left py-3 px-2 ">Nombre</th>
                            <th class="text-left py-3 px-2">Apellidos</th>
                            <th class="text-left py-3 px-2">DNI</th>
                            <th class="text-left py-3 px-2">Celular</th>
                            <th class="text-left py-3 px-2">Estado Servicio</th>
                            <th class="text-left py-3 px-2">Estado Pago</th>
                            <th class="text-left py-3 px-2">Plan</th>
                            <th class="text-left py-3 px-2">Ip</th>
                            <th class="text-left py-3 px-2">Total</th>
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
                        <div class="">
                            <style>
                                /* CHECKBOX TOGGLE SWITCH */
                                /* @apply rules for documentation, these do not work as inline style */
                                .toggle-checkbox:checked {
                                    @apply: right-0 border-green-400;
                                    right: 0;
                                    border-color: #68D391;
                                }

                                .toggle-checkbox:checked+.toggle-label {
                                    @apply: bg-green-400;
                                    background-color: #68D391;
                                }
                            </style>
                            <label for="toggle" class="text-xs text-gray-700">Generar Factura </label>
                            <div
                                class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                                <input type="checkbox" name="option_toggle" id="option_toggle"
                                    class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer" />
                                <label for="toggle"
                                    class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                            </div>
                        </div>
                        <div class="">
                            <label for="id_number" class="text-md text-gray-600">Tipo de documento</label>

                            <select id="tipo_doc" name="tipo_doc"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected value="03">Boleta Electrónica</option>
                                <option value="01">Factura Electrónica</option>

                            </select>
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
                    toastr.success('La operación se realizó exitosamente', 'Bien hecho', {
                        progressBar: true,
                        positionClass: 'toast-top-center'
                    });
                    document.getElementById('myModal').close()
                    $('#myModal').modal('hide');
                    $('#example1').DataTable().ajax.reload();
                })
                .catch(error => {
                    console.error('Error al procesar el pago:', error);
                });
        });
    </script>
    <script>
        const myHeaders = new Headers();
        myHeaders.append("Accept", "application/json");
        myHeaders.append("Content-Type", "application/json");
        myHeaders.append("Authorization",
            "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vZ3JlZW50ZXIudGVzdC9hcGkvbG9naW4iLCJpYXQiOjE2OTA0MjUwMzgsImV4cCI6MTY5MDQ2MTAzOCwibmJmIjoxNjkwNDI1MDM4LCJqdGkiOiIwdnM5MDhOZ2R4NVA1ajB1Iiwic3ViIjoiMSIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.F_X6ekYdGYz1WS2Gm0tfUeMmtnmVV1FjvY1S4XNIPtg"
            );

        const raw = JSON.stringify({
            "tipoDoc": "01",
            "tipoOperacion": "0101",
            "serie": "F001",
            "correlativo": "1",
            "fechaEmision": "2023-07-25T00:00:00-05:00",
            "formaPago": {
                "moneda": "PEN",
                "tipo": "Contado"
            },
            "tipoMoneda": "PEN",
            "company": {
                "ruc": 20609278235,
                "razonSocial": "Inkanet",
                "nombreComercial": "INKANET",
                "address": {
                    "ubigueo": "150101",
                    "departamento": "LIMA",
                    "provincia": "LIMA",
                    "distrito": "LIMA",
                    "urbanizacion": "-",
                    "direccion": "Av. Villa Nueva 221",
                    "codLocal": "0000"
                }
            },
            "client": {
                "tipoDoc": "6",
                "numDoc": 20000000001,
                "rznSocial": "EMPRESA X"
            },
            "details": [{
                    "tipAfeIgv": 10,
                    "codProducto": "P005",
                    "unidad": "NIU",
                    "descripcion": "PRODUCTO 1",
                    "cantidad": 2,
                    "mtoValorUnitario": 50,
                    "mtoValorVenta": 100,
                    "mtoBaseIgv": 100,
                    "porcentajeIgv": 18,
                    "igv": 18,
                    "totalImpuestos": 18,
                    "mtoPrecioUnitario": 59
                },
                {
                    "tipAfeIgv": 10,
                    "codProducto": "P002",
                    "unidad": "NIU",
                    "descripcion": "BOLSA PLASTICA",
                    "cantidad": 4,
                    "mtoValorUnitario": 0.05,
                    "mtoValorVenta": 0.2,
                    "mtoBaseIgv": 0.2,
                    "porcentajeIgv": 18,
                    "igv": 0.036,
                    "factorIcbper": 0.2,
                    "icbper": 0.8,
                    "totalImpuestos": 0.836,
                    "mtoPrecioUnitario": 0.059
                }
            ]
        });

        const requestOptions = {
            method: "POST",
            headers: myHeaders,
            body: raw,
            redirect: "follow"
        };

        fetch("http://inkanet.test/api/invoices/pdf", requestOptions)
            .then((response) => response.text())
            .then((result) => console.log(result))
            .catch((error) => console.error(error));
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
                    url: "{{ route('pagos.pendientes') }}",
                },
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'instalacion.cliente.nombre'
                    },
                    {
                        data: 'instalacion.cliente.apellidos'
                    },
                    {
                        data: 'instalacion.cliente.dni'
                    },
                    {
                        data: 'instalacion.cliente.celular'
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
                        data: 'estado',
                        render: function(data, type, row) {
                            var clase = data == 0 ?
                                "flex items-center text-xs px-3 bg-orange-200 text-orange-800 rounded-full" :
                                "";
                            return data == 0 ? '<div class="' + clase + '">Pendiente</div>' : data;
                        }
                    },
                    {
                        data: 'instalacion.plan.nombre'
                    },
                    {
                        data: 'instalacion.ip'
                    },
                    {
                        data: 'total'
                    },
                    {
                        data: 'id',
                        orderable: false,
                        searchable: false
                    },
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
                            '"><a class="text-green-500 cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg></a>' +
                            '</div>';
                    }
                }]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        });
    </script>
@endsection
