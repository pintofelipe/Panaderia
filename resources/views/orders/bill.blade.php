<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Factura</title>

    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 18px;
            color: #333;
        }

        body {
            background-color: #f8f9fa;
            padding: 20px;
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .invoice-header p {
            margin: 5px 0;
        }

        table {
            width: 100%;
            border: none;
            border-spacing: 0;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f1c40f;
            color: #fff;
        }

        tr:last-child td {
            border-bottom: none;
        }

        strong {
            display: block;
            text-align: center;
            margin: 30px;
            font-size: 40px;
            color: #e67e22;
        }

        .invoice-footer {
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="invoice-header">
        <h1>Factura de Panadería</h1>
        <p>Fecha: {{ $order->date_order }}</p>
        <p>Cliente: {{ $client->name }}</p>
        <p>Documento: {{ $client->document }}</p>
    </div>
    <table>
        <thead>
            <tr>
                <th scope="col">Producto</th>
                <th scope="col">Precio</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($details as $detail)
            <tr>
                <td>{{ $detail->product->name }}</td>
                <td>${{ $detail->product->price }}</td>
                <td>{{ $detail->quantity }}</td>
                <td>${{ $detail->product->price * $detail->quantity }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <strong>Total: ${{ $order->total }}</strong>
    <div class="invoice-footer">
        <p>Gracias por su compra!</p>
    </div>
</body>

</html>
