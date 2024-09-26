<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Boleta de Venta Electrónica</title>
    <style>
        .container {
            /* Ancho típico para ticketeras */
            max-width: none;
           
        }

        body,
        html {
            font-family: "Courier New", Courier, monospace;
            font-size: 10px;
            line-height: 1.2;
            margin-left: 13px;
            margin-right: 13px;
            margin-top: 3px;
            text-align: center;
            align-items: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
          
        }

        th,
        td {
            border: none;
            padding: 1px;
            text-align: left;
        }

        .totals p {
            margin: 2px 0;
        }

        .abc {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>

<body>


    @foreach ($success as $pay)
        <div class="container">
            <div class="abc" style="text-align:center;">
                <img src="{{ $empresa->logo}}" alt="dCJqHBf.md.png" style="width: 40%;" alt="Logo"
                    class="logo">
            </div>
            <div
                style=" font-family:elvetica, sans-serif;justify-content: center;align-items: center;text-align:center; font-size:18px">
                <strong class="title">{{ $empresa->nombre_comercial}}</strong>
            </div>
            <p style="font-size: 10px;line-height: 0.3;text-align:center; font-family: 'DejaVu Sans', sans-serif;"
                class="abc">RUC {{ $empresa->ruc}}</p>
           
            <p style="font-size: 10px;line-height: 0.3;text-align:center; font-family: 'DejaVu Sans', sans-serif;"
                class="abc">{{ $empresa->direccion}}
            </p>
            <p style="font-size: 10px;line-height: 0.3;text-align:center; font-family: 'DejaVu Sans', sans-serif;"
                class="abc">CEL {{ $empresa->telefono}}
            </p>
            <div style="text-align:center;">
                @if ($pay->tipo_comprobante == 'B')
                    <p style="line-height: 0.3;font-size: 15px"><strong>BOLETA DE VENTA </strong></p>
                    <p style="line-height: 0.3;font-size: 15px"><strong>ELECTRÓNICA </strong> </p>
                @elseif($pay->tipo_comprobante == 'F')
                    <p style="line-height: 0.3;font-size: 15px"><strong>FACTURA </strong></p>
                    <p style="line-height: 0.3;font-size: 15px"><strong>ELECTRÓNICA </strong> </p>
                @elseif($pay->tipo_comprobante == 'P')
                    <p style="line-height: 0.3;font-size: 15px"><strong>PROFORMA </strong></p>
                @elseif($pay->tipo_comprobante == 'C')
                    <p style="line-height: 0.3;font-size: 15px"><strong>COTIZACIÓN </strong></p>
                @elseif($pay->tipo_comprobante == 'T')
                    <p style="line-height: 0.3;font-size: 15px"><strong>TICKET DE VENTA </strong></p>
                 
                @elseif($pay->tipo_comprobante == 'R')
                    <p style="line-height: 0.3;font-size: 15px"><strong>RECIBO </strong></p>
                @endif

                <p style=" font-family: 'DejaVu Sans', sans-serif;">{{$pay->tipo_comprobante}}003-100{{ $successId }}</p>
            </div>

            <div class="client-info"
                style="line-height: 0.5;font-size:10px; font-family: 'DejaVu Sans', sans-serif;text-align: left">
                <p class="texto">FECHA DE EMISIÓN: {{ $pay->fecha }}</p>
                <p class="texto ">CLIENTE: {{ $pay->cliente->nombres }}
                    {{ $pay->cliente->apellidos }}</p>
                <p class="texto">DOC: {{ $pay->cliente->num_doc }}</p>
                <p class="texto">DIRECCIÓN: {{ $pay->cliente->direccion }}</p>
            </div>

            <hr>

            <table style=" font-family: 'DejaVu Sans', sans-serif;font-size: 10px">
                <tr>
                    <th>CANT.</th>
                    <th>U MED.</th>
                    <th>DESCRIPCIÓN</th>
                    <th>P.UNIT</th>
                    <th>TOTAL</th>
                </tr>
                @foreach ($pay->detallesventa as $detalle)
                    <tr>
                        <td>{{ $detalle->cantidad }}</td>
                        <td>{{ $detalle->productos->unimedida->simbolo_sunat }}</td>
                        <td>{{ $detalle->productos->nombre }}</td>
                        <td>{{ $detalle->precio }}</td>
                        <td><strong>{{ $detalle->cantidad * $detalle->precio }}</strong></td>
                    </tr>
                @endforeach
            </table>
            <hr>
            <div class="totals"
                style="text-align:right;padding-right:2px: right;align-items: right; font-family: 'DejaVu Sans', sans-serif;">
                <p>OP. INAFECTAS: S/ {{ $pay->total }}</p>
                <p>IGV: S/ 0.00</p>
                <p><strong>TOTAL A PAGAR: S/ {{ $pay->total }}</strong></p>
            </div>

            <div class="footer" style="padding-top: 20px;font-weight;font-style: italic;text-align: left">
                <strong>SON: {{ $totalInWords }}</strong>
            </div>
        </div>
    @endforeach
</body>

</html>
