@extends('layouts.app')

@section('title', 'Bill')

@section('content')

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row p-3 mb-4">
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Order Details</h5>
                            <p class="card-text"><strong>Date:</strong> {{ $order->date_order }}</p>
                            <p class="card-text"><strong>Total:</strong> ${{ number_format($order->total, 2) }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Client Details</h5>
                            <p class="card-text"><strong>Client:</strong> {{ $order->client_name }}</p>
                            <p class="card-text"><strong>Document:</strong> {{ $order->client_document }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Order Items</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-bordered mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($details as $detail)
                                <tr>
                                    <td>{{ $detail->product_name }}</td>
                                    <td>${{ number_format($detail->product_price, 2) }}</td>
                                    <td>{{ $detail->quantity }}</td>
                                    <td>${{ number_format($detail->product_price * $detail->quantity, 2) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No items found</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
