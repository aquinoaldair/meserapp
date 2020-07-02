<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Orden</title>
    <style>
        body{
            font-family: "Lucida Grande", Arial, Helvetica, sans-serif;
        }
        tr.border th{
            border-bottom: 1px solid gray;
        }
    </style>
</head>
<body>
    <h4 style="text-align: center">{{ $printer_config->top_text }}</h4>
    <table style="width: 100% !important;">
        <tr class="border">
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio</th>
        </tr>
        @foreach($order->details as $detail)
            <tr class="border">
                <td>{{ $detail->product->name }}</td>
                <td style="text-align: center; font-weight: bold">{{ $detail->quantity }}</td>
                <td>${{ $detail->price }}</td>
            </tr>
        @endforeach
        <tr>
            <th colspan="3" style="text-align: right; padding-top: 10px; border-top: 1px solid gray">Total : ${{ $order->total }}</th>
        </tr>
    </table>

    <h4 style="text-align: center">{{ $printer_config->bottom_text }}</h4>
</body>
</html>
