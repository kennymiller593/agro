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
    <div id="content" id="content" class="bg-white/10 col-span-9 rounded-lg p-1">
        <div class="w-full ">
            <div class="bg-white shadow-md rounded pt-1 pl-1 pr-1 ">


                <h1 class="font-bold py-4 uppercase text-center">Lista de Ventas</h1>

                <div class="flex flex-wrap items-center justify-between space-x-2 mb-4">
                    <div class="flex items-center space-x-2">

                        <input type="date" id="date_from" value="{{ $startDate }}" class="px-2 py-1 border rounded"
                            placeholder="dd/mm/aaaa">

                        <input type="date" id="date_to" value="{{ $endDate }}" class="px-2 py-1 border rounded"
                            placeholder="dd/mm/aaaa">
                        <button id="filter-btn"
                            class="px-4 py-1 text-white bg-blue-500 rounded hover:bg-blue-600">Filtrar</button>
                    </div>

                    <div class="flex items-center space-x-2">

                        <div id="total-sum" class="font-bold"></div>
                        <input type="search" id="table-search" class="px-2 py-1 border rounded" placeholder="Buscar...">
                    </div>
                </div>

                <table id="table-prod" class=" min-w-max w-full table-auto tablita">
                    <thead>
                        <tr class="bg-green-200  uppercase text-sm ">
                            <th class="text-left py-3 px-2 ">ID</th>
                            <th class="text-left py-3 px-2 ">Emisión</th>
                            <th class="text-left py-3 px-2 ">Cliente</th>
                            <th class="text-left py-3 px-2 ">DNI/RUC</th>
                            <th class="text-left py-3 px-2">Estado</th>
                            <th class="text-left py-3 px-2">Total Cobrado</th>
                            <th class="text-left py-3 px-2">Acciones</th>

                        </tr>
                    </thead>
                </table>

            </div>
        </div>
    </div>

    <dialog id="deleteModal" class="items-center justify-center  bg-white rounded-lg text-left  " role="dialog"
        aria-modal="true" aria-labelledby="modal-headline">


        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <!-- Modal content -->
            <div class="sm:flex sm:items-start">
                <div
                    class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                    <!-- Heroicon name: outline/exclamation -->
                    <svg width="64px" height="64px" class="h-6 w-6 text-red-600" stroke="currentColor" fill="none"
                        viewBox="0 0 24.00 24.00" xmlns="http://www.w3.org/2000/svg" stroke="#ef4444"
                        stroke-width="0.45600000000000007">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M12 7.25C12.4142 7.25 12.75 7.58579 12.75 8V13C12.75 13.4142 12.4142 13.75 12 13.75C11.5858 13.75 11.25 13.4142 11.25 13V8C11.25 7.58579 11.5858 7.25 12 7.25Z"
                                fill="#ef4444"></path>
                            <path
                                d="M12 17C12.5523 17 13 16.5523 13 16C13 15.4477 12.5523 15 12 15C11.4477 15 11 15.4477 11 16C11 16.5523 11.4477 17 12 17Z"
                                fill="#ef4444"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M8.2944 4.47643C9.36631 3.11493 10.5018 2.25 12 2.25C13.4981 2.25 14.6336 3.11493 15.7056 4.47643C16.7598 5.81544 17.8769 7.79622 19.3063 10.3305L19.7418 11.1027C20.9234 13.1976 21.8566 14.8523 22.3468 16.1804C22.8478 17.5376 22.9668 18.7699 22.209 19.8569C21.4736 20.9118 20.2466 21.3434 18.6991 21.5471C17.1576 21.75 15.0845 21.75 12.4248 21.75H11.5752C8.91552 21.75 6.84239 21.75 5.30082 21.5471C3.75331 21.3434 2.52637 20.9118 1.79099 19.8569C1.03318 18.7699 1.15218 17.5376 1.65314 16.1804C2.14334 14.8523 3.07658 13.1977 4.25818 11.1027L4.69361 10.3307C6.123 7.79629 7.24019 5.81547 8.2944 4.47643ZM9.47297 5.40432C8.49896 6.64148 7.43704 8.51988 5.96495 11.1299L5.60129 11.7747C4.37507 13.9488 3.50368 15.4986 3.06034 16.6998C2.6227 17.8855 2.68338 18.5141 3.02148 18.9991C3.38202 19.5163 4.05873 19.8706 5.49659 20.0599C6.92858 20.2484 8.9026 20.25 11.6363 20.25H12.3636C15.0974 20.25 17.0714 20.2484 18.5034 20.0599C19.9412 19.8706 20.6179 19.5163 20.9785 18.9991C21.3166 18.5141 21.3773 17.8855 20.9396 16.6998C20.4963 15.4986 19.6249 13.9488 18.3987 11.7747L18.035 11.1299C16.5629 8.51987 15.501 6.64148 14.527 5.40431C13.562 4.17865 12.8126 3.75 12 3.75C11.1874 3.75 10.4379 4.17865 9.47297 5.40432Z"
                                fill="#ef4444"></path>
                        </g>
                    </svg>
                </div>
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline"> Eliminar Comprobante
                    </h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500"> ¿Estas seguro de eliminar <span class="font-bold">Este
                                comprobante</span>? Esta acción no se puede deshacer. </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <button type="button" id="confirmDeleteButton"
                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-500 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                Confirmar </button>
            <button onclick="document.getElementById('deleteModal').close();"
                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                Cancel </button>
        </div>

        <!-- End of Modal Content-->
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
        document.getElementById('addProd').addEventListener('click', function() {
            // Obtener los datos del formulario
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            var formData = new FormData(document.getElementById('formularioProd'));
            formData.append('_token', csrfToken);

            fetch("/add-prod", {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        if (response.status === 422) {
                            return response.json().then(data => {
                                // Limpiar errores anteriores
                                document.querySelectorAll('.error-text').forEach(el => el.textContent =
                                    '');
                                // Mostrar errores de validación
                                Object.keys(data.errors).forEach(key => {
                                    const errorElement = document.getElementById(
                                        `${key}-error`);
                                    if (errorElement) {
                                        errorElement.textContent = data.errors[key][0];
                                    }
                                });
                            });
                        } else {
                            throw new Error('Hubo un problema al guardar.');
                        }
                    } else {
                        toastr.success('La operación se realizó exitosamente', 'Bien hecho', {
                            progressBar: true,
                            positionClass: 'toast-top-center'
                        });
                        document.getElementById('myModal').close();
                        $('#myModal').modal('hide');
                        $('#table-prod').DataTable().ajax.reload();
                    }
                    return response.json();
                })

                .catch(error => {
                    console.error('Error al procesar el pago:', error);
                    toastr.error('Error al procesar el pago', 'Error', {
                        progressBar: true,
                        positionClass: 'toast-top-center'
                    });
                });
        });
    </script>
    <script>
        document.getElementById('image').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('preview');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = '#';
                preview.classList.add('hidden');
            }
        });
    </script>

    <style>
        .custom-row-spacing td {
            padding-top: 0.5px;
            padding-bottom: 0.5px;
        }

        .tablita {
            padding-top: 8px;
        }

        .btn-custom-excel {
            background-color: #107C41;
            /* Color gris oscuro de TailwindCSS */
            color: white;
            border-radius: 0.375rem;
            /* TailwindCSS rounded-md */
            padding: 0.5rem 1rem;
        }

        .btn-custom-pdf {
            background-color: #B30B00;
            /* Color gris oscuro de TailwindCSS */
            color: white;
            border-radius: 0.375rem;
            /* TailwindCSS rounded-md */
            padding: 0.5rem 1rem;
            /* TailwindCSS px-4 py-2 */
        }

        .dataTables_wrapper .dataTables_filter {
            float: right;
            text-align: right;
        }

        .dataTables_wrapper .dataTables_filter label {
            display: flex;
            align-items: center;
        }

        .dataTables_wrapper .dt-buttons {
            float: left;
        }
    </style>
    <script>
        const generatePdfUrl = "{{ url('generate-pdf') }}";
        $(function() {
            let table = $("#table-prod").DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.18/i18n/Spanish.json'
                },

                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                dom: 't<"bottom"lip>', // Esto elimina los botones predeterminados
                buttons: [],
                "ajax": {
                    url: "{{ route('verComprobante', ['date' => date('Y-m-d')]) }}",
                },
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'fecha',
                        render: function(data, type, row) {
                            if (type === 'display' || type === 'filter') {
                                var date = new Date(data);
                                var localDate = new Date(date.getTime() - date.getTimezoneOffset() *
                                    60000);
                                return localDate.toISOString().split('T')[0];
                            }
                            return data;
                        }

                    },

                    {
                        data: null, // Usamos 'null' ya que no estamos usando un campo específico
                        render: function(data, type, row) {
                            return `${row.cliente.nombres} ${row.cliente.apellidos}`;
                        },
                        name: 'nombre_completo',

                    },
                    {
                        data: 'cliente.num_doc'
                    },
                    {
                        data: null, // Usamos 'null' ya que no estamos usando un campo específico
                        render: function(data, type, row) {
                            return `<span class="rounded bg-green-400 py-1 px-3 text-xs font-bold">Pagado</span>`;
                        },
                        name: 'estado',
                    },
                    {
                        data: null, // Usamos 'null' ya que no estamos usando un campo específico
                        render: function(data, type, row) {
                            return `S/ ${row.total} `;
                        },
                        data: 'total'
                    },

                    {
                        data: 'id'
                    }
                ],
                columnDefs: [{
                    // Definir botones de editar y eliminar en la última columna
                    targets: -1,
                    render: function(data, type, row) {
                        return (
                            '<div class="inline-flex items-center space-x-3" id="btn" data-desc="">' +
                            '<a href="' + generatePdfUrl + '/' + row.id +
                            '" target="_blank" class="bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded cursor-pointer" title="Generar Factura">PDF</a>' +

                            '<button onclick="modalAnularVenta(' + row.id +
                            ')" class="bg-yellow-600 hover:bg-yellow-800 text-white font-bold py-2 px-4 rounded cursor-pointer">' +
                            'Anular' +
                            '</button>' +
                            '</div>'
                        );



                    }
                }],
                order: [
                    [0, 'desc'] // Ordenar por la primera columna (ID) de forma ascendente
                ],
                createdRow: function(row, data, dataIndex) {
                    $(row).addClass('custom-row-spacing');
                },
                "footerCallback": function(row, data, start, end, display) {
                    updateTotal(this.api());
                },

            });


            // Conecta el campo de búsqueda manual con DataTables
            $('#table-search').on('keyup', function() {
                table.search(this.value).draw();
            });
            // Añade la función de filtrado personalizada
            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    let min = $('#date_from').val();
                    let max = $('#date_to').val();
                    let date = data[1]; // Asumiendo que la fecha está en la segunda columna (índice 1)

                    if (min == "" && max == "") return true;
                    if (min == "" && date <= max) return true;
                    if (max == "" && date >= min) return true;
                    if (date >= min && date <= max) return true;
                    return false;
                }
            );

            function updateTotal(api) {
                let total = api
                    .column(5, {
                        search: 'applied'
                    }) // Asume que la columna "TOTAL COBRADO" es la sexta (índice 5)
                    .data()
                    .reduce(function(acc, val) {
                        // Extrae el número de la cadena "S/ XX.XX"
                        let number = parseFloat(val.replace('S/ ', '').replace(',', ''));
                        return acc + number;
                    }, 0);

                // Formatear el total como moneda
                let formattedTotal = new Intl.NumberFormat('es-PE', {
                    style: 'currency',
                    currency: 'PEN',
                    minimumFractionDigits: 2
                }).format(total);

                // Actualizar el elemento HTML con el total
                $('#total-sum').html('Total: ' + formattedTotal);
            }


            // Evento de clic para el botón de filtrado
            $('#filter-btn').click(function() {
                table.draw();
                updateTotal(table);
            });
        });
    </script>
    <script>
        $(function() {
            let dateFrom = $('#date_from');
            let dateTo = $('#date_to');

            // Función para establecer la fecha mínima del input "hasta"
            function setMinDateTo() {
                dateTo.attr('min', dateFrom.val());
                if (dateTo.val() < dateFrom.val()) {
                    dateTo.val(dateFrom.val());
                }
            }

            // Función para establecer la fecha máxima del input "desde"
            function setMaxDateFrom() {
                dateFrom.attr('max', dateTo.val());
                if (dateFrom.val() > dateTo.val()) {
                    dateFrom.val(dateTo.val());
                }
            }

            // Evento change para el input "desde"
            dateFrom.on('change', setMinDateTo);

            // Evento change para el input "hasta"
            dateTo.on('change', setMaxDateFrom);

            // Configuración inicial
            if (dateFrom.val()) setMinDateTo();
            if (dateTo.val()) setMaxDateFrom();

            // ... resto de tu código de DataTables ...

            // Evento de clic para el botón de filtrado

        });
    </script>
    <script>
        function mostrarModal(elemento) {



            document.getElementById('myModal').showModal();
        }

        function modalAnularVenta(comprobanteID) {

            console.log(comprobanteID);

            document.getElementById('deleteModal').showModal();
            const confirmButton = document.getElementById('confirmDeleteButton');
            confirmButton.onclick = function() {
                deleteComprobante(comprobanteID);
            };
        }

        function deleteComprobante(comprobanteID) {
            $.ajax({
                url: '{{ route('comprobante.destroy') }}', // Ruta para eliminar la categoría
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}',
                    comprobante_id: comprobanteID
                },
                success: function(response) {
                    document.getElementById('deleteModal').close();

                    toastr.success(response.message, 'Bien hecho', {
                        progressBar: true,
                        positionClass: 'toast-top-center'
                    });
                    $('#table-prod').DataTable().ajax.reload(); // Refrescar DataTables
                },
                error: function(xhr, status, error) {
                    console.error('Error al eliminar la categoría:', error);
                    alert('Ocurrió un error al intentar eliminar la categoría.');
                }
            });

        }
    </script>
@endsection
