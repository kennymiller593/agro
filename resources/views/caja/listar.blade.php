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




                <div class="content-caja pt-2" id="content-caja">
                    <table id="table-prod" class="min-w-max w-full table-auto tablita pt-2">
                        <thead>
                            <tr class="bg-green-200  uppercase text-sm ">
                                <th class="text-left py-3 px-2 ">Vendedor</th>
                                <th class="text-left py-3 px-2 ">Apertura</th>
                                <th class="text-left py-3 px-2">Cierre</th>
                                <th class="text-left py-3 px-2 ">Ingresos</th>
                                <th class="text-left py-3 px-2 ">Egresos</th>
                                <th class="text-left py-3 px-2">Saldo final</th>
                                <th class="text-left py-3 px-2">Estado</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($cajas as $caja)
                                <tr class="bg-white border-b  text-sm hover:bg-green-100 cursor-pointer pt-2">
                                    <td class="text-left  whitespace-nowrap">{{ Auth::user()->nombres }} {{ Auth::user()->apellidos }}</td>
                                    <td class="text-left  whitespace-nowrap">
                                        {{ $caja->fecha_apertura }}
                                    </td>
                                    <td class="text-left  whitespace-nowrap">
                                        {{ $caja->fecha_arqueo }}
                                    </td>

                                    
                                    <td class="text-left  whitespace-nowrap">
                                       s/ {{ $caja->total_ingresos }}
                                    </td>
                                    <td class="text-left  whitespace-nowrap">
                                       s/ {{ $caja->total_egresos }}
                                    </td>
                                    <td> s/ {{ $caja->saldo_final }}</td>
                                    <td>
                                        @if ($caja->estado == 'cerrado')
                                            <span class="rounded bg-red-400 py-1 px-3 text-xs font-bold">Cerrado</span>
                                        @else
                                            <span class="rounded bg-green-400 py-1 px-3 text-xs font-bold">Abierto</span>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <th colspan="5">Suma</th>
                                <th colspan="1">S/ {{ $cajas->sum('saldo_final') }}</th>
                                <th colspan="1"></th>
                            </tr>
                        </tbody>
                    </table>
                </div>



            </div>
        </div>
    </div>

    <!-- Modal de edición -->





    <script>
        function cerrarCaja(elemento) {
            document.getElementById('cerrarCaja').showModal();
        }
    </script>

    <script>
        function mostrarModal(elemento) {

            document.getElementById('myModal').showModal();
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
        crossorigin="anonymous"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
@endsection
