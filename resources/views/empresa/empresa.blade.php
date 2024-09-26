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



                <h1 class="font-bold py-4 uppercase">Información del negocio</h1>
                <table class="min-w-full bg-white" id="categorias-table">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Razón
                                social/Nombre
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                RUC</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nombre comercial
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Dirección</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Teléfono</th>

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



    <dialog class="bg-white shadow-md rounded-lg max-w-4xl mx-auto p-6 " id="editModal">
        <h2 class="text-2xl font-bold text-blue-500 mb-6">Editar datos de mi negocio</h2>
        <form id="editEmpresaForm" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <input type="text" id="id" name="id" hidden>
                    <label class="block text-sm font-medium text-gray-700 mb-2" for="nombre-comercial">RUC/DNI
                    </label>
                    <input type="text" id="ruc" name="ruc"
                        class="flex-grow p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 w-full">
                    <span id="rucError" class="text-red-500"></span>
                </div>
                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2" for="nombre-comercial">Razón social
                    </label>
                    <input type="text" id="razon_social" name="razon_social"
                        class="flex-grow p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 w-full">
                    <span id="razon_socialError" class="text-red-500"></span>
                </div>
                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2" for="nombre-comercial">Nombre comercial
                    </label>
                    <input type="text" id="nombre_comercial" name="nombre_comercial"
                        class="flex-grow p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 w-full">
                    <span id="nombre_comercialError" class="text-red-500"></span>
                </div>
                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2" for="nombre-comercial">Descripción
                    </label>
                    <input type="text" id="descripcion" name="descripcion"
                        class="flex-grow p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 w-full">

                </div>
                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2" for="nombre-comercial">Teléfono
                    </label>
                    <input type="text" id="telefono" name="telefono"
                        class="flex-grow p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 w-full">
                    <span id="telefonoError" class="text-red-500"></span>
                </div>
                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2" for="nombre-comercial">Dirección
                    </label>
                    <input type="text" id="direccion" name="direccion"
                        class="flex-grow p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 w-full">

                </div>
                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2" for="nombre-comercial">Logo
                    </label>
                    <input type="file" name="image" id="image" accept="image/*"
                        class="mt-2 p-2 border border-gray-300 rounded-lg w-full">
                    <div>
                        <img id="preview" src="#" alt="Vista Previa" class="hidden h-20 object-cover rounded-lg">
                    </div>
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
                    "url": "{{ route('empresa.view') }}", // Ruta que devuelve los datos en formato JSON
                    "type": "GET",
                    "dataSrc": "data" // Utiliza 'data' del objeto de respuesta
                },
                "columns": [{
                        "data": "razon_social"
                    },
                    {
                        "data": "ruc"
                    },
                    {
                        "data": "nombre_comercial"
                    },
                    {
                        "data": "direccion"
                    },
                    {
                        "data": "telefono"
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
    <script>
        function editModal(empresaId) {
            document.getElementById('editModal').showModal();

            fetch(`/edit/empresa/${empresaId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json(); // Convierte la respuesta en JSON
                })
                .then(empresa => { // Utiliza 'empresa' en lugar de 'product'
                    // Rellenar el formulario con los datos de la categoría
                    document.getElementById('id').value = empresa.id;
                    document.getElementById('ruc').value = empresa.ruc;
                    document.getElementById('razon_social').value = empresa.razon_social;
                    document.getElementById('nombre_comercial').value = empresa.nombre_comercial;
                    document.getElementById('descripcion').value = empresa.descripcion;
                    document.getElementById('telefono').value = empresa.telefono;
                    document.getElementById('direccion').value = empresa.direccion;
                    if (empresa.logo) {
                        //document.getElementById('imageE').src = empresa.imagen;
                        const imageElement = document.getElementById('preview');
                        imageElement.src = empresa.logo;
                        imageElement.style.display = 'block';
                    }
                    // Rellenar otros campos según sea necesario
                })
                .catch(error => {
                    console.error('Error al cargar los datos del producto:', error);
                    alert('No se pudo cargar la información del producto');
                });

        }
    </script>
    <script>
        $('#editEmpresaForm').on('submit', function(e) {
            e.preventDefault(); // Evita el envío tradicional del formulario

            let empresaId = $('#id').val();
            let ruc = $('#ruc').val();
            let razon_social = $('#razon_social').val();
            let nombre_comercial = $('#nombre_comercial').val();
            let descripcion = $('#descripcion').val();
            let telefono = $('#telefono').val();
            let direccion = $('#direccion').val();
            let img = document.getElementById('image').files[0]; // Obtener el archivo de imagen

            // Crear un objeto FormData para manejar archivos
            let formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}'); // Token CSRF para la seguridad
            formData.append('id', empresaId);
            formData.append('ruc', ruc);
            formData.append('razon_social', razon_social);
            formData.append('nombre_comercial', nombre_comercial);
            formData.append('descripcion', descripcion);
            formData.append('telefono', telefono);
            formData.append('direccion', direccion);

            if (img) {
                formData.append('logo', img); // Añadir el archivo de imagen solo si existe
            }

            $.ajax({
                url: `/update/empresa/${empresaId}`, // Ruta para actualizar la empresa
                type: 'POST', // Cambia a POST si Laravel no maneja PUT correctamente con FormData
                data: formData,
                processData: false, // No procesar los datos como cadena de texto
                contentType: false, // No establecer el tipo de contenido, es manejado automáticamente por FormData
                success: function(response) {
                    toastr.success(response.message, 'Bien hecho', {
                        progressBar: true,
                        positionClass: 'toast-top-center'
                    });

                    // Ocultar el modal
                    document.getElementById('editModal').close();

                    // Limpiar el formulario
                    $('#editEmpresaForm')[0].reset();

                    // Refrescar DataTables para mostrar los datos actualizados
                    $('#categorias-table').DataTable().ajax.reload();
                    setTimeout(function() {
                        location.reload(); // Recarga la página actual
                    }, 3000);

                },
                error: function(xhr, status, error) {
                    console.error('Error al actualizar empresa:', error);

                    // Mostrar mensajes de error específicos en el formulario
                    let errors = xhr.responseJSON.errors;
                    if (errors) {
                        $('#rucError').text(errors.ruc ? errors.ruc[0] : '');
                        $('#razon_socialError').text(errors.razon_social ? errors.razon_social[0] : '');
                        $('#nombre_comercialError').text(errors.nombre_comercial ? errors
                            .nombre_comercial[0] : '');
                        $('#telefonoError').text(errors.telefono ? errors.telefono[0] : '');
                        // Añadir más errores según sea necesario
                    }
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
