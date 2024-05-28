<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Factura</title>
</head>

<body>
    <p>
        Date: {{ $order->date_order }}
        <br>
        Total: ${{ $order->total }}
        <br>
        Client: {{ $client->name }}
        <br>
        Document: {{ $client->document }}
    </p>
    <table>
        <thead>
            <tr>
                <th scope="col">Product</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Subtotal</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($details as $detail)
                <tr>
                    <th>{{ $detail->product->name }}</th>
                    <th> ${{ $detail->product->price }} </th>
                    <th> {{ $detail->quantity }} </th>
                    <th>${{ $detail->product->price * $detail->quantity }}</th>
                </tr>
            @endforeach

        </tbody>
    </table>
</body>

</html>