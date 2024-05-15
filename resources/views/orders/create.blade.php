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
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="client">Client<strong style="color:red;">(*)</strong></label>
                                            <select id="client" class="form-control" name="client">
                                                <option value="-1">Select the client</option>
                                                @foreach ($clients as $client)
                                                <option value="{{ $client->id }}">{{ $client->name }} ({{ $client->document }})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <input type="hidden" name="status" value="1">
                                        <input type="hidden" name="registered_by" value="{{ Auth::user()->id }}">

                                        <button id="add-field-button" type="button" class="btn btn-primary">
                                            Add product
                                        </button>
                                    </div>
                                </div>

                                <div class="row mt-2" data-details-field="true">
                                    <div class="col-12">
                                        <select class="form-control" name="product_id[]">
                                            <option value="-1">Please select a product</option>
                                            @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }} (${{ $product->price }})</option>
                                            @endforeach
                                        </select>

                                        <input type="number" class="form-control" name="quantity[]" value="1">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-2 col-xs-4">
                                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                                    </div>
                                    <div class="col-lg-2 col-xs-4">
                                        <a href="{{ route('clients.index') }}" class="btn btn-danger btn-block">Back</a>
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const fields = document.querySelector("#form-fields");
        const addButton = document.querySelector("#add-field-button");

        addButton.addEventListener("click", () => {
            const newRow = createRowWithFields();
            fields.appendChild(newRow);
        });

        function createRowWithFields() {
            const clone = document.querySelector("[data-details-field=true]").cloneNode(true);
            clone.querySelector("select").selectedIndex = 0;
            clone.querySelector("input[type='number']").value = 1;
            return clone;
        }
    });
</script>
@endsection
