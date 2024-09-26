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

                <button type="button"
                    class=" bg-indigo-300 h-max w-max rounded-lg text-white font-bold hover:bg-indigo-500 " disabled>

                    <a href="#" onclick="mostrarModal(this)">
                        <div class="flex items-center justify-center m-[10px]">
                            Nuevo producto
                        </div>
                    </a>
                </button>

                <h1 class="font-bold py-4 uppercase">Lista de productos</h1>
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

                <div id="content-prod">
                    @include('producto.partial-prod', ['productos' => $productos])
                </div>
            </div>
        </div>
    </div>
    <dialog id="myModal" class="w-11/12 md:w-3/4 lg:w-4/5 xl:w-5/6 max-w-7xl p-4 sm:p-6 md:p-8 bg-white rounded-md">
        <div class="flex flex-col w-full  ">
            <!-- Header -->
            <div class="flex w-full h-7 justify-center items-center">
                <div class="flex w-10/12 h-7 py-1 justify-center items-center text-2xl font-bold" id="num_boleta">
                    <h2 class="text-2xl font-bold text-indigo-500 mb-6">Nuevo producto</h2>
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
                                class=" p-1 w-full border focus:outline-none focus:ring-indigo-500 focus:border-indigo-500  border-gray-300 mb-5 rounded-md uppercase"
                                placeholder="Semilla Alfalfa">
                            <span class="text-red-500 text-sm error-text" id="txtprod-error"></span>
                        </div>
                        <div class="">
                            <label for="phone" class="text-md text-gray-600">Descripción</label>
                            <input type="text" id="txtdesc" autocomplete="off" name="txtdesc"
                                class=" p-1 w-full border focus:outline-none  focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 mb-5 rounded-md uppercase">
                            <span class="text-red-500 text-sm error-text" id="txtdesc-error"></span>
                        </div>
                    </div>
                    <div class="grid gird-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                        <div>
                            <label for="id_cat" class="text-md text-gray-600">Categoría</label>
                            <select
                                class="bg-gray-50 border border-gray-300 focus:outline-none text-gray-900 text-sm rounded-lg
                                 focus:ring-indigo-500 focus:border-indigo-500 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
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
                                focus:ring-indigo-500 focus:border-indigo-500 block w-full p-1.5 dark:bg-gray-700
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
                                class="p-1 w-full border border-gray-300 mb-5 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <span class="text-red-500 text-sm error-text" id="txtstock-error"></span>
                        </div>
                        <div class="">
                            <label for="id_number" class="text-md text-gray-600">Unidad de medida</label>
                            <select
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500
                                 block w-full p-1.5 dark:bg-gray-700 focus:outline-none dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                                  "
                                id="txtid_med" name="txtid_med">
                                @foreach ($medidas as $medida)
                                    <option value="{{ $medida->id }}">{{ $medida->nombre }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div>
                            <label for="id_number" class="text-md text-gray-600">Precio compra</label>
                            <input type="text" id="txtprecio_co" autocomplete="off" name="txtprecio_co"
                                class="p-1 w-full border border-gray-300 mb-5 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <span class="text-red-500 text-sm error-text" id="txtprecio_co-error"></span>
                        </div>
                        <div class="">
                            <label for="id_number" class="text-md text-gray-600">Precio venta</label>
                            <input type="text" id="txtprecio_uv" autocomplete="off" name="txtprecio_uv"
                                class="p-1 w-full border border-gray-300 mb-5 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
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
                                class="hidden w-20 h-20 object-cover rounded-lg">
                        </div>
                    </div>
                    <div class=' flex justify-center pt-4'>
                        <button type="button" id="addProd"
                            class="addProd bg-green-300 h-max w-max rounded-lg text-white font-bold hover:bg-green-500 ">
                            <div class="flex items-center justify-center m-[10px]">

                                <div class="ml-2"> Agregar producto<div>
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
    <!-- Modal de edición -->
    <dialog id="editModal" class="w-11/12 md:w-3/4 lg:w-4/5 xl:w-5/6 max-w-7xl p-4 sm:p-6 md:p-8 bg-white rounded-md">
        <div class="flex flex-col w-full">
            <!-- Header -->
            <div class="flex w-full h-10 justify-center items-center">
                <div class="flex w-10/12 h-auto py-3 justify-center items-center text-2xl font-bold" id="num_boleta">
                    Editar Producto
                </div>

                <!--Header End-->
            </div>
            <!-- Modal Content-->
            <div class="my-5 flex justify-center">
                <form enctype="multipart/form-data" id="formularioEditProd" class="w-full">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div>
                            <label for="names" class="text-md text-gray-600">Producto</label>
                            <input type="text" name="prod_idE" id="prod_idE" hidden>
                            <input type="text" id="txtprodE" autocomplete="off" name="txtprodE"
                                class="p-1 w-full border focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 mb-5 rounded-md uppercase"
                                placeholder="Semilla Alfalfa">
                            <span class="text-red-500 text-sm error-text" id="txtprodE-error"></span>
                        </div>
                        <div>
                            <label for="phone" class="text-md text-gray-600">Descripción</label>
                            <input type="text" id="txtdescE" autocomplete="off" name="txtdescE"
                                class="p-1 w-full border focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 mb-5 rounded-md uppercase">
                            <span class="text-red-500 text-sm error-text"></span>
                        </div>
                        <div>
                            <label for="id_cat" class="text-md text-gray-600">Categoría</label>
                            <select
                                class="bg-gray-50 border border-gray-300 focus:outline-none text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                id="txtidE_cat" name="txtidE_cat">
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="id_prov" class="text-md text-gray-600">Proveedor</label>
                            <select
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none"
                                id="txtidE_prov" name="txtidE_prov">
                                @foreach ($proveedores as $proveedor)
                                    <option value="{{ $proveedor->id }}">{{ $proveedor->razon_social }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 pt-0">
                        <div>
                            <label for="id_number" class="text-md text-gray-600">Stock Inicial</label>
                            <input type="text" id="txtstockE" autocomplete="off" name="txtstockE"
                                class="p-1 w-full border border-gray-300 mb-5 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <span class="text-red-500 text-sm error-text" id="txtstockE-error"></span>
                        </div>
                        <div>
                            <label for="id_number" class="text-md text-gray-600">Unidad de medida</label>
                            <select
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-1.5 dark:bg-gray-700 focus:outline-none dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                id="txtidE_med" name="txtidE_med">
                                @foreach ($medidas as $medida)
                                    <option value="{{ $medida->id }}">{{ $medida->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="id_number" class="text-md text-gray-600">Precio compra</label>
                            <input type="text" id="txtprecio_coE" autocomplete="off" name="txtprecio_coE"
                                class="p-1 w-full border border-gray-300 mb-5 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <span class="text-red-500 text-sm error-text" id="txtprecio_coE-error"></span>
                        </div>
                        <div>
                            <label for="id_number" class="text-md text-gray-600">Precio venta</label>
                            <input type="text" id="txtprecio_uvE" autocomplete="off" name="txtprecio_uvE"
                                class="p-1 w-full border border-gray-300 mb-5 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <span class="text-red-500 text-sm error-text" id="txtprecio_uvE-error"></span>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700">Seleccionar
                                Imagen</label>
                            <input type="file" name="imageE" id="imageE" accept="image/*"
                                class="mt-2 p-1 border border-gray-300 rounded-lg w-full">
                        </div>
                        <div>
                            <img id="previewE" src="#" alt="Vista Previa"
                                class="hidden h-20 object-cover rounded-lg">
                        </div>
                    </div>
                    <div class="flex justify-center pt-4">


                        <button type="button" id="editProd"
                            class="bg-green-300 py-2 px-4 rounded-lg text-white font-bold hover:bg-green-500 mx-2">
                            Editar producto
                        </button>
                        <button type="button" onclick="document.getElementById('editModal').close();"
                            class="bg-red-300 py-2 px-4 rounded-lg text-white font-bold hover:bg-red-500 mx-2">
                            Cancelar
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </dialog>



    <!-- Modal de edición -->
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
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline"> Eliminar Producto
                    </h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500"> ¿Estas seguro de eliminar <span class="font-bold">Este
                                producto</span>? Esta acción no se puede deshacer. </p>
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

    <dialog id="historialVentasModal" class="items-center justify-center  bg-white rounded-lg text-left  " role="dialog"
        aria-modal="true" aria-labelledby="modal-headline">
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="flex w-full h-10 justify-center items-center">
                <div class="flex w-10/12 h-auto py-3 justify-center items-center text-2xl font-bold" id="num_boleta">
                    Historial de ventas
                </div>
                <!--Header End-->
            </div>
            <!-- Modal content -->
            <div class="sm:flex sm:items-start">
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <div id="historialVentaContent" class="mt-2 px-7 py-3">
                        <!-- El contenido del historial se cargará aquí -->
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <button onclick="document.getElementById('historialVentasModal').close();"
                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                Cerrar </button>
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

        function openHistoryVenta(id) {
            document.getElementById('historialVentasModal').showModal();


            fetch(`/historial-venta/${id}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text();
                })
                .then(html => {
                    document.getElementById('historialVentaContent').innerHTML = html;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>
    <script>
        function deletModalProd(productId) {

            console.log(productId);

            document.getElementById('deleteModal').showModal();
            const confirmButton = document.getElementById('confirmDeleteButton');
            confirmButton.onclick = function() {
                deleteProduct(productId);
            };
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.style.display = 'none';
        }

        function deleteProduct(productId) {
            fetch(`/delete/products/${productId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.text())
                .then(data => {
                    document.getElementById('content-prod').innerHTML = data;
                    toastr.success('La eliminación se realizó exitosamente', 'Bien hecho', {
                        progressBar: true,
                        positionClass: 'toast-top-center'
                    });
                    document.getElementById('deleteModal').close()
                })
                .catch(
                    error => console.error('Error:', error)
                )

        }
    </script>
    <script>
        document.getElementById('editProd').addEventListener('click', function() {
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            var formData = new FormData(document.getElementById('formularioEditProd'));
            var productId = document.getElementById('prod_idE').value;

            fetch(`/api/products/${productId}`, {
                    method: 'POST', // Usando PUT para actualizar
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
                    document.getElementById('content-prod').innerHTML = html;
                    toastr.success('La operación se realizó exitosamente', 'Bien hecho', {
                        progressBar: true,
                        positionClass: 'toast-top-center'
                    });
                    document.getElementById('editModal').close()
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
        function mostrarModalEdit(product_id) {

            document.getElementById('editModal').showModal();

            fetch(`/productos/${product_id}`)
                .then(response => response.json())
                .then(product => {
                    // Rellenar el formulario con los datos del producto
                    document.getElementById('prod_idE').value = product.id;
                    document.getElementById('txtprodE').value = product.nombre;
                    document.getElementById('txtdescE').value = product.descripcion;
                    document.getElementById('txtprecio_coE').value = product.precio_compra;
                    document.getElementById('txtprecio_uvE').value = product.precio_venta;
                    document.getElementById('txtstockE').value = product.stok;
                    // Rellenar otros campos según sea necesario

                    updateSelect('txtidE_cat', product.categoria_id);
                    updateSelect('txtidE_prov', product.proveedor_id);
                    updateSelect('txtidE_med', product.medida_id);
                    if (product.imagen) {
                        //document.getElementById('imageE').src = product.imagen;
                        const imageElement = document.getElementById('previewE');
                        imageElement.src = product.imagen;
                        imageElement.style.display = 'block';
                    }
                })
                .catch(error => {
                    console.error('Error al cargar los datos del producto:', error);
                    alert('No se pudo cargar la información del producto');
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
        $(document).ready(function() {

            $('#search-prod').on('keyup', function() {
                var query = $(this).val();
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                $.ajax({
                    url: "/search-prod",
                    type: "GET",
                    data: {
                        'query': query
                    },
                    success: function(data) {
                        $('#content-prod').html(data);
                    }
                });
            });
        });
    </script>
    <script>
        document.getElementById('addProd').addEventListener('click', function() {
            // Obtener los datos del formulario
            $(this).prop('disabled', true);
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            var formData = new FormData(document.getElementById('formularioProd'));
            formData.append('_token', csrfToken);

            // Limpiar errores anteriores
            document.querySelectorAll('.error-text').forEach(el => el.textContent = '');

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
                                throw {
                                    status: 422,
                                    data: data
                                };
                            });
                        } else if (response.status === 500) {
                            return response.json().then(data => {
                                throw {
                                    status: 500,
                                    message: data.error
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
                    document.getElementById('content-prod').innerHTML = html;
                    document.getElementById('myModal').close();
                    toastr.success('La operación se realizó exitosamente', 'Bien hecho', {
                        progressBar: true,
                        positionClass: 'toast-top-center'
                    });
                    $('#formularioProd')[0].reset();
                    $('.addProd').prop('disabled', false);
                })
                .catch(error => {
                    if (error.status === 422) {
                        // Mostrar errores de validación
                        Object.keys(error.data.errors).forEach(key => {
                            const errorElement = document.getElementById(`${key}-error`);
                            if (errorElement) {
                                errorElement.textContent = error.data.errors[key][0];
                                errorElement.style.display = 'block'; // Mostrar el elemento de error
                            }
                        });
                        $('.addProd').prop('disabled', false);
                    } else if (error.status === 500) {
                        // Mostrar error de excepción
                        toastr.error(error.message, 'Error', {
                            progressBar: true,
                            positionClass: 'toast-top-center'
                        });
                        $('.addProd').prop('disabled', false);
                    } else {
                        toastr.error('Error al procesar la solicitud', 'Error', {
                            progressBar: true,
                            positionClass: 'toast-top-center'
                        });
                        $('.addProd').prop('disabled', false);
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

        document.getElementById('imageE').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('previewE');

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
    {{-- <script>
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
                    url: "{{ route('verProducto') }}",
                },
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'codigo'
                    },

                    {
                        data: 'imagen', // Nombre del campo que contiene la ruta de la imagen en tu base de datos
                        render: function(data, type, row) {
                            return '<img src="' + data +
                                '" alt="Imagen del producto" style="width: 40px; height: 40px;"/>';
                        }
                    },
                    {
                        data: 'nombre'
                    },
                    {

                        data: null, // Usamos 'null' ya que no estamos usando un campo específico
                        render: function(data, type, row) {
                            if (row.stok <= 1) {
                                return `<span class="rounded bg-red-400 py-1 px-3 text-xs font-bold">${row.stok}</span>`;
                            } else {
                                return `<span class="rounded bg-green-400 py-1 px-3 text-xs font-bold">${row.stok}</span>`;
                            }

                        },
                        name: 'stok',

                    },
                    {
                        data: 'unimedida.nombre'
                    },
                    {
                        data: null, // Usamos 'null' ya que no estamos usando un campo específico
                        render: function(data, type, row) {
                            return `S/ ${row.precio_compra} `;
                        },
                        data: 'precio_compra'
                    },
                    {
                        data: null, // Usamos 'null' ya que no estamos usando un campo específico
                        render: function(data, type, row) {
                            return `S/ ${row.precio_venta} `;
                        },
                        data: 'precio_venta'
                    },
                    {
                        data: 'id'
                    }
                ],
                columnDefs: [{
                    // Definir botones de editar y eliminar en la última columna
                    targets: -1,
                    render: function(data, type, row) {
                        return `<div class="inline-flex items-center space-x-3" onclick="openEditModal(${row.id})" 
                        id="btn" data-desc=""><a class="text-green-500 cursor-pointer" title="Generar Factura"> 
                             <i class="fas fa-edit"></i>Ed</a></div>`;
                    }
                }],
                order: [
                    [3, 'asc'] // Ordenar por la primera columna (ID) de forma ascendente
                ],
                createdRow: function(row, data, dataIndex) {
                    $(row).addClass('custom-row-spacing');
                }
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        });
    </script> --}}
    <script>
        function mostrarModal(elemento) {
            document.getElementById('myModal').showModal();
        }
    </script>
@endsection
