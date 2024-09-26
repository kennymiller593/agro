<table id="table-prod" class="min-w-max w-full table-auto tablita">
    <thead>
        <tr class="bg-green-200  uppercase text-sm ">
            <th class="text-left py-3 px-2 ">Movimiento</th>
            <th class="text-left py-3 px-2 ">Grupo</th>
            <th class="text-left py-3 px-2">Fecha</th>
            <th class="text-left py-3 px-2 ">Monto</th>
            <th class="text-left py-3 px-2">Descripción</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($ingresos as $ingreso)
            <tr class="bg-white border-b  text-sm hover:bg-green-100 cursor-pointer">
                <td class="text-left  whitespace-nowrap">Ingreso</td>
                <td class="text-left  whitespace-nowrap">
                    Ventas
                </td>
                <td class="text-left  whitespace-nowrap">
                    {{ $ingreso->fecha }}
                </td>

                <td class="text-left  whitespace-nowrap">
                    S/ {{ $ingreso->total }}
                </td>
                <td>{{ $ingreso->tipo_comprobante }}</td>
            </tr>
        @endforeach
        @foreach ($ingresos_ex as $ingreso_ex)
            <tr class="bg-white border-b  text-sm hover:bg-green-100 cursor-pointer">
                <td class="text-left  whitespace-nowrap">Ingreso</td>
                <td class="text-left  whitespace-nowrap">
                    Registro
                </td>
                <td class="text-left  whitespace-nowrap">
                    {{ $ingreso_ex->fecha }}
                </td>

                <td class="text-left  whitespace-nowrap">
                    S/ {{ $ingreso_ex->monto }}
                </td>
                <td>{{ $ingreso_ex->tipo_doc }}</td>
            </tr>
        @endforeach
        <tr>
            <th colspan="3">Suma</th>
            <td class="table-active"><strong>S/ {{ $ingresos->sum('total') + $ingresos_ex->sum('monto') }}</strong></td>
            <td></td>
        </tr>
        @foreach ($egresos as $egreso)
            <tr class="bg-red-200 border-b  text-sm hover:bg-red-300 cursor-pointer">
                <td class="text-left  whitespace-nowrap">Egreso</td>
                <td class="text-left  whitespace-nowrap">
                    Registro
                </td>
                <td class="text-left  whitespace-nowrap">
                    {{ $egreso->fecha }}
                </td>

                <td class="text-left  whitespace-nowrap">
                    S/- {{ $egreso->monto }}
                </td>
                <td>{{ $egreso->tipo_doc }}</td>
            </tr>
        @endforeach

        @foreach ($egresos_x_compra as $egreso_xc)
            <tr class="bg-red-200 border-b  text-sm hover:bg-red-300 cursor-pointer">
                <td class="text-left  whitespace-nowrap">Egreso</td>
                <td class="text-left  whitespace-nowrap">
                    Compra Prod.
                </td>
                <td class="text-left  whitespace-nowrap">
                    {{ $egreso_xc->fecha }}
                </td>

                <td class="text-left  whitespace-nowrap">
                    S/- {{ $egreso_xc->total }}
                </td>
                <td>Stok</td>
            </tr>
        @endforeach
        <tr>
            <th colspan="3">Suma</th>
            <td class="table-active"><strong>S/ -{{ $egresos->sum('monto') + $egresos_x_compra->sum('total') }}</strong></td>
            <td></td>
        </tr>
    </tbody>
</table>

<form action="" id="formulario-arqueo">
    <table class="w-24">
        <tbody>
            <tr class="bg-white  transition duration-300 ease-in-out hover:bg-green-100">
                <td class="px-6 py-2 whitespace-nowrap text-sm font-medium text-green-900"><strong>Ingreso: S/
                    </strong></td>
                <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                    <input type="number" placeholder="Ingreso" id="ingresos" name="ingresos"
                        class="mt-1 border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 block w-48 sm:text-sm border p-2 "
                        value="{{ $ingresos->sum('total') + $ingresos_ex->sum('monto') }}">
                    <span class="text-red-500 text-sm error-text" id="ingresos-error"></span>
                </td>
            </tr>
            <tr class="bg-white  transition duration-300 ease-in-out hover:bg-red-100">
                <td class="px-6 py-2 whitespace-nowrap text-sm font-medium text-red-900"><strong>Egreso: S/
                        -</strong></td>
                <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                    <input type="number" placeholder="Egreso" id="egresos" name="egresos"
                        class="mt-1 border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 block w-48 sm:text-sm border p-2 "
                        value="{{ $egresos->sum('monto') + $egresos_x_compra->sum('total') }}">
                    <span class="text-red-500 text-sm error-text" id="egresos-error"></span>
                </td>
            </tr>
            <tr class="bg-white  transition duration-300 ease-in-out hover:bg-gray-100">
                <td class="px-6 py-2 whitespace-nowrap text-sm font-medium text-green-900"> <strong>Saldo:
                        S/</strong></td>
                <td colspan="2" class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                    <input type="number" placeholder="Saldo"
                        value="{{ $ingresos->sum('total') + $ingresos_ex->sum('monto') - $egresos->sum('monto') - $egresos_x_compra->sum('total') }}"
                        id="saldo" name="saldo"
                        class="mt-1 border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 block w-48 sm:text-sm border p-2 ">
                    <span class="text-red-500 text-sm error-text" id="saldo-error"></span>
                </td>
            </tr>
            <tr class="bg-white  transition duration-300 ease-in-out ">
                <td class="px-6 py-2 whitespace-nowrap text-sm font-medium text-black">Obs:</td>
                <td><input type="text" id="obs" name="obs"
                        class="p-1 w-full border focus:outline-none  focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 mb-5 rounded-md uppercase">
                    <span class="text-red-500 text-sm error-text" placeholder="Observaciones">
                </td>
            </tr>
        </tbody>
    </table>
</form>
<div class="pt-2 pb-2 pl-20">

    @if ($cajas->count() > 0)

        @foreach ($cajas as $caja)
            @if (empty($caja->fecha_arqueo))
                <button  onclick="cerrarCaja()"
                    class=" bg-green-300 h-max w-max rounded-lg text-white font-bold hover:bg-green-500">
                    <div class="flex items-center justify-center m-[10px]" bis_skin_checked="1">
                        Cerrar caja
                    </div>
                </button>
            @else
                <div class="flex flex-row justify-between items-center">
                    Se cerró la caja con fecha
                    {{ \Carbon\Carbon::parse($caja->fecha_arqueo)->translatedFormat('d \d\e F Y \a \h\o\r\a\s H:i \p\m') }}
                </div>
            @endif
        @endforeach
    @else
        <div class="flex flex-row justify-between items-center">
            No hay caja abierto
        </div>
    @endif

</div>
