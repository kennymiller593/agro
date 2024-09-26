<table class="min-w-full border-collapse border border-gray-200">
    <thead>
        <tr class="bg-green-400 text-white">
            <th class="px-4 py-2  ">#</th>
            <th class="px-4 py-2 ">Fecha</th>
            <th class="px-4 py-2 ">Documento</th>
            <th class="px-4 py-2 ">Cliente</th>
            <th class="px-4 py-2 ">Cantidad</th>
            <th class="px-4 py-2 ">Precio</th>
            <th class="px-4 py-2 ">Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($historial as $hist)
            <tr>
                <td class="px-4 py-2 border border-gray-200 text-center">{{ $hist->id }}</td>
                <td class="px-4 py-2 border border-gray-200 text-center">
                    {{ \Carbon\Carbon::parse($hist->venta->fecha)->isoFormat('D [de] MMMM, YYYY') }}</td>
                <td class="px-4 py-2 border border-gray-200 text-center">
                    {{ $hist->venta->tipo_comprobante . '-' . $hist->venta->id }}</td>
                <td class="px-4 py-2 border border-gray-200 text-center">{{ $hist->venta->cliente->nombres.' '. $hist->venta->cliente->apellidos }}
                </td>
                <td class="px-4 py-2 border border-gray-200 text-center">{{ $hist->cantidad }}</td>
                <td class="px-4 py-2 border border-gray-200 text-center">s/ {{ $hist->precio }}</td>
                <td class="px-4 py-2 border border-gray-200 text-center">s/ {{ $hist->precio * $hist->cantidad }}
                </td>
            </tr>
        @endforeach
        <!-- Puedes agregar más filas aquí -->
    </tbody>
</table>
