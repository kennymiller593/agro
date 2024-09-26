<table id="table-prod" class="min-w-max w-full table-auto tablita">
    <thead>
        <tr class="bg-green-200  uppercase text-sm ">
            <th class="text-left py-3 px-1 ">ID</th>
            <th class="text-left py-3 px-1 ">Cód. Interno</th>
            <th class="text-left py-3 px-1 ">Img</th>
            <th class="text-left py-3 px-1">Nombre</th>
            <th class="text-left py-3 px-1">Stock Actual</th>
            <th class="text-left py-3 px-1">U. Medida</th>


        </tr>
    </thead>
    <tbody>

        @foreach ($productos as $producto)
            <tr class="bg-white border-b  text-sm hover:bg-gray-200 cursor-pointer add-to-cart" data-id="{{ $producto->id }}">
                <td class="text-left  whitespace-nowrap">{{ $producto->id }}</td>
                <td class="text-left  whitespace-nowrap">
                    {{ $producto->codigo }}
                </td>
                <td class="text-left  whitespace-nowrap"><img src="{{ asset($producto->imagen) }}" width="40"
                        height="40">
                </td>
                <td class="text-left  w-44">
                    {{ $producto->nombre }}
                </td>
                <td class="text-left  whitespace-nowrap">
                    @if ($producto->stok <= 1)
                        <span class="rounded bg-red-300 px-4 py-2 text-xs font-bold"> {{ $producto->stok }}</span>
                    @else
                        <span class="rounded bg-green-300 px-4 py-2 text-xs font-bold"> {{ $producto->stok }}</span>
                    @endif

                </td>
                <td>{{ $producto->unimedida->simbolo_sunat }}</td>
            </tr>
        @endforeach

    </tbody>
</table>
