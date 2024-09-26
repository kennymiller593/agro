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
                <h1 class="font-bold py-4 uppercase">Filtrar por fecha</h1>

                <div class="flex flex-wrap items-center justify-between space-x-2 mb-4" bis_skin_checked="1">
                    <div class="flex items-center space-x-2" bis_skin_checked="1">
                        <input type="date" id="date_from" name="date_from" value="{{ $startDate }}"
                            class="px-2 py-1 border rounded" placeholder="dd/mm/aaaa">
                        <input type="date" id="date_to" name="date_to" value="{{ $endDate }}"
                            class="px-2 py-1 border rounded" placeholder="dd/mm/aaaa">
                        <button id="filter-btn"
                            class="px-4 py-1 text-white bg-blue-500 rounded hover:bg-blue-600">Filtrar</button>
                    </div>
                </div>
                <div id="content-prod">
                    <table id="table-prod" class="min-w-max w-full table-auto tablita">
                        <thead>
                            <tr class="bg-green-200  uppercase text-sm ">
                                <th class="text-left py-3 px-2 ">ID</th>
                                <th class="text-left py-3 px-2">Nombre</th>
                                <th class="text-left py-3 px-2">Cantidad Total Vendida </th>
                                <th class="text-left py-3 px-2">Ganancia en s/ </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $contador = 0;
                                $suma_ganancia = 0;
                            @endphp
                            @foreach ($productos as $producto)
                                <tr class="bg-white border-b  text-sm hover:bg-gray-200 cursor-pointer">
                                    <td class="text-left  whitespace-nowrap">{{ $producto->id }}</td>
                                    <td class="text-left  whitespace-nowrap">
                                        {{ $producto->nombre }}
                                    </td>

                                    <td class="bg-indigo-300 text-yellow-50">{{ $producto->cantidad_total }}</td>

                                    <td>s/ {{ number_format($producto->monto_total, 2) }}</td>


                                </tr>
                            @endforeach
                            <tr>
                                <th colspan="3">GANANCIA BRUTO</th>
                                <td>
                                    <span class="bg-green-400 text-white font-bold" id="xdd">s/
                                        {{ $productos->sum('monto_total') }}</span>
                                </td>
                            </tr>
                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal de edición -->




    <!-- Modal de edición -->


    <style>
        input[type="search"] {
            outline: none;
            border: 1px solid #107C41;
            /* Establece un borde sólido de 1 píxel con el color deseado */
            border-radius: 4px;
            /* Opcional: agrega esquinas redondeadas al borde */
        }



        .buttons-colvis {}

        .dataTables_wrapper {
            padding-top: 4px;
        }

        .buttons-csv {
            background-color: #107C41;
            color: white;
            border-radius: 2px;

        }

        .buttons-excel {
            background-color: #107C41;
            color: white;
            border-radius: 2px;

        }

        .buttons-pdf {
            background-color: #B30B00;
            color: white;
            border-radius: 2px;

        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
        crossorigin="anonymous"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- DataTables  & Plugins -->

    <script>
        document.getElementById('filter-btn').addEventListener('click', function() {
            const startDate = document.getElementById('date_from').value;
            const endDate = document.getElementById('date_to').value;

            fetch('/rentabilidad-de-productos2', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        start_date: startDate,
                        end_date: endDate
                    })
                })
                .then(response => response.json())
                .then(data => {
                    // Aquí actualizas tu tabla con los datos recibidos
                    console.log(data); // Verifica los datos en la consola
                    actualizarTabla(data);
                })
                .catch(error => console.error('Error:', error));
        });

        function actualizarTabla(productos) {
            const tabla = document.querySelector('table tbody');
            tabla.innerHTML = ''; // Limpia la tabla
            let sumaGanancia = 0; // Inicializa la suma de ganancia
            productos.forEach(producto => {
                const row = document.createElement('tr');
                row.classList.add('bg-white', 'border-b', 'text-sm', 'hover:bg-gray-200', 'cursor-pointer');
                row.innerHTML = `
            <td class="text-left whitespace-nowrap">${producto.id}</td>
            <td class="text-left whitespace-nowrap">${producto.nombre}</td>
            <td class="bg-indigo-300 text-yellow-50">${producto.cantidad_total}</td>
            <td>s/ ${Number(producto.monto_total).toFixed(2)}</td>
        `;
                tabla.appendChild(row);
                // Acumula el monto_total para calcular la suma
                sumaGanancia += parseFloat(producto.monto_total);
            });

            // Añade la fila de suma de "GANANCIA BRUTO" al final de la tabla
            const filaGanancia = document.createElement('tr');
            filaGanancia.innerHTML = `
        <th colspan="3">GANANCIA BRUTO</th>
        <td><span class="bg-green-400 text-white font-bold">s/ ${sumaGanancia.toFixed(2)}</span></td>
    `;
            tabla.appendChild(filaGanancia);
        }
        $(function() {
            let dateFrom = $('#date_from');
            let dateTo = $('#date_to');

            // Función para establecer la fecha mínima del input "hasta"
            function setMinDateTo() {
                dateTo.attr('min', dateFrom.val());
                if (dateTo.val() < dateFrom.val()) {
                    dateTo.val(dateFrom.val());
                }
            }

            // Función para establecer la fecha máxima del input "desde"
            function setMaxDateFrom() {
                dateFrom.attr('max', dateTo.val());
                if (dateFrom.val() > dateTo.val()) {
                    dateFrom.val(dateTo.val());
                }
            }

            // Evento change para el input "desde"
            dateFrom.on('change', setMinDateTo);

            // Evento change para el input "hasta"
            dateTo.on('change', setMaxDateFrom);

            // Configuración inicial
            if (dateFrom.val()) setMinDateTo();
            if (dateTo.val()) setMaxDateFrom();

            // ... resto de tu código de DataTables ...

            // Evento de clic para el botón de filtrado

        });
    </script>
@endsection
