<table id="table-prod" class="min-w-max w-full table-auto tablita table">
    <thead>
        <tr class="bg-green-200  uppercase text-sm ">
            <th class="text-left py-3 px-2 ">ID</th>
            <th class="text-left py-3 px-2 ">Img</th>
            <th class="text-left py-3 px-2">Nombre</th>
            <th class="text-left py-3 px-2 ">Historial</th>
            <th class="text-left py-3 px-2">Stock</th>
            <th class="text-left py-3 px-2">U. Medida</th>
            <th class="text-left py-3 px-2">P. Venta </th>
            <th class="text-left py-3 px-2 ">Acciones</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($productos as $producto)
            <tr class="bg-white border-b  text-sm hover:bg-gray-200 cursor-pointer">
                <td class="text-left  whitespace-nowrap">{{ $producto->id }}</td>

                <td class="text-left  whitespace-nowrap w-24"><img src="{{ asset($producto->imagen) }}" width="40"
                        height="40">
                </td>
                <td class="text-left w-80">
                    {{ $producto->nombre }}
                </td>
                <td class="text-left  whitespace-nowrap flex">
                    <!-- resources/views/components/button.blade.php -->
                    @if ($producto->detalleCompras->count() > 0)
                        <button onclick="openHistoryCompra({{ $producto->id }})"
                            class="historial-btn flex items-center justify-center w-8 h-8 bg-blue-300 text-white rounded-md shadow-lg hover:bg-blue-400"
                            data-product-id="{{ $producto->id }}">
                            <!-- Ícono de Retroceso -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                            </svg>
                        </button>
                    @endif
                    @if ($producto->detalleVentas->count() > 0)
                        <button onclick="openHistoryVenta({{ $producto->id }})"
                            class="historial-btn flex items-center justify-center w-8 h-8 bg-green-300 text-white rounded-md shadow-lg hover:bg-green-400"
                            data-product-id="{{ $producto->id }}">
                            <!-- Ícono de Retroceso -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                            </svg>
                        </button>
                    @endif
                </td>
                <td class="text-left  whitespace-nowrap">
                    @if ($producto->stok <= 1)
                        <span class="rounded bg-red-300 px-4 py-2 text-xs font-bold"> {{ $producto->stok }}</span>
                    @else
                        <span class="rounded bg-green-300 px-4 py-2 text-xs font-bold"> {{ $producto->stok }}</span>
                    @endif

                </td>
                <td>{{ $producto->unimedida->nombre }}</td>
                <td>{{ $producto->precio_venta }}</td>

                <td class=" text-center">
                    <div class="flex item-center justify-center">

                        <div onclick="mostrarModalEdit({{ $producto->id }})"
                            class="w-4 mr-2 transform text-yellow-500 hover:scale-110 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                        </div>
                        <div onclick="deletModalProd({{ $producto->id }})"
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

    </tbody>
</table>
