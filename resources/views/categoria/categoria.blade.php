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

                <button type="button" class=" bg-green-300 h-max w-max rounded-lg text-white font-bold hover:bg-green-500 "
                    disabled>

                    <a href="#" onclick="mostrarModal(this)">
                        <div class="flex items-center justify-center m-[10px]">
                            Nueva categoria
                        </div>
                    </a>
                </button>

                <h1 class="font-bold py-4 uppercase">Categoria</h1>
                <table class="min-w-full bg-white" id="categorias-table">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nombre</th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <!-- Repite este bloque para cada fila, cambiando los datos según corresponda -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <dialog class="bg-white shadow-md rounded-lg max-w-4xl mx-auto p-6 " id="myModal">
        <h2 class="text-2xl font-bold text-indigo-500 mb-6">Nueva categoría</h2>
        <form id='addCategoryForm' method="POST">
            @csrf
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2" for="nombre-comercial">Nombre de la
                        categoría
                    </label>
                    <input type="text" id="nombre" name="nombre"
                        class="flex-grow p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 w-full">
                </div>
            </div>
            <div class="mt-8 flex justify-between">
                <div>
                    <button type="button" onclick="document.getElementById('myModal').close();"
                        class="mr-2 inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Cerrar
                    </button>
                    <button type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Guardar
                    </button>
                </div>
            </div>
        </form>
    </dialog>
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
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline"> Eliminar Producto
                    </h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500"> ¿Estas seguro de eliminar <span class="font-bold">esta
                                categoria</span>? Esta acción no se puede deshacer. </p>
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

    <dialog class="bg-white shadow-md rounded-lg max-w-4xl mx-auto p-6 " id="editModal">
        <h2 class="text-2xl font-bold text-blue-500 mb-6">Editar Categoria</h2>
        <form id="editCategoryForm" method="POST">
            @csrf
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <input type="text" id="idE" name="idE" hidden>
                    <label class="block text-sm font-medium text-gray-700 mb-2" for="nombre-comercial">Nombre de la
                        categoría
                    </label>
                    <input type="text" id="nombreE" name="nombreE"
                        class="flex-grow p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 w-full">
                    <span id="nombreError" class="text-red-500"></span>
                </div>
            </div>
            <div class="mt-8 flex justify-between">
                <div>
                    <button type="button" onclick="document.getElementById('editModal').close();"
                        class="mr-2 inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Cerrar
                    </button>
                    <button type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Editar
                    </button>
                </div>
            </div>
        </form>
    </dialog>

    <script>
        $(document).ready(function() {
            // Inicializar DataTables con AJAX
            let table = $('#categorias-table').DataTable({
                "ajax": {
                    "url": "{{ route('categoria.show') }}", // Ruta que devuelve los datos en formato JSON
                    "type": "GET",
                    "dataSrc": "data" // Utiliza 'data' del objeto de respuesta
                },
                "columns": [{
                        "data": "id"
                    },
                    {
                        "data": "nombre"
                    },
                    {
                        "data": "id", // Usa el valor 'id' para generar el botón
                        "render": function(data, type, row) {
                            return `<div class="flex item-center justify-center" bis_skin_checked="1">
                        <div onclick="editModal(${row.id})" class="w-4 mr-2 transform text-yellow-500 hover:scale-110 cursor-pointer" bis_skin_checked="1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                            </svg>
                        </div>
                        <div onclick="deletModalProd(${row.id})" class="w-4 mr-2 transform text-red-500 hover:scale-110 cursor-pointer" bis_skin_checked="1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
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
        $('#editCategoryForm').on('submit', function(e) {
            e.preventDefault(); // Evita el envío tradicional del formulario

            let categoryId = $('#idE').val(); // Obtiene el ID de la categoría del campo oculto
            let nombre = $('#nombreE').val(); // Obtiene el valor del nombre de la categoría

            $.ajax({
                url: `/update/category/${categoryId}`, // Ruta para actualizar la categoría
                type: 'PUT', // Método HTTP para actualizar
                data: {
                    _token: '{{ csrf_token() }}', // Token CSRF para la seguridad
                    nombre: nombre,
                },
                success: function(response) {
                    toastr.success(response.message, 'Bien hecho', {
                        progressBar: true,
                        positionClass: 'toast-top-center'
                    });
                    // Ocultar el modal
                    document.getElementById('editModal').close();

                    // Limpiar el formulario
                    $('#editCategoryForm')[0].reset();

                    // Refrescar DataTables para mostrar los datos actualizados
                    $('#categorias-table').DataTable().ajax.reload();
                },
                error: function(xhr, status, error) {
                    console.error('Error al actualizar la categoría:', error);
                    alert('Ocurrió un error al intentar actualizar la categoría.');

                    // Mostrar mensajes de error específicos en el formulario
                    let errors = xhr.responseJSON.errors;
                    if (errors) {
                        // Si tienes un div o span para mostrar errores en el formulario
                        $('#nombreError').text(errors.nombre ? errors.nombre[0] : '');
                        // Añadir más errores según sea necesario
                    }
                }
            });
        });
    </script>
    <script>
        function editModal(categoryId) {
            document.getElementById('editModal').showModal();

            fetch(`/edit/category/${categoryId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json(); // Convierte la respuesta en JSON
                })
                .then(category => { // Utiliza 'category' en lugar de 'product'
                    // Rellenar el formulario con los datos de la categoría
                    document.getElementById('idE').value = category.id;
                    document.getElementById('nombreE').value = category.nombre;
                    // Rellenar otros campos según sea necesario
                })
                .catch(error => {
                    console.error('Error al cargar los datos del producto:', error);
                    alert('No se pudo cargar la información del producto');
                });

        }


        function deletModalProd(categoryId) {
            document.getElementById('deleteModal').showModal();
            const confirmButton = document.getElementById('confirmDeleteButton');
            confirmButton.onclick = function() {
                deleteCategory(categoryId);
            };
        }

        function deleteCategory(categoryId) {
            $.ajax({
                url: '{{ route('categorias.destroy') }}', // Ruta para eliminar la categoría
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}',
                    categoria_id: categoryId
                },
                success: function(response) {
                    document.getElementById('deleteModal').close();

                    toastr.success(response.message, 'Bien hecho', {
                        progressBar: true,
                        positionClass: 'toast-top-center'
                    });
                    $('#categorias-table').DataTable().ajax.reload(); // Refrescar DataTables
                },
                error: function(xhr, status, error) {
                    console.error('Error al eliminar la categoría:', error);
                    alert('Ocurrió un error al intentar eliminar la categoría.');
                }
            });

        }
    </script>
    <script>
        $('#addCategoryForm').on('submit', function(e) {
            e.preventDefault(); // Evitar el envío tradicional del formulario

            let nombre = $('#nombre').val(); // Obtener el valor del input

            $.ajax({
                url: '{{ route('categorias.store') }}', // Ruta para almacenar la categoría
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    nombre: nombre
                },
                success: function(response) {
                    // Ocultar el modal
                    // Limpiar el formulario
                    $('#addCategoryForm')[0].reset();
                    document.getElementById('myModal').close();
                    // Refrescar DataTables para mostrar la nueva categoría
                    $('#categorias-table').DataTable().ajax.reload();
                },
                error: function(xhr, status, error) {
                    // Limpiar mensajes de error anteriores
                    $('#addCategoryForm .error-message').remove();
                    // Manejar errores de validación
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        // Iterar sobre los errores y mostrarlos
                        $.each(errors, function(key, messages) {
                            // Encontrar el campo correspondiente y agregar mensajes de error
                            let input = $('#addCategoryForm [name=' + key + ']');
                            messages.forEach(function(message) {
                                input.after(
                                    '<span class="error-message text-red-500">' +
                                    message + '</span>');
                            });
                        });
                    }
                    // Manejar errores y mostrar mensajes aquí si es necesario
                }
            });
        });
    </script>
    <script>
        function mostrarModal(elemento) {
            document.getElementById('myModal').showModal();
        }
    </script>
    <!-- Bootstrap 4 -->
@endsection
