@extends('layouts.app')

@section('title', 'Add order')

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
            </div>
        </section>
        @include('layouts.partial.msg')
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-secondary">
                                <h3>@yield('title')</h3>
                            </div>
                            <form method="POST" action="{{ route('orders.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body" id="form-fields">
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Client<strong
                                                        style="color:red;">(*)</strong></label>
                                                <select type="text" class="form-control select2" name="client"
                                                    value="{{ old('client') }}">
                                                    <option value="-1">Enter the client</option>
                                                    @foreach ($clients as $client)
                                                        <option value="{{ $client->id }}">{{ $client->name }}
                                                            ({{ $client->document }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <input type="hidden" class="form-control" name="status" value="1">
                                            <input type="hidden" class="form-control" name="registered_by"
                                                value="{{ Auth::user()->id }}">
                                        </div>
                                    </div>

                                    <div class="row mt-2" data-details-field=true>
                                        <div class="col-3">
                                            <label for="">product</label>
                                            <select id="product" class="form-control" name="product_id[]">
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}" data-price="{{ $product->price }}"
                                                        data-name="{{ $product->name }}">
                                                        {{ $product->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-2">
                                            <label for="quantity">Quantity</label>
                                            <input type="number" name="quantity">
                                        </div>
                                        <div class="col-2">
                                            <label for="price">Price</label>
                                            <input type="number" name="price" readonly
                                                value="{{ $products[0]->price }}">
                                        </div>
                                        <div class="col-2">
                                            <label for="subtotal">Subtotal</label>
                                            <input type="number" name="subtotal" readonly>
                                        </div>
                                        <div class="col-2">
                                            <button class="btn btn-primary" id="add-btn">
                                                Add
                                            </button>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-11 m-5">
                                            <table class="table border">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Product</th>
                                                        <th scope="col">Quantity</th>
                                                        <th scope="col">Price</th>
                                                        <th scope="col">Subtotal</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <tbody id="list-products">
                                                </tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-4">
                                            <span class="h3 d-block text-center m-1" id="total-text">
                                                Total: $0
                                            </span>
                                        </div>
                                        <input name="total" hidden>
                                        <div class="col-4">
                                            <button type="submit"
                                                class="btn btn-primary btn-block btn-flat">Register</button>
                                        </div>
                                        <div class="col-4">
                                            <a href="{{ route('orders.index') }}"
                                                class="btn btn-danger btn-block btn-flat">Back</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <style>
        .select2 [role="textbox"] {
            margin-top: -8px !important;
            margin-left: -8px !important;
        }
    </style>
@endsection

@push('scripts')
<script>
        class Order {
        constructor(id, name, quantity, price) {
            this.id = id;
            this.name = name;
            this.price = price;
            this.quantity = quantity;
        }

        get subtotal() {
            return this.price * this.quantity;
        }

        generateHTML(index) {
            return `
            <tr data-index="${index}">
                <td>${this.name}</td>
                <td>${this.quantity}</td>
                <td>$${this.price}</td>
                <td>$${this.subtotal}</td>
                <td><button type="button" class="btn btn-danger btn-remove" onclick="removeOrder(${index})"><i class="fas fa-trash-alt"></i></button></td>
                <input hidden name="product_id[]" value="${this.id}">
                <input hidden name="quantity[]" value="${this.quantity}">
            </tr>
            `
        }
    }

    // Nodes (DOM).
    let nodeInputPrice = document.querySelector('[name="price"]')
    let nodeInputQuantity = document.querySelector('[name="quantity"]')
    let nodeInputSubtotal = document.querySelector('[name="subtotal"]')
    let nodeInputTotal = document.querySelector('[name="total"]')
    let nodeListProducts = document.querySelector('#list-products')

    function clearInputFields() {
        nodeInputPrice.value = ''
        nodeInputQuantity.value = ''
        nodeInputSubtotal.value = ''
    }

    const orders = []

    function pushOrder(order) {
        orders.push(Object.assign(Object.create(Object.getPrototypeOf(order)), order))

        updateOrderList()
    }

    function updateOrderList() {
        let total = 0;
        nodeListProducts.innerHTML = ''; // Clear the list
        orders.forEach((order, index) => {
            total += order.subtotal
            nodeListProducts.innerHTML += order.generateHTML(index)
        });

        document.querySelector('#total-text').innerText = `Total: $${total}`
        document.querySelector('[name="total"]').value = total
        nodeInputTotal.value = total
    }

    function removeOrder(index) {
        orders.splice(index, 1); // Remove the order from the array
        updateOrderList(); // Update the table and total
    }

    let currentOrder = new Order("", "", 0, 0)

    function updateCurrentOrder() {
        nodeInputPrice.value = currentOrder.price
        nodeInputQuantity.value = currentOrder.quantity
        nodeInputSubtotal.value = currentOrder.subtotal
    }

    $(document).ready(function() {
        $('.select2').select2()

        let productSelect = $('#product')
        productSelect.select2();

        $('#add-btn').on("click", (e) => {
            e.preventDefault()

            pushOrder(currentOrder)

            clearInputFields()
            productSelect.val('-')
            productSelect.trigger('change');
        })

        productSelect.on('select2:select', function(e) {
            currentOrder.id = parseInt(productSelect.find(':selected').val())
            currentOrder.name = productSelect.find(':selected').data('name')
            currentOrder.price = parseInt(productSelect.find(':selected').data('price'))
            currentOrder.quantity = 1

            updateCurrentOrder()
        });
    });

    nodeInputQuantity.addEventListener('input', () => {
        currentOrder.quantity = parseInt(nodeInputQuantity.value)
        updateCurrentOrder()
    })
    </script>
@endpush