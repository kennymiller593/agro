@extends('admin-layout')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



    <!-- navbar -->

    <!-- end navbar -->

    <!-- Content -->

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
            <a href="{{ route('verComprobante', ['date' => date('Y-m-d')]) }}"
                class="text-emerald-500 font-medium text-sm hover:text-emerald-800">
                <div class="flex justify-between mb-6">
                    <div>
                        <div class="text-sm font-medium text-gray-400">Ventas hoy</div>
                        <div class="flex items-center mb-1">
                            <div class="text-2xl font-semibold">s/{{ $ingresosHoy->sum('total') }}</div>
                        </div>
                        <div class="p-1 rounded bg-purple-500/10 text-purple-500 text-[12px] font-semibold leading-none ml-2">
                            s/{{ $ingresosHoy->sum('ganancia_total') }} de  Ganancia
                            </div>
                    </div>
                   
                </div>
               
            </a>
        </div>
        <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
            <a href=" {{ route('verComprobante', ['month' => date('Y-m')]) }}"
                class="text-emerald-500 font-medium text-sm hover:text-emerald-800">
                <div class="flex justify-between mb-4">
                    <div>
                        <div class="text-sm font-medium text-gray-400">Ventas
                            {{ $nombreMesActual }}</div>
                        <div class="flex items-center mb-1">
                            <div class="text-2xl font-semibold">s/{{ $ingresosmesActual->sum('total') }}</div>
                        </div>
                        <div class="p-1 rounded bg-purple-500/10 text-purple-500 text-[12px] font-semibold leading-none ml-2">
                            s/{{ $ingresosmesActual->sum('ganancia_total') }} de  Ganancia
                            </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
            <a href="{{ route('verProducto') }}" class="text-emerald-500 font-medium text-sm hover:text-emerald-800">
                <div class="flex justify-between mb-6">
                    <div>
                        <div class="text-2xl font-semibold mb-1">+{{ count($productos) }}</div>
                        <div class="text-sm font-medium text-gray-400"> Productos</div>
                    </div>

                </div>
            </a>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <div
            class="p-6 relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50 dark:bg-gray-800 w-full shadow-lg rounded">
            <div class="rounded-t mb-0 px-0 border-0">
                <canvas id="graficoPagoSemana"></canvas>
            </div>


        </div>
        <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
            <div class="flex justify-between mb-4 items-start">
                <canvas id="graficoPagoAnual"></canvas>
            </div>

        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md lg:col-span-2">
            <div class="flex justify-between mb-4 items-start">
                <div class="font-medium option-filter" id="option-filter">Últimos 7 días</div>
                <div class="dropdown">
                    <button type="button" class="dropdown-toggle text-gray-400 hover:text-gray-600">
                        <i class="ri-more-fill"></i>
                    </button>
                    <ul
                        class="dropdown-menu shadow-md shadow-black/5 z-30 hidden py-1.5 rounded-md bg-white border border-gray-100 w-full max-w-[140px]">
                        <li>
                            <a href="#" data-option="semanal"
                                class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">Semanal</a>
                        </li>
                        <li>
                            <a href="#" data-option="mensual"
                                class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">Mensual</a>
                        </li>
                        <li>
                            <a href="#" data-option="anual"
                                class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">Anual</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="semanal">
                @include('dashboard.ventas-vs-compras')
            </div>
            <div id="mensual" style="display: none;">
                @include('dashboard.ventas-vs-compras-30')
            </div>
            <div id="anual" style="display: none;">
                @include('dashboard.ventas-vs-compras-mensual')
            </div>

        </div>
        <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
            <div class="flex justify-between mb-4 items-start">
                <div class="font-medium">Top de productos</div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full min-w-[460px]">
                    <thead>
                        <tr>
                            <th
                                class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tl-md rounded-bl-md">
                                Producto</th>
                            <th
                                class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left">
                                Cantidad</th>
                            <th
                                class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tr-md rounded-br-md">
                                Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productosVendidos as $vendido)
                            <tr>
                                <td class="py-2 px-4 border-b border-b-gray-50">
                                    <div class="flex items-center">
                                        <img src="https://placehold.co/32x32" alt=""
                                            class="w-8 h-8 rounded object-cover block">
                                        <a href="#"
                                            class="text-gray-600 text-sm font-medium hover:text-green-500 ml-2 whitespace-normal">
                                            {{ $vendido->nombre }}</a>
                                    </div>
                                </td>
                                <td class="py-2 px-4 border-b border-b-gray-50">
                                    <span class="text-[13px] font-medium text-emerald-500">+{{ $vendido->total_cantidad }}
                                        {{ $vendido->simbolo_sunat }}</span>
                                </td>
                                <td class="py-2 px-4 border-b border-b-gray-50">
                                    <span
                                        class="inline-block p-1 rounded bg-emerald-500/10 text-emerald-500 font-medium text-[12px] leading-none">
                                        s/ {{ number_format($vendido->total_monto, 2) }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="flex justify-between mb-4 items-start">
                <div class="font-medium">Top de Clientes</div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full min-w-[460px]">
                    <thead>
                        <tr>
                            <th
                                class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tl-md rounded-bl-md">
                                Cliente</th>
                            <th
                                class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left">
                                # Trans.</th>
                            <th
                                class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tr-md rounded-br-md">
                                Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($topClientes as $cliente)
                            <tr>
                                <td class="py-2 px-4 border-b border-b-gray-50">
                                    <div class="flex items-center">
                                        <img src="https://placehold.co/32x32" alt=""
                                            class="w-8 h-8 rounded object-cover block">
                                        <a href="#"
                                            class="text-gray-600 text-sm font-medium hover:text-blue-500 ml-2 whitespace-normal">
                                            {{ $cliente->nombres }} {{ $cliente->apellidos }}</a>
                                    </div>
                                </td>
                                <td class="py-2 px-4 border-b border-b-gray-50">
                                    <span class="text-[13px] font-medium text-blue-500">+ {{ $cliente->total_compras }}
                                    </span>
                                </td>
                                <td class="py-2 px-4 border-b border-b-gray-50">
                                    <span
                                        class="inline-block p-1 rounded bg-blue-500/10 text-blue-500 font-medium text-[12px] leading-none">
                                        s/ {{ number_format($cliente->monto_total, 2) }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- End Content -->






    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const links = document.querySelectorAll('.dropdown-menu a');
            const secciones = {
                'semanal': document.getElementById('semanal'),
                'mensual': document.getElementById('mensual'),
                'anual': document.getElementById('anual')
            };

            links.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();

                    const option = this.getAttribute('data-option');

                    if (option === 'semanal') {
                        document.getElementById('option-filter').textContent = 'Últimos 7 días';
                    } else if (option === 'mensual') {
                        document.getElementById('option-filter').textContent = 'Últimos 30 días';
                    } else if (option === 'anual') {
                        document.getElementById('option-filter').textContent = 'Últimos 12 meses';
                    }

                    // Ocultar todas las secciones
                    Object.values(secciones).forEach(section => section.style.display = 'none');

                    // Mostrar la sección seleccionada
                    secciones[option].style.display = 'block';
                });
            });
        });
    </script>
    <script>
        var ctx = document.getElementById('balanceChart1').getContext('2d');
        var balanceChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Totales', 'Total pagos'],
                datasets: [{
                    data: [{{ $comprasamesActual->sum('total') }},
                        {{ $ingresosmesActual->sum('total') }}
                    ],
                    backgroundColor: ['#36A2EB', '#FF6384'],
                    hoverBackgroundColor: ['#36A2EB', '#FF6384']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': S/ ' + tooltipItem.raw;
                            }
                        }
                    }
                }
            }
        });
    </script>
    <script>
        var ctx = document.getElementById('balanceChart').getContext('2d');
        var balanceChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Totales', 'Total pagos'],
                datasets: [{
                    data: [{{ $ingresosmesActual->sum('total') }},
                        {{ $comprasamesActual->sum('total') }}
                    ],
                    backgroundColor: ['#36A2EB', '#FF6384'],
                    hoverBackgroundColor: ['#36A2EB', '#FF6384']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': S/ ' + tooltipItem.raw;
                            }
                        }
                    }
                }
            }
        });
    </script>
    @php
        use Carbon\Carbon;
        // Convertir los números de mes a nombres de mes en español usando Carbon
        $labels = $pagosUltimosDoceMeses->pluck('month')->map(function ($month) {
            // Creamos una fecha ficticia del primer día del mes usando el número de mes
            return Carbon::createFromFormat('m', $month)->locale('es')->isoFormat('MMMM');
        });
        $data = $pagosUltimosDoceMeses->pluck('total');
    @endphp

    <script>
        var ctx = document.getElementById('graficoPagoAnual').getContext('2d');

        // Pasar los nombres de los meses en español a JavaScript
        var labels = {!! json_encode($labels) !!};
        var data = {!! json_encode($data) !!};

        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels, // Aquí los nombres de los meses en letras
                datasets: [{
                    label: 'Pagos últimos 12 meses',
                    data: data,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <script>
        var ctx = document.getElementById('graficoPagoSemana').getContext('2d');

        // Formatear las fechas en el servidor antes de pasarlas a JavaScript
        var labels = {!! json_encode(
            $pagosUltimasemana->pluck('fecha')->map(function ($fecha) {
                return \Carbon\Carbon::parse($fecha)->translatedFormat('d \d\e M Y');
            }),
        ) !!};

        var data = {!! json_encode($pagosUltimasemana->pluck('total')) !!};

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Ventas últimos 7 días',
                    data: data,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
