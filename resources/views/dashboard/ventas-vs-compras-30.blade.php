<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">

    <div class="rounded-md border border-dashed border-gray-200 p-4">
        <div class="flex items-center mb-0.5">
            <div
                class="text-xl p-1 rounded text-[12px] font-semibold bg-emerald-500/10 text-emerald-500 leading-none ml-1">
                S/{{ $pagosUltimomes->sum('total') }}</div>

        </div>
        <span class="text-gray-400 text-sm">Ventas</span>
    </div>
    <div class="rounded-md border border-dashed border-gray-200 p-4">
        <div class="flex items-center mb-0.5">
            <div class="text-xl p-1 rounded text-[12px] font-semibold bg-rose-500/10 text-rose-500 leading-none ml-1">
                S/{{ $comprasUltimomes->sum('total') }}</div>

        </div>
        <span class="text-gray-400 text-sm">Compras</span>
    </div>
    <div class="rounded-md border border-dashed border-gray-200 p-4">
        <div class="flex items-center mb-0.5">
            <div class="text-xl p-1 rounded text-[12px] font-semibold bg-blue-500/10 text-blue-500 leading-none ml-1">
                S/{{ $pagosUltimomes->sum('total') - $comprasUltimomes->sum('total') }}</div>

        </div>
        <span class="text-gray-400 text-sm">Diferencia</span>
    </div>
</div>
<div>
    <canvas id="projectStatusChart30"></canvas>
</div>

@php
use Carbon\Carbon;

use Illuminate\Support\Collection;
    function formatNumber($number)
    {
        return number_format($number, 2, '.', '');
    }

    // Obtener las fechas de los últimos 30 días
    $ultimoMes = Collection::times(30, function ($i) {
        return now()
            ->subDays(30 - $i)
            ->format('Y-m-d');
    });

    // Preparar los datos para las ventas y compras
    $pagosFiltrados = $pagosUltimomes->pluck('total', 'fecha')->toArray();
    $comprasFiltradas = $comprasUltimomes->pluck('total', 'fecha')->toArray();

    // Crear los datasets para las gráficas
    $labels = $ultimoMes
        ->map(function ($fecha) {
            return Carbon::parse($fecha)->locale('es')->isoFormat('D [de] MMM YYYY');
        })
        ->values();

    $ventasData = $ultimoMes
        ->map(function ($fecha) use ($pagosFiltrados) {
            return formatNumber($pagosFiltrados[$fecha] ?? 0);
        })
        ->values();

    $comprasData = $ultimoMes
        ->map(function ($fecha) use ($comprasFiltradas) {
            return formatNumber($comprasFiltradas[$fecha] ?? 0);
        })
        ->values();

    // Calcular el máximo para el eje Y
    $maxValue = max($ventasData->max() ?? 0, $comprasData->max() ?? 0);
    $suggestedMax = ceil($maxValue / 100) * 100; // Redondear al siguiente centenar
@endphp

@endphp
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var mectx = document.getElementById('projectStatusChart30').getContext('2d');

        const mechartData = {
            labels: @json($labels),
            datasets: [{
                    label: 'Ventas',
                    data: @json($ventasData),
                    borderColor: 'rgb(54, 162, 235)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    fill: true,
                },
                {
                    label: 'Compras',
                    data: @json($comprasData),
                    borderColor: 'rgb(255, 99, 132)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    fill: true,
                }
            ]
        };

        new Chart(mectx, {
            type: 'line',
            data: mechartData,
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Ventas vs Compras últimos 30 días'
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += new Intl.NumberFormat('es-ES', {
                                        style: 'currency',
                                        currency: 'PEN'
                                    }).format(context.parsed.y);
                                }
                                return label;
                            }
                        }
                    },
                },
                interaction: {
                    intersect: false,
                    mode: 'nearest',
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
                        suggestedMax: {{ $suggestedMax }},
                        ticks: {
                            callback: function(value, index, values) {
                                return new Intl.NumberFormat('es-ES', {
                                    style: 'currency',
                                    currency: 'PEN'
                                }).format(value);
                            }
                        }
                    }
                }
            },
        });
    });
</script>
