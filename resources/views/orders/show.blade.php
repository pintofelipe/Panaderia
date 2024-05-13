@extends('layouts.app')

@section('title', 'Bill')

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <table class="table">
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
                                <td>{{ $detail->product->name }}</td>
                                <td>${{ $detail->product->price }}</td>
                                <td>{{ $detail->quantity }}</td>
                                <td>${{ $detail->subtotal }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection
