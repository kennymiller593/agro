
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">

    <div class="rounded-md border border-dashed border-gray-200 p-4">
        <div class="flex items-center mb-0.5">
            <div
                class="text-xl p-1 rounded text-[12px] font-semibold bg-emerald-500/10 text-emerald-500 leading-none ml-1">
                S/{{ $pagosUltimasemana->sum('total') }}</div>

        </div>
        <span class="text-gray-400 text-sm">Ventas</span>
    </div>
    <div class="rounded-md border border-dashed border-gray-200 p-4">
        <div class="flex items-center mb-0.5">
            <div class="text-xl p-1 rounded text-[12px] font-semibold bg-rose-500/10 text-rose-500 leading-none ml-1">
                S/{{ $comprasUltimasemana->sum('total') }}</div>

        </div>
        <span class="text-gray-400 text-sm">Compras</span>
    </div>
    <div class="rounded-md border border-dashed border-gray-200 p-4">
        <div class="flex items-center mb-0.5">
            <div class="text-xl p-1 rounded text-[12px] font-semibold bg-blue-500/10 text-blue-500 leading-none ml-1">
                S/{{ $pagosUltimasemana->sum('total') - $comprasUltimasemana->sum('total') }}</div>

        </div>
        <span class="text-gray-400 text-sm">Diferencia</span>
    </div>
</div>
<div>
    <canvas id="projectStatusChart"></canvas>
</div>

@php
    use Carbon\Carbon;

    // Paso 1: Obtener las fechas de los últimos 7 días
    $ultimaSemana = collect();
    for ($i = 6; $i >= 0; $i--) {
        $ultimaSemana->push(now()->subDays($i)->format('Y-m-d')); // Genera un array de fechas de los últimos 7 días
    }

    // Paso 2: Preparar los datos para las ventas
    $pagosFiltrados = $pagosUltimasemana->mapWithKeys(function ($pago) {
        return [Carbon::parse($pago->fecha)->format('Y-m-d') => $pago->total];
    });

    // Paso 3: Preparar los datos para las compras
    $comprasFiltradas = $comprasUltimasemana->mapWithKeys(function ($compra) {
        return [Carbon::parse($compra->fecha)->format('Y-m-d') => $compra->total];
    });

    // Paso 4: Crear los datasets para las gráficas utilizando el rango de fechas común
    $labels = $ultimaSemana->map(function ($fecha) {
        return Carbon::parse($fecha)->locale('es')->translatedFormat('d \d\e M Y');
    });

    $ventasData = $ultimaSemana->map(function ($fecha) use ($pagosFiltrados) {
        return $pagosFiltrados->get($fecha, 0); // Devuelve 0 si no hay pagos para esa fecha
    });

    $comprasData = $ultimaSemana->map(function ($fecha) use ($comprasFiltradas) {
        return $comprasFiltradas->get($fecha, 0); // Devuelve 0 si no hay compras para esa fecha
    });

@endphp
<script>
    var ctxy = document.getElementById('projectStatusChart').getContext('2d');

    // Paso 5: Pasar los datos a JavaScript
    const chartData = {
        labels: {!! json_encode($labels) !!},
        datasets: [{
                label: 'Ventas',
                data: {!! json_encode($ventasData) !!},
                borderColor: 'rgb(54, 162, 235)',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                fill: true,
            },
            {
                label: 'Compras',
                data: {!! json_encode($comprasData) !!},
                borderColor: 'rgb(255, 99, 132)',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                fill: true,
            }
        ]
    };

    new Chart(ctxy, {
        type: 'line',
        data: chartData,
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Ventas Vs Compras 7 últimos días'
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
                        text: 'Fecha'
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
