@if (count($productos))
    @foreach ($productos as $producto)
        <div
            class="shadow-md hover:shadow-lg transform transition-all duration-300 p-2 flex flex-col justify-between cursor-pointer border border-gray-300 hover:bg-emerald-50">
            <div class=" add-to-cart" data-id="{{ $producto->id }}">

                <img src="{{ $producto->imagen }}" alt="img" class="h-30 w-30">
                <h3 class="text-xs font-semibold uppercase text-gray-800">{{ $producto->nombre }}</h3>
                <div class="flex justify-between items-center mt-1">
                    <p class="text-gray-500 text-xs " data-stock="{{ $producto->stok }}"> {{ $producto->stok }}
                        {{ $producto->unimedida->simbolo_sunat }}
                    <div class=" text-xs font-bold text-blue-600 ">s/ {{ $producto->precio_venta }}</div>
                    </p>
                </div>
            </div>
            <div class="flex justify-between">

                <input type="text"
                    class="hidden oter-price w-16 h-8 text-center border-2 border-gray-300 mt-1 rounded-lg focus:outline-none focus:border-blue-600"
                    id="oter-price{{ $producto->id }}" value="{{ $producto->precio_venta }}"
                    name="oter-price{{ $producto->id }}">
                <div class="flex space-x-2 ">

                </div>
            </div>
            <div class="mt-2 flex space-x-1">
                <button class="action-button add-to-cart bg-blue-500 text-white w-full py-2 rounded hover:bg-blue-600"
                    data-id="{{ $producto->id }}">
                    Añadir
                </button>
               
                <div class="relative group">
                    <button onclick="openHistoryCompra({{ $producto->id }})"
                        class="historial-btn flex items-center justify-center w-12 py-2 bg-blue-500 text-white rounded-md shadow-lg hover:bg-blue-600">
                        <!-- Icono o contenido del botón -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99">
                        </path>
                    </svg>
                    </button>
                    <span
                        class="absolute bottom-full mb-2 left-1/2 transform -translate-x-1/2 px-2 py-1 text-xs font-semibold text-white bg-gray-800 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        Historial de compras
                    </span>
                </div>
            </div>


        </div>
    @endforeach
@else
    No hay coincidencia en la búsqueda
@endif
