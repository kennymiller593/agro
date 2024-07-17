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


                <h1 class="font-bold py-4 uppercase">Ventas</h1>


                <table id="table-prod" class="min-w-max w-full table-auto tablita">
                    <thead>
                        <tr class="bg-gray-200  uppercase text-sm ">
                            <th class="text-left py-3 px-2 ">ID</th>
                            <th class="text-left py-3 px-2 ">Emisión</th>
                            <th class="text-left py-3 px-2 ">Cliente</th>
                            <th class="text-left py-3 px-2">Estado</th>
                            <th class="text-left py-3 px-2">Total</th>
                            <th class="text-left py-3 px-2">Acciones</th>

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
                <form enctype="multipart/form-data" id="formularioProd" method="POST">
                    @csrf
                    <div class="grid gird-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">

                        <div class="">
                            <label for="names" class="text-md text-gray-600">Producto</label>
                            <input type="text" id="txtprod" autocomplete="off" name="txtprod"
                                class=" p-2 w-full border focus:outline-none focus:ring-indigo-500 focus:border-indigo-500  border-gray-300 mb-5 rounded-md uppercase"
                                placeholder="Semilla Alfalfa">
                            <span class="text-red-500 text-sm error-text" id="txtprod-error"></span>
                        </div>
                        <div class="">
                            <label for="phone" class="text-md text-gray-600">Descripción</label>
                            <input type="text" id="txtdesc" autocomplete="off" name="txtdesc"
                                class=" p-2 w-full border focus:outline-none  focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 mb-5 rounded-md uppercase">
                            <span class="text-red-500 text-sm error-text" id="txtdesc-error"></span>
                        </div>
                    </div>
                    <div class="grid gird-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                        <div>
                            <label for="id_cat" class="text-md text-gray-600">Categoría</label>
                            <select
                                class="bg-gray-50 border border-gray-300 focus:outline-none text-gray-900 text-sm rounded-lg
                                 focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                id="txtid_cat" name="txtid_cat">
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="id_prov" class="text-md text-gray-600">Proveedor</label>
                            <select
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                                focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700
                                 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none "
                                id="txtid_prov" name="txtid_prov">
                                @foreach ($proveedores as $proveedor)
                                    <option value="{{ $proveedor->id }}">{{ $proveedor->razon_social }}</option>
                                @endforeach
                            </select>

                        </div>

                    </div>
                    <div class="grid gird-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 pt-4">

                        <div class="">
                            <label for="id_number" class="text-md text-gray-600">Stock Inicial</label>

                            <input type="text" id="txtstock" autocomplete="off" name="txtstock"
                                class="p-2 w-full border border-gray-300 mb-5 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <span class="text-red-500 text-sm error-text" id="txtstock-error"></span>
                        </div>
                        <div class="">
                            <label for="id_number" class="text-md text-gray-600">Unidad de medida</label>
                            <select
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500
                                 block w-full p-2.5 dark:bg-gray-700 focus:outline-none dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                                  "
                                id="txtid_med" name="txtid_med">
                                @foreach ($medidas as $medida)
                                    <option value="{{ $medida->id }}">{{ $medida->nombre }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="">
                            <label for="id_number" class="text-md text-gray-600">Precio compra</label>
                            <input type="text" id="txtprecio_co" autocomplete="off" name="txtprecio_co"
                                class="p-2 w-full border border-gray-300 mb-5 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <span class="text-red-500 text-sm error-text" id="txtprecio_co-error"></span>
                        </div>
                        <div class="">
                            <label for="id_number" class="text-md text-gray-600">Precio venta</label>
                            <input type="text" id="txtprecio_uv" autocomplete="off" name="txtprecio_uv"
                                class="p-2 w-full border border-gray-300 mb-5 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <span class="text-red-500 text-sm error-text" id="txtprecio_uv-error"></span>
                        </div>

                    </div>
                    <div class="grid gird-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700">Seleccionar
                                Imagen</label>
                            <input type="file" name="image" id="image" accept="image/*"
                                class="mt-2 p-2 border border-gray-300 rounded-lg w-full">
                        </div>
                        <div>
                            <img id="preview" src="#" alt="Vista Previa"
                                class="hidden w-full h-64 object-cover rounded-lg">
                        </div>
                    </div>


                    <div class=' items-center justify-center pt-4'>
                        <button type="button" id="addProd"
                            class="bg-green-300 h-max w-max rounded-lg text-white font-bold hover:bg-green-500 ">
                            <div class="flex items-center justify-center m-[10px]">

                                <div class="ml-2"> Agregar producto<div>
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
            $("#table-prod").DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.18/i18n/Spanish.json'
                },

                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                dom: 'Bfrtip',
                "buttons": [{
                        extend: 'excel',
                        text: 'Excel',
                        className: 'btn-custom-excel'
                    },
                    {
                        extend: 'pdf',
                        text: 'PDF',
                        className: 'btn-custom-pdf'
                    }
                ],
                "ajax": {
                    url: "{{ route('verComprobante') }}",
                },
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'fecha'
                    },

                    {
                        data: null, // Usamos 'null' ya que no estamos usando un campo específico
                        render: function(data, type, row) {
                            return `${row.cliente.nombres} ${row.cliente.apellidos}`;
                        },
                        name: 'nombre_completo',

                    },
                    {
                        data: 'estado'
                    },
                    {
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
                        return '<div class="inline-flex items-center space-x-3" id="btn" data-desc="">' +
                            '<a href="' + generatePdfUrl + '/' + row.id +
                            '" target="_blank" class="bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded cursor-pointer" title="Generar Factura">PDF</a>' +
                            '</div>';
                    }
                }],
                order: [
                    [0, 'desc'] // Ordenar por la primera columna (ID) de forma ascendente
                ],
                createdRow: function(row, data, dataIndex) {
                    $(row).addClass('custom-row-spacing');
                }
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        });
    </script>
    <script>
        function mostrarModal(elemento) {

            document.getElementById('num_boleta').textContent = 'Nuevo producto';

            document.getElementById('myModal').showModal();
        }
    </script>
@endsection
