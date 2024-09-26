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
    <div id="content" class="bg-white/10 col-span-9 rounded-lg p-1">
        <div class="w-full ">
            <div class="bg-white shadow-md rounded pt-1 pl-1 pr-1 ">



                <div class="flex">
                    <!-- Primera columna que ocupa el 70% -->
                    <div class=" bg-white p-4" style="width: 80%">


                        @if (session('message'))
                            <div id="successAlert"
                                class="font-regular relative mb-4 block w-full rounded-lg bg-green-500 p-4 text-base leading-5 text-white opacity-100 flex">
                                La caja se abrió exitosamente
                                <div class="ml-auto">
                                    <button type="button" id="closeAlertButton"
                                        class="inline-flex flex-shrink-0 justify-center items-center h-4 w-4 rounded-md text-white/[.5] hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-600 focus:ring-gray-500 transition-all text-sm dark:focus:ring-offset-gray-700 dark:focus:ring-gray-500">
                                        <span class="sr-only">Close</span>
                                        <svg class="w-3.5 h-3.5" width="16" height="16" viewBox="0 0 16 16"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M0.92524 0.687069C1.126 0.486219 1.39823 0.373377 1.68209 0.373377C1.96597 0.373377 2.2382 0.486219 2.43894 0.687069L8.10514 6.35813L13.7714 0.687069C13.8701 0.584748 13.9882 0.503105 14.1188 0.446962C14.2494 0.39082 14.3899 0.361248 14.5321 0.360026C14.6742 0.358783 14.8151 0.38589 14.9468 0.439762C15.0782 0.493633 15.1977 0.573197 15.2983 0.673783C15.3987 0.774389 15.4784 0.894026 15.5321 1.02568C15.5859 1.15736 15.6131 1.29845 15.6118 1.44071C15.6105 1.58297 15.5809 1.72357 15.5248 1.85428C15.4688 1.98499 15.3872 2.10324 15.2851 2.20206L9.61883 7.87312L15.2851 13.5441C15.4801 13.7462 15.588 14.0168 15.5854 14.2977C15.5831 14.5787 15.4705 14.8474 15.272 15.046C15.0735 15.2449 14.805 15.3574 14.5244 15.3599C14.2437 15.3623 13.9733 15.2543 13.7714 15.0591L8.10514 9.38812L2.43894 15.0591C2.23704 15.2543 1.96663 15.3623 1.68594 15.3599C1.40526 15.3574 1.13677 15.2449 0.938279 15.046C0.739807 14.8474 0.627232 14.5787 0.624791 14.2977C0.62235 14.0168 0.730236 13.7462 0.92524 13.5441L6.59144 7.87312L0.92524 2.20206C0.724562 2.00115 0.611816 1.72867 0.611816 1.44457C0.611816 1.16047 0.724562 0.887983 0.92524 0.687069Z"
                                                fill="currentColor" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @endif
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

                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 overflow-auto min-h-auto max-h-[75vh]"
                            id="products-container">
                            @include('pos.partial-prod', ['productos' => $productos])
                        </div>

                    </div>

                    <!-- Segunda columna que ocupa el 30% -->
                    <div class="w-4/10 bg-white p-4 " style="width: 40%">

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
                            <div class="flex items-center space-x-2">
                                <label for="documento" class="whitespace-nowrap text-sm">Documento:</label>
                                <select name="tipo_comprobante" id="tipo_comprobante"
                                    class="tipocomprobante flex-grow py-1.5 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="B">Boleta</option>
                                    <option value="F">Factura</option>
                                    <option value="P">Proforma</option>
                                    <option value="C">Cotización</option>
                                    <option value="T">Ticket</option>
                                    <option value="R">Recibo</option>
                                </select>
                            </div>
                            <div class="flex items-center space-x-2 pt-1">
                                <label for="documento" class="whitespace-nowrap text-sm">Forma pago:</label>
                                <select name="forma_pago" id="forma_pago"
                                    class=" formapago flex-grow py-1.5 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="Contado">Contado</option>
                                    <option value="Crédito">Crédito</option>

                                </select>
                            </div>
                            <div class="flex items-center space-x-2 pt-1">
                                <label for="documento" class="whitespace-nowrap text-sm">Tipo pago:</label>
                                <select name="tipo_pago" id="tipo_pago"
                                    class="tipopago flex-grow py-1.5 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="Efectivo">Efectivo</option>
                                    <option value="Yape">Yape</option>
                                    <option value="Otros">Otros</option>
                                </select>
                            </div>
                            <br>
                            <hr>

                            <div id="cart-container" class="pt-3">
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
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
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
    <dialog id="confirmModal" class="items-center justify-center  bg-white rounded-lg text-left  " role="dialog"
        aria-modal="true" aria-labelledby="modal-headline">
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <!-- Modal content -->
            <div class="sm:flex sm:items-start">
                <div
                    class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-white sm:mx-0 sm:h-10 sm:w-10">
                    <!-- Heroicon name: outline/exclamation -->
                    <svg viewBox="0 0 24 24" class="text-green-400 w-16 h-16 mx-auto my-6">
                        <path fill="currentColor"
                            d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z">
                        </path>
                    </svg>
                </div>
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline"> Realizar venta
                    </h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500"> ¿Estas seguro de realizar <span class="font-bold">la
                                venta</span>? </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <button type="button"
                class="process-payment w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-500 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                Confirmar </button>
            <button onclick="document.getElementById('confirmModal').close();"
                class="mt-3 w-full inline-flex justify-center rounded-md border border-red-300 shadow-sm px-4 py-2 bg-red-400 text-base font-medium text-white hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                No </button>
        </div>

        <!-- End of Modal Content-->
    </dialog>


    <dialog id="abrirCaja" class="items-center justify-center  bg-white rounded-lg text-left  " role="dialog"
        aria-modal="true" aria-labelledby="modal-headline">
        <form action="{{ route('caja.open') }}" method="POST">
            @csrf
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <!-- Modal content -->
                <div class="sm:flex sm:items-start">

                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline"> Abrir Caja chica
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500"> Fecha: <span class="font-bold">
                                    {{ \Carbon\Carbon::parse(Date('Y-m-d'))->translatedFormat('d \d\e F Y') }} </span> </p>
                            <p class="text-sm text-gray-500"> Hora: <span
                                    class="font-bold">{{ \Carbon\Carbon::parse(now())->translatedFormat('h:i A') }} </span>
                            </p>
                        </div>
                        <div class="mt-2 flex">
                            <p>Saldo inicial S/</p>
                            <input type="number" id="saldo_inicial" name="saldo_inicial" value="0"
                                class="ml-4 w-16 h-8 text-center border-2 mt-1 rounded-lg focus:outline-none focus:border-blue-600">

                        </div>
                        @error('saldo_inicial')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="submit"
                    class="abrir-caja w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-500 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Confirmar </button>
                <a href="{{ route('dash.admin') }}"
                    class="mt-3 w-full inline-flex justify-center rounded-md border border-red-300 shadow-sm px-4 py-2 bg-red-400 text-base font-medium text-white hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Despues
                </a>
            </div>
        </form>
        <!-- End of Modal Content-->
    </dialog>
    <!-- DataTables  & Plugins -->

    <dialog id="ModalPDF" class=" w-11/12 md:w-1/2 p-5  bg-white rounded-md ">
        <div class="flex flex-col w-full  ">
            <!-- Header -->

            <!-- Modal Content-->
            <!--Body-->

            <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
                <iframe id="pdfIframe" src="" frameborder="0" style="width: 100%; height: 500px;"></iframe>
            </div>
            <div class="flex justify-end space-x-4 pt-6">
                <button type="button" onclick="location.reload()"
                    class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400">Cerrar</button>
                <button type="button" onclick="location.reload()"
                    class="btn-add-client bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Nueva
                    venta</button>
            </div>

        </div>

        <!-- End of Modal Content-->

    </dialog>

    <dialog id="historialComprasModal" class="items-center justify-center  bg-white rounded-lg text-left  "
        role="dialog" aria-modal="true" aria-labelledby="modal-headline">
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="flex w-full h-10 justify-center items-center">
                <div class="flex w-10/12 h-auto py-3 justify-center items-center text-2xl font-bold" id="num_boleta">
                    Historial de compras
                </div>
                <!--Header End-->
            </div>
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
        function showmodalConfirm() {
            document.getElementById('confirmModal').showModal();
        }
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cajaAbierta = @json($cajaAbierta);
            const modalAbrirCaja = document.getElementById('abrirCaja');

            if (!cajaAbierta) {
                modalAbrirCaja.showModal();
            }
            // Manejar la confirmación de apertura de caja
        });
    </script>
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


            $(document).on('click', '.add-to-cart', function(e) {
                e.preventDefault();
                var productId = $(this).data('id');
                var Idp = $('#oter-price' + productId).val();
                var stockElement = $(this).closest('.shadow-md').find('p[data-stock]');
                var stock = stockElement.data('stock'); // Accede al valor del stock

                if (stock <= 0) {
                    toastr.error('No cuentas con stock suficiente para este producto', 'Ops', {
                        progressBar: true,
                        positionClass: 'toast-top-center'
                    });
                    return false;
                }
                $.ajax({

                    url: '/add-to-cart/' + productId,

                    method: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        Idp: Idp,

                    },
                    success: function(response) {
                        var contenedor = document.getElementById('cart-container');
                        contenedor.innerHTML = response;
                    }
                });
            });

            $(document).on('change', '.quantity-input, .price-venta', function() {
                var $row = $(this).closest('tr'); // Cambiado de 'div' a 'tr'
                var id = $(this).data('id');
                var quantity = $row.find('.quantity-input').val();
                var price = $row.find('.price-venta').val();
                $.ajax({
                    url: '{{ route('cart.update') }}',
                    method: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        quantity: quantity,
                        price: price
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
                $(this).prop('disabled', true);
                let client_idS = $('.select2').val();
                let tipo_comprobante = $('.tipocomprobante').val();
                let forma_pago = $('.formapago').val();
                let tipo_pago = $('.tipopago').val();
                $.ajax({
                    url: '{{ route('payment.process') }}',
                    method: 'POST',
                    data: {
                        client_id: client_idS,
                        tipo_comprobante: tipo_comprobante,
                        forma_pago: forma_pago,
                        tipo_pago: tipo_pago,
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
                            document.getElementById('confirmModal').close()

                            $('#pdfIframe').attr('src', response.pdfUrl);

                            // Mostrar el modal
                            document.getElementById('ModalPDF').showModal();


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
    <script>
        document.getElementById('closeAlertButton').addEventListener('click', function() {
            document.getElementById('successAlert').style.display = 'none';
        });
    </script>
    <script>
        function openHistoryCompra(id) {
            document.getElementById('historialComprasModal').showModal();


            fetch(`/historial-compra/${id}`)
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
@endsection
