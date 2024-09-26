<img src="https://upload.wikimedia.org/wikipedia/commons/d/d5/Tailwind_CSS_Logo.svg" alt="chippz"
    class="mx-auto w-16 py-4" />


<div class="flex flex-col gap-3 pb-6 pt-2 text-xs">
    <table class="w-full text-left">
        <thead>
            <tr class="flex">
                <th class="w-full py-2">Producto</th>
                <th class="min-w-[44px] py-2 px-9">Cantidad</th>
                <th class="min-w-[44px] py-2 ">Precio U.</th>
                <th class="min-w-[44px] py-2">Total</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total = 0;
            @endphp
            @foreach ($historial as $hist)
                @php
                    $total += $hist->cantidad * $hist->precio_compra;
                @endphp
                <tr class="flex">
                    <td class="flex-1 ">{{ $hist->producto->nombre }}
                    </td>
                    <td class="min-w-[44px]"> {{ $hist->cantidad }}</td>
                    <td class="min-w-[44px]"> {{ $hist->precio_compra }}</td>
                    <td class="min-w-[44px]">s/{{ $hist->precio_compra * $hist->cantidad }} </td>
                </tr>
            @endforeach

        </tbody>
    </table>
    <div class=" border-b border border-dashed"></div>
    <table>
        <tr class="flex">
            <td colspan="3" class="flex-1 text-lg font-bold">Total</td>
            <td colspan="1"class="font-bold">s/{{ $total }}</td>
        </tr>
    </table>
    
</div>
