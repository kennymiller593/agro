<table class="min-w-full border-collapse border border-gray-200">
    <thead>
        <tr class="bg-blue-400 text-white">
            <th class="px-4 py-2  ">#</th>
            <th class="px-4 py-2 ">Fecha</th>
            <th class="px-4 py-2 ">Documento</th>
            <th class="px-4 py-2 ">Proveedor</th>
            <th class="px-4 py-2 ">Stock restante</th>
            <th class="px-4 py-2 ">Cantidad</th>
            <th class="px-4 py-2 ">Precio compra</th>
            <th class="px-4 py-2 ">Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($historial as $hist)
            <tr>
                <td class="px-4 py-2 border border-gray-200 text-center">{{ $hist->id }}</td>
                <td class="px-4 py-2 border border-gray-200 text-center">
                    {{ \Carbon\Carbon::parse($hist->compra->fecha)->isoFormat('D [de] MMMM, YYYY') }}</td>
                <td class="px-4 py-2 border border-gray-200 text-center">Boleta</td>
                <td class="px-4 py-2 border border-gray-200 text-center">
                    {{ $hist->compra->proveedor->razon_social ?? '' }}
                </td>
                <td class="px-4 py-2 border border-gray-200 text-center">{{ $hist->cantidad_restante }}
                </td>
                <td class="px-4 py-2 border border-gray-200 text-center">{{ $hist->cantidad }}</td>
                <td class="px-4 py-2 border border-gray-200 text-center">s/ {{ $hist->precio_compra }}</td>
                <td class="px-4 py-2 border border-gray-200 text-center">s/ {{ $hist->precio_compra * $hist->cantidad }}
                </td>
            </tr>
        @endforeach
        <!-- Puedes agregar más filas aquí -->
    </tbody>
</table>
