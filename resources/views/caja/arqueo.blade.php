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
    <div id="content" id="content" class="bg-white/10 col-span-9 rounded-lg p-0">
        <div class="w-full ">
            <div class="bg-white shadow-md rounded p-4 ">

                <button type="button" class=" bg-sky-300 h-max w-max rounded-lg text-white font-bold hover:bg-sky-500"
                    disabled>

                    <a href="#" onclick="mostrarModal(this)">
                        <div class="flex items-center justify-center m-[10px]">
                            Nuevo Ing/Egr
                        </div>
                    </a>
                </button>

                @if (session('message'))
                    <div id="successAlert"
                        class="font-regular relative mb-4 block w-full rounded-lg bg-green-500 p-4 text-base leading-5 text-white opacity-100 flex">
                        La caja se abrió exitosamente
                        <div class="ml-auto">
                            <button type="button" id="closeAlertButton"
                                class="inline-flex flex-shrink-0 justify-center items-center h-4 w-4 rounded-md text-white/[.5] hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-600 focus:ring-gray-500 transition-all text-sm dark:focus:ring-offset-gray-700 dark:focus:ring-gray-500">
                                <span class="sr-only">Close</span>
                                <svg class="w-3.5 h-3.5" width="16" height="16" viewBox="0 0 16 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M0.92524 0.687069C1.126 0.486219 1.39823 0.373377 1.68209 0.373377C1.96597 0.373377 2.2382 0.486219 2.43894 0.687069L8.10514 6.35813L13.7714 0.687069C13.8701 0.584748 13.9882 0.503105 14.1188 0.446962C14.2494 0.39082 14.3899 0.361248 14.5321 0.360026C14.6742 0.358783 14.8151 0.38589 14.9468 0.439762C15.0782 0.493633 15.1977 0.573197 15.2983 0.673783C15.3987 0.774389 15.4784 0.894026 15.5321 1.02568C15.5859 1.15736 15.6131 1.29845 15.6118 1.44071C15.6105 1.58297 15.5809 1.72357 15.5248 1.85428C15.4688 1.98499 15.3872 2.10324 15.2851 2.20206L9.61883 7.87312L15.2851 13.5441C15.4801 13.7462 15.588 14.0168 15.5854 14.2977C15.5831 14.5787 15.4705 14.8474 15.272 15.046C15.0735 15.2449 14.805 15.3574 14.5244 15.3599C14.2437 15.3623 13.9733 15.2543 13.7714 15.0591L8.10514 9.38812L2.43894 15.0591C2.23704 15.2543 1.96663 15.3623 1.68594 15.3599C1.40526 15.3574 1.13677 15.2449 0.938279 15.046C0.739807 14.8474 0.627232 14.5787 0.624791 14.2977C0.62235 14.0168 0.730236 13.7462 0.92524 13.5441L6.59144 7.87312L0.92524 2.20206C0.724562 2.00115 0.611816 1.72867 0.611816 1.44457C0.611816 1.16047 0.724562 0.887983 0.92524 0.687069Z"
                                        fill="currentColor" />
                                </svg>
                            </button>
                        </div>
                    </div>
                @endif
                <div class="content-caja pt-2 overflow-x-auto" id="content-caja">
                    @include('caja.table', [
                        'egresos' => $egresos,
                        'ingresos' => $ingresos,
                        'ingresos_ex' => $ingresos_ex,
                        'cajas' => $cajas,
                        'egresos_x_compra' => $egresos_x_compra,
                    ])
                </div>



            </div>
        </div>
    </div>

    <!-- Modal de edición -->


    <dialog id="myModal" class="w-11/12 md:w-3/4 lg:w-4/5 xl:w-5/6 max-w-xl p-4 sm:p-6 md:p-8 bg-white rounded-md">
        <div class="flex flex-col w-full  ">
            <!-- Header -->
            <div class="flex w-full h-7 justify-center items-center">
                <div class="flex w-10/12 h-7 py-1 justify-center items-center text-2xl font-bold" id="num_boleta">
                    Registro de Ingreso/Egreso
                </div>

                <!--Header End-->
            </div>
            <!-- Modal Content-->
            <!--Body-->
            <div class="my-5 mr-5 ml-5 flex justify-center">
                <form enctype="multipart/form-data" id="formularioCaja" method="POST">
                    @csrf
                    <div class="grid gird-cols-1 md:grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            <label for="id_cat" class="text-md text-gray-600">Tipo</label>
                            <select
                                class="bg-gray-50 border border-gray-300 focus:outline-none text-gray-900 text-sm rounded-lg
                                     focus:ring-indigo-500 focus:border-indigo-500 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                id="tipo" name="tipo">
                                <option value="0">Egreso</option>
                                <option value="1">Ingreso</option>
                            </select>
                        </div>
                        <div>
                            <label for="id_cat" class="text-md text-gray-600">Tipo pago</label>
                            <select
                                class="bg-gray-50 border border-gray-300 focus:outline-none text-gray-900 text-sm rounded-lg
                                 focus:ring-indigo-500 focus:border-indigo-500 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                id="tipo_pago" name="tipo_pago">
                                <option value="Efectivo">Efectivo</option>
                                <option value="Depósito">Depósito</option>
                                <option value="Checke">Checke</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid gird-cols-1 md:grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            <label for="id_prov" class="text-md text-gray-600">Tipo comprobante</label>
                            <select
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                                focus:ring-indigo-500 focus:border-indigo-500 block w-full p-1.5 dark:bg-gray-700
                                 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none "
                                id="tipo_comprobante" name="tipo_comprobante">
                                <option value="Boleta">Boleta</option>
                                <option value="Ticket">Factura</option>
                                <option value="Factura">Ticket</option>

                            </select>

                        </div>
                        <div>
                            <label for="phone" class="text-md text-gray-600">Monto en S/</label>
                            <input type="text" id="monto" autocomplete="off" name="monto"
                                class=" p-1 w-full border focus:outline-none  focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 mb-5 rounded-md uppercase">
                            <span class="text-red-500 text-sm error-text" id="monto-error"></span>
                        </div>
                    </div>

                    <div class="grid gird-cols-1 md:grid-cols-2 lg:grid-cols-1 gap-6 ">

                        <div class="">
                            <label for="id_number" class="text-md text-gray-600">Descripción</label>
                            <textarea name="descripcion" id="descripcion"
                                class="p-1 w-full border border-gray-300 mb-2 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                cols="30" rows="5"></textarea>
                            <span class="text-red-500 text-sm error-text" id="descripcion-error"></span>
                        </div>
                    </div>
                    <div class=' flex justify-center pt-4'>
                        <button type="button" id="addIngEgr"
                            class="addIngEgr bg-green-300 h-max w-max rounded-lg text-white font-bold hover:bg-green-500 ">
                            <div class="flex items-center justify-center m-[10px]">

                                <div class="ml-2"> Agregar<div>
                                    </div>
                        </button>
                        <button type="button"
                            class="bg-red-300 py-1 px-4 rounded-lg text-white font-bold hover:bg-red-500 mx-2"
                            onclick="document.getElementById('myModal').close();">
                            Cancelar
                        </button>
                    </div>
                </form>
            </div>
            <!-- End of Modal Content-->
        </div>
    </dialog>



    <dialog id="cerrarCaja" class="items-center justify-center  bg-white rounded-lg text-left  " role="dialog"
        aria-modal="true" aria-labelledby="modal-headline">

        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <!-- Modal content -->
            <div class="sm:flex sm:items-start">

                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline"> Estás seguro de cerrar
                        caja
                        chica
                    </h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500"> Fecha: <span class="font-bold">
                                {{ \Carbon\Carbon::parse(Date('Y-m-d'))->translatedFormat('d \d\e F Y') }} </span> </p>
                        <p class="text-sm text-gray-500"> Hora: <span
                                class="font-bold">{{ \Carbon\Carbon::parse(now())->translatedFormat('h:i A') }} </span>
                        </p>
                    </div>

                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <button type="button" id="addArqueo"
                class="abrir-caja w-full inline-flex justify-center rounded-md border border-transparent
                 shadow-sm px-4 py-2 bg-indigo-500 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                Confirmar </button>
            <a onclick="document.getElementById('cerrarCaja').close()"
                class="cursor-pointer mt-3 w-full inline-flex justify-center rounded-md border border-red-300 shadow-sm px-4 py-2 bg-red-400 text-base font-medium text-white hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                Despues
            </a>
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
    <script>
        function cerrarCaja(elemento) {
            document.getElementById('cerrarCaja').showModal();
        }
    </script>
    <script>
        document.getElementById('addArqueo').addEventListener('click', function() {
            // Obtener los datos del formulario
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            var formData = new FormData(document.getElementById('formulario-arqueo'));
            formData.append('_token', csrfToken);

            fetch("/add-arqueo", {
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
                                throw {
                                    status: 422,
                                    data: data
                                };
                            });
                        } else {
                            throw new Error('Hubo un problema al guardar.');
                        }
                    }
                    return response.text();
                })
                .then(html => {
                    // Éxito: actualizar la tabla con el HTML recibido
                    document.getElementById('content-caja').innerHTML = html;
                    document.getElementById('cerrarCaja').close();
                    toastr.success('La operación se realizó exitosamente', 'Bien hecho', {
                        progressBar: true,
                        positionClass: 'toast-top-center'
                    });
                    setTimeout(() => {
                        window.location.href = 'listar-caja';
                    }, 4000);
                })
                .catch(error => {
                    if (error.status === 422) {
                        // Limpiar errores anteriores
                        document.querySelectorAll('.error-text').forEach(el => el.textContent = '');
                        // Mostrar errores de validación
                        Object.keys(error.data.errors).forEach(key => {
                            const errorElement = document.getElementById(`${key}-error`);
                            if (errorElement) {
                                errorElement.textContent = error.data.errors[key][0];
                            }
                        });
                    } else {
                        toastr.error('Error al procesar la solicitud', 'Error', {
                            progressBar: true,
                            positionClass: 'toast-top-center'
                        });
                    }
                });
        });
    </script>
    <script>
        document.getElementById('addIngEgr').addEventListener('click', function() {
            // Obtener los datos del formulario
            $(this).prop('disabled', true);
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            var formData = new FormData(document.getElementById('formularioCaja'));
            formData.append('_token', csrfToken);

            fetch("/add-caja", {
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
                                throw {
                                    status: 422,
                                    data: data
                                };
                            });
                        } else {
                            throw new Error('Hubo un problema al guardar.');
                        }
                    }
                    return response.text();
                })
                .then(html => {
                    // Éxito: actualizar la tabla con el HTML recibido
                    document.getElementById('content-caja').innerHTML = html;
                    document.getElementById('myModal').close();
                    toastr.success('La operación se realizó exitosamente', 'Bien hecho', {
                        progressBar: true,
                        positionClass: 'toast-top-center'
                    });
                    $('#formularioCaja')[0].reset();
                    $('.addIngEgr').prop('disabled', false);
                })
                .catch(error => {
                    if (error.status === 422) {
                        // Limpiar errores anteriores
                        document.querySelectorAll('.error-text').forEach(el => el.textContent = '');
                        // Mostrar errores de validación
                        Object.keys(error.data.errors).forEach(key => {
                            const errorElement = document.getElementById(`${key}-error`);
                            if (errorElement) {
                                errorElement.textContent = error.data.errors[key][0];
                            }
                        });
                        $('.addIngEgr').prop('disabled', false);
                    } else {
                        toastr.error('Error al procesar la solicitud', 'Error', {
                            progressBar: true,
                            positionClass: 'toast-top-center'
                        });
                        $('.addIngEgr').prop('disabled', false);
                    }
                });
        });
    </script>
    <script>
        function mostrarModal(elemento) {

            document.getElementById('myModal').showModal();
        }
    </script>


    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
        crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cajaAbierta = @json($caja);
            const modalAbrirCaja = document.getElementById('abrirCaja');

            if (!cajaAbierta) {
                modalAbrirCaja.showModal();
            }
            // Manejar la confirmación de apertura de caja
        });
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
     
@endsection
