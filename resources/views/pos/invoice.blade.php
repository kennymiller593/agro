<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Boleta de Venta Electrónica</title>
    <style>
        .container {
            width: 50mm;
            /* Ancho típico para ticketeras */
            max-width: none;
            margin: 0;
            padding-left: 1px;
        }

        body {
            font-family: "Courier New", Courier, monospace;
            font-size: 10px;
            line-height: 1.2;
            margin: 0;
            padding: 1px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px;
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
                <img src="https://iili.io/dCJBxwX.png" alt="dCJqHBf.md.png" style="width: 40%;" alt="Logo"
                    class="logo">
            </div>
            <div
                style=" font-family:elvetica, sans-serif;justify-content: center;align-items: center;text-align:center; font-size:18px">
                <strong class="title">AGROVET FALCON</strong>
            </div>
            <p style="font-size: 10px;line-height: 0.3;text-align:center;" class="abc">RUC 20608731653</p>
            <p style="font-size: 10px;line-height: 0.3;text-align:center;" class="abc">Huánuco - Huánuco - Huánuco
            </p>
            <p style="font-size: 10px;line-height: 0.3;text-align:center;" class="abc">Email: kennyfalcon97@gmail.com
            </p>
           
            <div style="text-align:center;">
                <p style="line-height: 0.3;font-size: 15px"><strong>BOLETA DE VENTA </strong></p>
                <p style="line-height: 0.3;font-size: 15px"><strong>ELECTRÓNICA </strong> </p>
                <p>B003-00{{ $successId }}</p>
            </div>
            
            <div class="client-info" style="line-height: 0.5;font-size:8px">
                <p class="texto">FECHA DE EMISIÓN: {{ $pay->fecha }}</p>
                <p class="texto ">CLIENTE: {{ $pay->cliente->nombres }}
                    {{ $pay->cliente->apellidos }}</p>
                <p class="texto">DOC: {{ $pay->cliente->num_doc }}</p>
                <p class="texto">DIRECCIÓN: {{ $pay->cliente->direccion }}</p>
            </div>

<hr>

            <table style="padding-top: 10px">
                <tr>
                    <th>CANT.</th>
                    <th>UNIDAD</th>
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
                        <td ><strong>{{ $detalle->cantidad * $detalle->precio }}</strong></td>
                    </tr>
                @endforeach
            </table>
<hr>
            <div class="totals" style="text-align:right;justify-content: right;align-items: right;">
                <p>OP. INAFECTAS: S/ {{ $pay->total }}</p>
                <p>IGV: S/ 0.00</p>
                <p><strong>TOTAL A PAGAR: S/ {{ $pay->total }}</strong></p>
            </div>

            <div class="footer" style="padding-top: 30px;font-weight;font-style: italic;">
                <strong>SON: {{ $totalInWords }}</strong>
            </div>
        </div>
    @endforeach
</body>

</html>
