@extends('admin-layout')
@section('content')
    <!-- CSS de DataTables -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div id="content" class="bg-white/10 col-span-9 rounded-lg p-6">
        <div id="24h">

            <div id="stats" class="grid gird-cols-1 md:grid-cols-2 xl:grid-cols-3 lg:grid-cols-4 gap-6">


                <div class="bg-white p-4 rounded-lg shadow-lg w-full max-w-md">
                    Balance
                    <div>
                        <canvas id="balanceChart"></canvas>
                    </div>
                    <div class=" text-lg sm:text-base">
                        <div class="flex items-left justify-between  ">
                            <span class=" w-4 h-4 bg-blue-500 rounded-full mr-2"></span>
                            <span>Totales</span>
                            <span class="ml-2 text-blue-500 font-bold">S/ {{ $ingresosmesActual->sum('total') }}</span>
                        </div>
                        <div class="flex items-left justify-between ">
                            <span class=" w-4 h-4 bg-red-500 rounded-full mr-2"></span>
                            <span>Total pagos</span>
                            <span class="ml-2 text-red-500 font-bold">S/ 116.00</span>
                        </div>
                    </div>
                </div>
                <div class="bg-white  border border-gray-100  shadow-md shadow-black/5 p-6 rounded-lg sm:text-base">
                    <div class="flex flex-row space-x-4 items-center border border-gray-100   p-6">
                        <div id="stats-1 sm:hidden xl-hidden lg-hidden xs:hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-10 h-10 text-gray-600">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>

                        </div>
                        <div>
                            <a href="{{ route('verComprobante', ['date' => date('Y-m-d')]) }}">
                                <p class="text-teal-300 text-sm font-medium uppercase leading-4">Ventas hoy</p>
                                <p class="text-gray-600 font-bold xs:text-1xl inline-flex items-center space-x-2">
                                    <span>s/{{ $ingresosHoy->sum('total') }}</span>

                                </p>
                            </a>
                        </div>
                    </div>
                    <div class="flex flex-row space-x-4 items-center border border-gray-100   p-6">
                        <div id="stats-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-10 h-10 text-gray-600">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>

                        </div>
                        <div>
                            <a href="{{ route('verComprobante', ['month' => date('Y-m')]) }}">
                                <p class="text-teal-300 text-sm font-medium uppercase leading-4 xs:text-1xl">Ventas
                                    {{ $nombreMesActual }}
                                </p>
                                <p class="text-gray-600 font-bold xs:text-1xl inline-flex items-center space-x-2">
                                    <span>s/{{ $ingresosmesActual->sum('total') }}</span>
                                </p>
                            </a>
                        </div>
                    </div>

                    <div class="flex flex-row space-x-4 items-center border border-gray-100   p-6">
                        <div id="stats-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-10 h-10 text-gray-600">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-indigo-300 text-sm font-bold uppercase leading-4 xs:text-1xl">Total Clientes </p>
                            <p class="text-gray-600 font-bold  inline-flex items-center space-x-2 xs:text-1xl">
                                <span>+{{ count($clientes) }}</span>

                            </p>
                        </div>
                    </div>
                    <div class="flex flex-row space-x-4 items-center border border-gray-100   p-6">
                        <div id="stats-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-10 h-10 text-gray-600">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-indigo-300 text-sm font-bold uppercase leading-4 xs:text-1xl">Productos </p>
                            <p class="text-gray-600 font-bold inline-flex items-center space-x-2 xs:text-1xl">
                                <span>+{{ count($productos) }}</span>

                            </p>
                        </div>
                    </div>
                </div>
                <div class="bg-white  border border-gray-100 p-6 shadow-md shadow-black/5  rounded-lg">

                    Utilidades/Ganancias
                    <div>
                        <canvas id="balanceChart1"></canvas>
                    </div>
                    <div class=" text-lg">
                        <div class="flex items-left justify-between ">
                            <span class=" w-4 h-4 bg-blue-500 rounded-full mr-2"></span>
                            <span>Ingreso</span>
                            <span class="ml-2 text-blue-500 font-bold">S/ {{ $ingresosmesActual->sum('total') }}</span>
                        </div>
                        <div class="flex items-left justify-between ">
                            <span class=" w-4 h-4 bg-red-500 rounded-full mr-2"></span>
                            <span>Egreso</span>
                            <span class="ml-2 text-red-500 font-bold">S/ 116.00</span>
                        </div>
                    </div>

                </div>



            </div>
        </div>
        <div id="last-incomes">
            <h1 class="font-bold py-4 uppercase">Gráficas</h1>
            <div id="stats" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-2 gap-4">
                <div class="bg-white border border-gray-100 p-6 shadow-md shadow-black/5 rounded-lg">
                    <canvas id="graficoPagoSemana"></canvas>
                </div>
                <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5 ">
                    <canvas id="graficoPagoAnual"></canvas>

                </div>


            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div id="last-users">
                <h1 class="font-bold py-4 uppercase"> Top Productos</h1>
                <div class="overflow-x-scroll  mx-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                            <th class="text-left py-3 px-2 rounded-l-lg">Producto</th>
                            <th class="text-left py-3 px-2">Cantidad</th>
                            <th class="text-left py-3 px-2">Total</th>

                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                            @foreach ($productosVendidos as $vendido)
                                <tr class="border-b ">
                                    <td class="py-3 px-2">{{ $vendido->nombre }}</td>
                                    <td class="py-3 px-2">{{ $vendido->total_cantidad }} {{ $vendido->simbolo_sunat }}
                                    </td>
                                    <td class="py-3 px-2">s/ {{ number_format($vendido->total_monto, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="last-users">
                <h1 class="font-bold py-4 uppercase"> Top Clientes</h1>
                <div class="overflow-x-scroll  mx-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                            <th class="text-left py-3 px-2 rounded-l-lg">Cliente</th>
                            <th class="text-left py-3 px-2"># Trans.</th>
                            <th class="text-left py-3 px-2">Total</th>

                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                            @foreach ($topClientes as $cliente)
                                <tr class="border-b ">
                                    <td class="py-3 px-2">{{ $cliente->nombres }} {{ $cliente->apellidos }}</td>
                                    <td class="py-3 px-2"> {{ $cliente->total_compras }}
                                    </td>
                                    <td class="py-3 px-2">s/ {{ number_format($cliente->monto_total, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        var ctx = document.getElementById('balanceChart1').getContext('2d');
        var balanceChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Totales', 'Total pagos'],
                datasets: [{
                    data: [116, {{ $ingresosmesActual->sum('total') }}],
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
                    data: [{{ $ingresosmesActual->sum('total') }}, 116],
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
        var ctx = document.getElementById('graficoPagoAnual').getContext('2d');

        var labels = {!! json_encode($pagosUltimosDoceMeses->pluck('month')) !!};
        var data = {!! json_encode($pagosUltimosDoceMeses->pluck('total')) !!};

        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
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
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
    <script>
        var ctx = document.getElementById('graficoPagoSemana').getContext('2d');

        var labels = {!! json_encode($pagosUltimasemana->pluck('fecha')) !!};
        var data = {!! json_encode($pagosUltimasemana->pluck('total')) !!};

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pagos últimos 7 días',
                    data: data,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
@endsection
