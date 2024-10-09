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



                <div class="grid grid-cols-12">
                    <!-- Primera columna que ocupa el 70% -->

                    <div class="col-span-12 sm:col-span-6 md:col-span-7 2xl:col-span-8 order-2 md:order-1 bg-white p-4" >
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

                        <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 xl:grid-cols-1 gap-4 overflow-x-auto"
                            id="products-container">


                            @include('producto.table-compra', ['productos' => $productos])

                        </div>
                    </div>

                    <!-- Segunda columna que ocupa el 30% -->
                    <div class=" col-span-12 sm:col-span-6 md:col-span-5 2xl:col-span-4 order-1 md:order-2 bg-white p-4 ">

                        <div class="bg-white shadow-md rounded-lg p-2 ">

                            <div class="flex flex-col items-start ">
                                <label for="documento" class="whitespace-nowrap text-sm">Tipo Movimiento:</label>
                                <select name="tipo_mov" id="tipo_mov"
                                    class="tipo_mov w-full mt-2 flex-grow py-1.5 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="1">Compra - Ingreso</option>
                                    <option value="2">Otros</option>

                                </select>
                            </div>
                            <div class="flex flex-col items-start pt-2">
                                <label for="documento" class="whitespace-nowrap text-sm">Proveedor:</label>

                                <select name="proveedor" id="proveedor"
                                    class="proveedor mt-2 w-full flex-grow py-1.5 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

                                    @foreach ($proveedores as $proveedor)
                                        <option value="{{ $proveedor->id }}">{{ $proveedor->razon_social }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="flex flex-col items-start pt-2">
                                <label for="documento" class="whitespace-nowrap text-sm">Fecha compra:</label>
                                <input type="datetime-local" id="fecha" value="{{ date('Y-m-d\TH:i') }}"
                                    class="fecha proveedor mt-2 w-full flex-grow py-1.5 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm
                                    name="fecha">
                            </div>
                            <br>
                            <hr>

                            <div id="cart-container" class="pt-3">
                                @include('producto.formulario')
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


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
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline"> Realizar Compra
                    </h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500"> ¿Estás seguro de realizar <span class="font-bold">la
                                compra</span>? esta acción sumará en tu stock</p>
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
        function showmodalConfirm() {
            document.getElementById('confirmModal').showModal();
        }
    </script>


    <script>
        $(document).ready(function() {

            $('#search-prod').on('keyup', function() {
                var query = $(this).val();
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                $.ajax({
                    url: '{{ route('search.prod.compra') }}',
                    type: "GET",
                    data: {
                        'query': query
                    },
                    success: function(data) {
                        $('#products-container').html(data);
                    }
                });
            });

            $(document).on('click', '.add-to-cart', function(e) {
                e.preventDefault();
                var productId = $(this).data('id');
                console.log(productId);

                $.ajax({
                    url: '/add-to-cart-compra/' + productId,

                    method: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        var contenedor = document.getElementById('cart-container');
                        contenedor.innerHTML = response;
                    }
                });
            });

            $(document).on('change', '.quantity-input, .price-compra', function() {
                var $row = $(this).closest('tr'); // Cambiado de 'div' a 'tr'
                var id = $(this).data('id');
                var quantity = $row.find('.quantity-input').val();
                var price = $row.find('.price-compra').val();

                $.ajax({
                    url: '{{ route('cart.update.compra') }}',
                    method: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        quantity: quantity,
                        price: price
                    },
                    success: function(response) {
                        $('#cart-container').html(response);
                    }
                });
            });

            $(document).on('click', '.remove-from-cart', function(e) {
                e.preventDefault();
                var productId = $(this).closest('.cart-item').data('id');
                $.ajax({
                    url: '/remove-from-cart-compra/' + productId,
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

                let tipo_movimiento = $('.tipo_mov').val();
                let proveedor_id = $('.proveedor').val();
                let fecha = $('.fecha').val();
                $.ajax({
                    url: '{{ route('payment.process.compra') }}',
                    method: 'POST',
                    data: {
                        tipo_movimiento: tipo_movimiento,
                        proveedor_id: proveedor_id,
                        fecha: fecha,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success('Compra realizado exitosamente', 'Bien hecho', {
                                progressBar: true,
                                positionClass: 'toast-top-center'
                            });
                            // Limpiamos el carrito en la interfaz
                            $('#cart-container').html('<p>Tu carrito está vacío.</p>');
                            document.getElementById('confirmModal').close()
                            $('.process-payment').prop('disabled', false);
                            // location.reload();
                        } else {
                            alert('Hubo un error al procesar el pago.');
                            $('.process-payment').prop('disabled', false);
                        }
                    },
                    error: function() {
                        alert('Hubo un error al procesar el pago.');
                        $('.process-payment').prop('disabled', false);
                    }
                });
            });

        });
    </script>
    <script>
        function mostrarModal(elemento) {
            document.getElementById('myModal').showModal();
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
        document.getElementById('closeAlertButton').addEventListener('click', function() {
            document.getElementById('successAlert').style.display = 'none';
        });
    </script>
    <script>
        window.onload = function() {
            addBgToMenuItem('compras_nuevacompra');
        };
    </script>
@endsection
