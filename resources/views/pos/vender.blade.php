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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <div id="content" class="bg-white/10 col-span-9 rounded-lg p-6">
        <div class="w-full ">
            <div class="bg-white shadow-md rounded pt-2 pl-2 pr-2 ">



                <div class="flex">
                    <!-- Primera columna que ocupa el 70% -->
                    <div class=" bg-white p-4" style="width: 80%">


                        <div class="flex mb-4">
                            <input type="text" placeholder="Buscar productos" id="search-prod" name="search-prod"
                                class="flex-grow p-2 border border-gray-300 rounded-l-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 ">
                            <button class="bg-gray-200 p-2 rounded-r">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                            </button>
                        </div>
                        <div class="grid xl:grid-cols-5 lg:grid-cols-3 sm:grid-cols-2 xs:grid-cols-1  gap-4"
                            id="products-container">
                            
                              
                                @include('pos.partial-prod', ['productos' => $productos])
                           
                        </div>
                    </div>

                    <!-- Segunda columna que ocupa el 30% -->
                    <div class="w-4/10 bg-gray-200 p-4" style="width: 40%">

                        <div class="bg-white shadow-md rounded-lg p-2 max-w-md mx-auto">
                            <div class="flex justify-between items-center mb-4">
                                <select
                                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm select2"
                                    id="client_id">

                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">
                                            {{ $cliente->num_doc . '-' . $cliente->nombres . ' ' . $cliente->apellidos }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="flex space-x-2">
                                    <button class="border rounded p-1" href="#" onclick="mostrarModal(this)">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>

                                </div>
                            </div>
                            <div id="cart-container">
                                @include('pos.partial')
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <dialog id="myModal" class=" w-11/12 md:w-1/2 p-5  bg-white rounded-md ">
        <div class="flex flex-col w-full  ">
            <!-- Header -->
            <div class="flex w-full h-auto justify-center items-center">
                <div class="flex w-10/12 h-auto py-3 justify-center items-center text-2xl font-bold" id="num_boleta">
                    NUEVO CLIENTE
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


            <form class="space-y-6" method="POST" id="formularioClient">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="tipo-doc" class="block text-sm font-medium text-gray-700">Tipo Doc. Identidad
                            <span class="text-red-500">*</span></label>
                        <select id="tipo-doc" name="tipo-doc"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="1">DNI</option>
                            <option value="2">RUC</option>
                            <option value="3">PASAPORTE</option>
                            <option value="4">SIN DOCUMENTO</option>
                        </select>
                    </div>
                    <div>
                        <label for="numero" class="block text-sm font-medium text-gray-700">Número <span
                                class="text-red-500 error-text" id="num_doc-error">*</span></label>
                        <div class="flex">
                            <input type="text" id="num_doc" name="num_doc"
                                class="num-doc mt-1 block w-full py-2 px-3 border border-gray-300 rounded-l-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <button type="button"
                                class="search-to-sunat bg-blue-500 text-white px-4 py-2 rounded-r-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">RENIEC</button>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre <span
                                class="text-red-500 error-text" id="nombre-error">*</span></label>
                        <input type="text" id="nombre" name="nombre"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="nombre-comercial" class="block text-sm font-medium text-gray-700">Nombre
                            comercial</label>
                        <input type="text" id="nombre-comercial" name="nombre-comercial"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección
                        </label>
                        <input type="text" id="direccion" name="direccion" placeholder="Pomacucho"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="tipo-cliente" class="block text-sm font-medium text-gray-700">Teléfono</label>
                        <input type="text" id="telefono" name="telefono" placeholder="999999"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button"
                        class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400">Cancelar</button>
                    <button type="button"
                        class="btn-add-client bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Guardar</button>
                </div>
            </form>
        </div>

        <!-- End of Modal Content-->

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <!-- Initialize Select2 -->
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
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
        $(document).ready(function() {

            $('#search-prod').on('keyup', function() {
                var query = $(this).val();
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                $.ajax({
                    url: "/search",
                    type: "GET",
                    data: {
                        'query': query
                    },
                    success: function(data) {
                        $('#products-container').html(data);
                    }
                });
            });

            $('.btn-add-client').click(function(e) {
                e.preventDefault();

                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                var formData = new FormData(document.getElementById('formularioClient'));
                formData.append('_token', csrfToken);

                fetch('{{ route('clientes.save') }}', {
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
                                    document.querySelectorAll('.error-text').forEach(el => el
                                        .textContent =
                                        '');
                                    // Mostrar errores de validación
                                    Object.keys(data.errors).forEach(key => {
                                        const errorElement = document.getElementById(
                                            `${key}-error`);
                                        if (errorElement) {
                                            errorElement.textContent = data.errors[key][
                                                0
                                            ];
                                        }
                                    });
                                });
                            } else {
                                throw new Error('Hubo un problema al guardar.');
                            }
                        } else {
                            return response.json();
                        }
                    })
                    .then(data => {
                        if (data) {
                            console.log('id:' + data.cliente_id);
                            addDNI(data.cliente_id);
                            toastr.info('Cliente agregado', 'Bien hecho', {
                                progressBar: true,
                                positionClass: 'toast-top-center'
                            });
                            document.getElementById('myModal').close();
                        }
                    })
                    .catch(error => {
                        console.error('Error al procesar el pago:', error);

                    });
            });

            $('.search-to-sunat').click(function(e) {
                e.preventDefault();
                var num_doc = $('.num-doc').val();
                $.ajax({
                    url: "/consulta-dni",
                    method: "POST",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        dni: num_doc
                    },
                    success: function(data) {
                        if (data.tipoDocumento == 1) {
                            $('#nombre').val(data.nombres);
                            $('#nombre-comercial').val(data.apellidoPaterno + ' ' + data
                                .apellidoMaterno);
                        } else if (data.tipoDocumento == 6) {
                            $('#nombre').val(data.razonSocial);
                            $('#nombre-comercial').val(data.condicion);
                        }
                    },
                    error: function() {
                        console.error('Hubo un problema al buscar dni.');
                    }
                });
            });


            $('.add-to-cart').click(function(e) {
                e.preventDefault();
                var productId = $(this).data('id');
                var Idp = $('#oter-price' + productId).val();

                console.log(Idp);
                $.ajax({
                    url: '/add-to-cart/' + productId,
                    method: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        Idp: Idp
                    },
                    success: function(response) {
                        var contenedor = document.getElementById('cart-container');
                        contenedor.innerHTML = response;
                    }
                });
            });

            $(document).on('click', '.remove-from-cart', function(e) {
                e.preventDefault();
                var productId = $(this).closest('.cart-item').data('id');
                $.ajax({
                    url: '/remove-from-cart/' + productId,
                    method: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        var contenedor = document.getElementById('cart-container');
                        contenedor.innerHTML = response;
                    }
                });
            });

            $(document).on('click', '.process-payment', function(e) {
                console.log('aqui');
                let client_idS = $('.select2').val();
                $.ajax({
                    url: '{{ route('payment.process') }}',
                    method: 'POST',
                    data: {
                        client_id: client_idS,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success('Venta realizado exitosamente', 'Bien hecho', {
                                progressBar: true,
                                positionClass: 'toast-top-center'
                            });
                            // Limpiamos el carrito en la interfaz
                            $('#cart-container').html('<p>Tu carrito está vacío.</p>');

                            window.open(response.pdfUrl, '_blank');
                            // location.reload();
                        } else {
                            alert('Hubo un error al procesar el pago.');
                        }
                    },
                    error: function() {
                        alert('Hubo un error al procesar el pago.');
                    }
                });
            });

        });

        function addDNI(client_id) {
            console.log('id' + client_id);
            var newDNI = $('#num_doc').val();
            var nombre = $('#nombre').val();
            var nombre_com = $('#nombre-comercial').val();
            if (newDNI) {
                var newOption = new Option(newDNI + '-' + nombre + ' ' + nombre_com, client_id, true, true);
                $('#client_id').append(newOption).trigger('change');

            }
        }
    </script>
    <script>
        function mostrarModal(elemento) {
            document.getElementById('myModal').showModal();
        }
    </script>
@endsection
