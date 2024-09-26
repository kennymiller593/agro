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
            <div class="bg-white shadow-md rounded pt-1 pl-1 pr-1 ">

                <button type="button" class=" bg-green-300 h-max w-max rounded-lg text-white font-bold hover:bg-green-500 "
                    disabled>

                    <a href="#" onclick="mostrarModal(this)">
                        <div class="flex items-center justify-center m-[10px]">
                            Nuevo Cliente
                        </div>
                    </a>
                </button>

                <h1 class="font-bold py-4 uppercase">Lista de clientes</h1>
                @if (session('message'))
                    <div id="successAlert"
                        class="font-regular relative mb-4 block w-full rounded-lg bg-green-500 p-4 text-base leading-5 text-white opacity-100 flex">
                        {{ session('message') }}
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

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nombre</th>

                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tipo de documento</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Número</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Dirección</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Teléfono</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($clientes as $cliente)
                                <tr>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"> {{ $cliente->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $cliente->nombres . ' ' . $cliente->apellidos }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">

                                        {{ ($cliente->tipo_doc ?? '1') == '1' ? 'DNI' : 'RUC' }}


                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"> {{ $cliente->num_doc }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $cliente->direccion }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $cliente->telefono }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div class="flex item-center justify-center">

                                            <div onclick="editModal({{ $cliente->id }})"
                                                class="w-4 mr-2 transform text-yellow-500 hover:scale-110 cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </div>
                                            <div onclick="deletModalClient({{ $cliente->id }})"
                                                class="w-4 mr-2 transform text-red-500 hover:scale-110 cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            <!-- Repite este bloque para cada fila, cambiando los datos según corresponda -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <dialog class="bg-white shadow-md rounded-lg max-w-4xl mx-auto p-6 " id="myModal">
        <h2 class="text-2xl font-bold text-indigo-500 mb-6">Nuevo Cliente</h2>
        <form action="{{ route('registrar.cliente') }}" method="POST">
            @csrf
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2" for="tipo-doc">Tipo Doc. Identidad *</label>
                    <select id="tipo_doc" name="tipo_doc"
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="1">RUC</option>
                        <option value="2">DNI</option>

                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2" for="numero">DNI/RUC *</label>
                    <div class="mt-1 flex rounded-md shadow-sm">
                        <input type="text" id="numero" name="numero"
                            class="numero flex-grow p-2 border border-gray-300 rounded-l-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 "
                            placeholder="0/11">
                        <button
                            class="search-to-sunat inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                            RENIEC
                        </button>
                        @error('numero')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2" for="codigo-barra">Nombre</label>
                    <input type="text" id="rs" name="rs"
                        class="flex-grow p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 w-full">
                    @error('rs')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                    <input type="text" id="apellidos" name="apellidos" hidden>
                    <input type="text" id="nombres" name="nombres" hidden>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2" for="nombre-comercial">Nombre Comercial
                    </label>
                    <input type="text" id="nombre_comercial" name="nombre_comercial"
                        class="flex-grow p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 w-full">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2" for="codigo-barra">Dirección</label>
                    <input type="text" id="direccion" name="direccion"
                        class="flex-grow p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 w-full">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2" for="nombre-comercial">Teléfono</label>
                    <input type="text" id="telefono" name="telefono"
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

    <dialog class="bg-white shadow-md rounded-lg max-w-4xl mx-auto p-6 " id="editModal">
        <h2 class="text-2xl font-bold text-blue-500 mb-6">Editar Cliente</h2>
        <form action="{{ route('update.cliente') }}" id="editForm" method="POST">
            @csrf
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <input type="text" id="idE" name="idE" hidden>
                    <label class="block text-sm font-medium text-gray-700 mb-2" for="tipo-doc">Tipo Doc. Identidad
                        *</label>
                    <select id="tipo_docE" name="tipo_docE"
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="1">RUC</option>
                        <option value="2">DNI</option>

                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2" for="numero">DNI/RUC *</label>
                    <div class="mt-1 flex rounded-md shadow-sm">
                        <input type="text" id="numeroE" name="numeroE" value="{{ old('numeroE') }}"
                            class="numerito flex-grow p-2 border border-gray-300 rounded-l-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 "
                            placeholder="0/11">
                        <button
                            class="search-to-sunatE inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                            RENIEC
                        </button>
                        <div id="numeroEError" class="error-message text-red-500"></div>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2" for="codigo-barra">Nombres</label>
                    <input type="text" id="rsE" name="rsE" value="{{ old('rsE') }}" readonly
                        class="disabled:opacity-50 disabled:cursor-not-allowed flex-grow p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 w-full">
                    <div id="rsEError" class="error-message text-red-500"></div>
                    <input type="text" id="apellidosE" name="apellidosE" hidden>
                    <input type="text" id="nombresE" name="nombresE" hidden>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2" for="nombre-comercial">Nombre
                        comercial</label>
                    <input type="text" id="nombre_comercialE" value="{{ old('nombre_comercialE') }}"
                        name="nombre_comercialE"
                        class="flex-grow p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 w-full">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2" for="codigo-barra">Dirección</label>
                    <input type="text" id="direccionE" name="direccionE" value="{{ old('direccionE') }}"
                        class="flex-grow p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 w-full">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2" for="nombre-comercial">Teléfono</label>
                    <input type="text" id="telefonoE" name="telefonoE" value="{{ old('telefonoE') }}"
                        class="flex-grow p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 w-full">
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
    <dialog id="deleteModal" class="items-center justify-center  bg-white rounded-lg text-left  " role="dialog"
        aria-modal="true" aria-labelledby="modal-headline">
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <!-- Modal content -->
            <div class="sm:flex sm:items-start">
                <div
                    class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                    <!-- Heroicon name: outline/exclamation -->
                    <svg width="64px" height="64px" class="h-6 w-6 text-red-600" stroke="currentColor"
                        fill="none" viewBox="0 0 24.00 24.00" xmlns="http://www.w3.org/2000/svg" stroke="#ef4444"
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

                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline"> Eliminar Cliente
                    </h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500"> ¿Estas seguro de eliminar <span class="font-bold">Este
                                Cliente</span>? Esta acción no se puede deshacer. </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <form id="deleteForm" method="POST" action="{{ route('clientes.destroy') }}">
                @csrf
                @method('DELETE')
                <input type="text" id="cliente_id" name="cliente_id" hidden>
                <button type="submit" id="confirmDeleteButton"
                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-500 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Confirmar </button>
            </form>
            <button onclick="document.getElementById('deleteModal').close();"
                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                Cancel </button>
        </div>

        <!-- End of Modal Content-->
    </dialog>

    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
        crossorigin="anonymous"></script>
    <!-- Bootstrap 4 -->
    @if ($errors->any())
        <script>
            document.getElementById('myModal').showModal();
        </script>
    @endif
    <script>
        function mostrarModal(elemento) {
            document.getElementById('myModal').showModal();
        }

        function deletModalClient(clienteId) {
            document.getElementById('cliente_id').value = clienteId;
            document.getElementById('deleteModal').showModal();
        }

        function editModal(clienteId) {
            document.getElementById('editModal').showModal();

            fetch(`/clientes/${clienteId}`)
                .then(response => response.json())
                .then(cliente => {
                    // Rellenar el formulario con los datos del clienteo
                    document.getElementById('idE').value = cliente.id;
                    document.getElementById('numeroE').value = cliente.num_doc;
                    document.getElementById('rsE').value = cliente.nombres + ' ' + cliente.apellidos;
                    document.getElementById('nombre_comercialE').value = '';
                    document.getElementById('direccionE').value = cliente.direccion;
                    document.getElementById('telefonoE').value = cliente.telefono;
                    document.getElementById('nombresE').value = cliente.nombres;
                    document.getElementById('apellidosE').value = cliente.apellidos;
                    updateSelect('tipo_docE', cliente.tipo_doc);
                    // Rellenar otros campos según sea necesario
                })
                .catch(error => {
                    console.error('Error al cargar los datos del proveedor:', error);
                    alert('No se pudo cargar la información del proveedor');
                });
        }

        function updateSelect(selectId, valueToSelect) {
            const select = document.getElementById(selectId);
            if (select) {
                for (let i = 0; i < select.options.length; i++) {
                    if (select.options[i].value == valueToSelect) {
                        select.selectedIndex = i;
                        break;
                    }
                }
            }
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var editModal = document.getElementById('editModal');
            var editForm = document.getElementById('editForm');

            editForm.addEventListener('submit', function(e) {
                e.preventDefault();

                fetch(editForm.action, {
                        method: 'POST',
                        body: new FormData(editForm),
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Éxito: cerrar el modal y mostrar mensaje de éxito
                            editModal.close();

                            toastr.success(data.message, 'Bien hecho', {
                                progressBar: true,
                                positionClass: 'toast-top-center'
                            });
                            setTimeout(function() {
                                window.location.href = '/clientes';
                            }, 1000);
                            // Aquí puedes actualizar la tabla de proveedores si es necesario
                        } else {
                            // Error: mostrar errores en el formulario
                            Object.keys(data.errors).forEach(key => {
                                let errorElement = document.getElementById(key + 'Error');
                                if (errorElement) {
                                    errorElement.textContent = data.errors[key][0];
                                }
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });

            // Limpiar errores al cerrar el modal
            editModal.addEventListener('close', function() {
                document.querySelectorAll('.error-message').forEach(el => el.textContent = '');
            });
        });
    </script>
    <script>
        $('.search-to-sunat').click(function(e) {
            e.preventDefault();
            var num_doc = $('.numero').val();
            $.ajax({
                url: "/consulta-dni",
                method: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    dni: num_doc
                },
                success: function(data) {
                    if (data.tipoDocumento == 1) {
                        $('#rs').val(data.nombres + ' ' + data.apellidoPaterno + ' ' + data
                            .apellidoMaterno);
                        $('#apellidos').val(data.apellidoPaterno + ' ' + data
                            .apellidoMaterno);
                        $('#nombres').val(data.nombres);

                    } else if (data.tipoDocumento == 6) {
                        $('#rs').val(data.razonSocial);
                        //$('#nombre-comercial').val(data.condicion);
                    }

                },
                error: function() {
                    toastr.error('No hay resultados', 'Ups', {
                        progressBar: true,
                        positionClass: 'toast-top-center'
                    });
                }
            });
        });
        $('.search-to-sunatE').click(function(e) {
            e.preventDefault();
            var num_doc = $('.numerito').val();
            $.ajax({
                url: "/consulta-dni",
                method: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    dni: num_doc
                },
                success: function(data) {
                    if (data.tipoDocumento == 1) {
                        $('#rsE').val(data.nombres + ' ' + data.apellidoPaterno + ' ' + data
                            .apellidoMaterno);
                        $('#apellidosE').val(data.apellidoPaterno + ' ' + data
                            .apellidoMaterno);
                        $('#nombresE').val(data.nombres);

                    } else if (data.tipoDocumento == 6) {
                        $('#rsE').val(data.razonSocial);
                        //$('#nombre-comercial').val(data.condicion);
                    }

                },
                error: function() {
                    toastr.error('No hay resultados', 'Ups', {
                        progressBar: true,
                        positionClass: 'toast-top-center'
                    });
                }
            });
        });
    </script>
@endsection
