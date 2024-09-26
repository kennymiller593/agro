@extends('admin-layout')
@section('content')
    <!-- CSS de DataTables -->

    <!-- CSS de DataTables en español -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/plug-ins/1.11.5/i18n/Spanish.json">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">

    <!-- JavaScript de jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- JavaScript de DataTables -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <div id="content" id="content" class="bg-white/10 col-span-9 rounded-lg p-0">
        <div class="w-full ">
            <div class="bg-white shadow-md rounded pt-1 pl-1 pr-1 ">



                <h1 class="font-bold py-4 uppercase">Lista de compras</h1>
                <table class="min-w-full bg-white" id="categorias-table">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                F. Emisión</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Proveedor</th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Total</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Productos</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <!-- Repite este bloque para cada fila, cambiando los datos según corresponda -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <dialog id="historialComprasModal" class="items-center justify-center  bg-white rounded-lg text-left  " role="dialog"
        aria-modal="true" aria-labelledby="modal-headline">
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">

            <!-- Modal content -->
            <div class="sm:flex sm:items-start">
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <div id="historialContent" class="mt-2 px-7 py-3">
                        <!-- El contenido del historial se cargará aquí -->
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <button onclick="document.getElementById('historialComprasModal').close();"
                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                Cerrar </button>
        </div>
        <!-- End of Modal Content-->
    </dialog>

    <script>
        $(document).ready(function() {
            // Inicializar DataTables con AJAX
            let table = $('#categorias-table').DataTable({
                "ajax": {
                    "url": "{{ route('listar.compra') }}", // Ruta que devuelve los datos en formato JSON
                    "type": "GET",
                    "dataSrc": "data" // Utiliza 'data' del objeto de respuesta
                },
                "columns": [{
                        "data": "id"
                    },
                    {
                        "data": "fecha"
                    },
                    {
                        "data": "proveedor.razon_social"
                    },
                    {

                        data: null, // Usamos 'null' ya que no estamos usando un campo específico
                        render: function(data, type, row) {
                            return `s/${row.total} `;
                        },
                        name: 'total',
                    },
                    {
                        "data": "id", // Usa el valor 'id' para generar el botón
                        "render": function(data, type, row) {
                            return `<div class="flex item-center justify-center" bis_skin_checked="1">
                        <div onclick="mostrarModal(${row.id})" class="w-4 mr-2 transform text-yellow-500 hover:scale-110 cursor-pointer" bis_skin_checked="1">
                           <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                 <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                 <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                          </svg>
                        </div>
                    </div>`;
                        },
                        "orderable": false, // Si no deseas que esta columna sea ordenable
                        "searchable": false // Si no deseas que esta columna sea buscable
                    }
                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json"
                },
                'order': [
                    [1, 'desc']
                ],

                "error": function(xhr, error, thrown) {
                    console.error('Error al cargar los datos: ', xhr.responseText);
                    alert(
                        'Error al cargar los datos de la tabla. Verifica la consola para más detalles.'
                    );
                }
            });
        });
    </script>

    <script>
        function mostrarModal(id) {
            document.getElementById('historialComprasModal').showModal();

            fetch(`/detalle-compra/${id}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text();
                })
                .then(html => {
                    document.getElementById('historialContent').innerHTML = html;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>
    <!-- Bootstrap 4 -->
@endsection
