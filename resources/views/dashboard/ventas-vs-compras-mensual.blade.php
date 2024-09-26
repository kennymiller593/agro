
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
  
    <div class="rounded-md border border-dashed border-gray-200 p-4">
        <div class="flex items-center mb-0.5">
            <div
                class="text-xl p-1 rounded text-[12px] font-semibold bg-emerald-500/10 text-emerald-500 leading-none ml-1">
                S/{{ $pagosUltimosDoceMeses->sum('total') }}</div>

        </div>
        <span class="text-gray-400 text-sm">Ventas</span>
    </div>
    <div class="rounded-md border border-dashed border-gray-200 p-4">
        <div class="flex items-center mb-0.5">
            <div class="text-xl p-1 rounded text-[12px] font-semibold bg-rose-500/10 text-rose-500 leading-none ml-1">
                S/{{ $comprasUltimosDoceMeses->sum('total') }}</div>

        </div>
        <span class="text-gray-400 text-sm">Compras</span>
    </div>
    <div class="rounded-md border border-dashed border-gray-200 p-4">
        <div class="flex items-center mb-0.5">
            <div class="text-xl p-1 rounded text-[12px] font-semibold bg-blue-500/10 text-blue-500 leading-none ml-1">
                S/{{ $pagosUltimosDoceMeses->sum('total') - $comprasUltimosDoceMeses->sum('total') }}</div>

        </div>
        <span class="text-gray-400 text-sm">Diferencia</span>
    </div>
</div>
<div>
    <canvas id="projectStatusChartMensual"></canvas>
</div>
@php
    use Carbon\Carbon;

    // Paso 1: Obtener las fechas de los últimos 7 días
    $ultimosDoceMeses = collect();
    for ($y = 11; $y >= 0; $y--) {
        $ultimosDoceMeses->push(now()->subMonths($y)->format('Y-m')); // Genera un array de fechas de los últimos 12 meses
    }

    // Paso 2: Preparar los datos para las ventas
    $pagosFiltradosMensual = $pagosUltimosDoceMeses->mapWithKeys(function ($pagoMensual) {
        return [Carbon::createFromDate($pagoMensual->year, $pagoMensual->month, 1)->format('Y-m') => $pagoMensual->total];
    });

    // Paso 3: Preparar los datos para las compras
    $comprasFiltradas = $comprasUltimosDoceMeses->mapWithKeys(function ($compraMensual) {
        return [Carbon::createFromDate($compraMensual->year, $compraMensual->month, 1)->format('Y-m') => $compraMensual->total];
    });

    // Paso 4: Crear los datasets para las gráficas utilizando el rango de fechas común
    $labelsMensual = $ultimosDoceMeses->map(function ($fechaMensual) {
        return Carbon::parse($fechaMensual)->locale('es')->translatedFormat('M Y'); // Formato de mes y año
    });

    $ventasDataMensual = $ultimosDoceMeses->map(function ($fechaMensual) use ($pagosFiltradosMensual) {
        return $pagosFiltradosMensual->get($fechaMensual, 0); // Devuelve 0 si no hay pagos para esa fecha
    });

    $comprasDataMensual = $ultimosDoceMeses->map(function ($fechaMensual) use ($comprasFiltradas) {
        return $comprasFiltradas->get($fechaMensual, 0); // Devuelve 0 si no hay compras para esa fecha
    });

@endphp
<script>
    var ctxyz = document.getElementById('projectStatusChartMensual').getContext('2d');

    // Paso 5: Pasar los datos a JavaScript
    const chartDatax = {
        labels: {!! json_encode($labelsMensual) !!},
        datasets: [{
                label: 'Ventas',
                data: {!! json_encode($ventasDataMensual) !!},
                borderColor: 'rgb(54, 162, 235)',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                fill: true,
            },
            {
                label: 'Compras',
                data: {!! json_encode($comprasDataMensual) !!},
                borderColor: 'rgb(255, 99, 132)',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                fill: true,
            }
        ]
    };

    new Chart(ctxyz, {
        type: 'line',
        data: chartDatax,
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Ventas Vs Compras 12 últimos meses'
                },
            },
            interaction: {
                intersect: false,
            },
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Mes'
                    }
                },
                y: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Monto'
                    },
                    suggestedMin: 0,
                    suggestedMax: 10
                }
            }
        },
    });
</script>
