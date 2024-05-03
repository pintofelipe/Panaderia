@extends('layouts.app')

@section('title', 'Crear productos')

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
                            <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Nombre <strong
                                                        style="color:red;">(*)</strong></label>
                                                <input type="text" class="form-control" name="name"
                                                    placeholder="Ingrese el nombre del producto" autocomplete="off"
                                                    value="{{ old('nombre') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Descripcion <strong
                                                        style="color:red;">(*)</strong></label>
                                                <textarea class="form-control" name="description" placeholder="Ingrese la descripcion del producto" id=""
                                                    cols="120" rows="4"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Cantidad <strong
                                                        style="color:red;">(*)</strong></label>
                                                <input type="text" class="form-control" name="quantity"
                                                    placeholder="Ingrese la cantidad del producto" autocomplete="off"
                                                    value="{{ old('nombre') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Precio<strong
                                                        style="color:red;">(*)</strong></label>
                                                <input type="text" class="form-control" name="price"
                                                    placeholder="Ingrese el precio del producto" autocomplete="off"
                                                    value="{{ old('nombre') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Imagen</label>
                                                <input type="file" class="form-control-file" name="image"
                                                    id="image">
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" class="form-control" name="estado" value="1">
                                    <input type="hidden" class="form-control" name="registradopor"
                                        value="{{ Auth::user()->id }}">
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-lg-2 col-xs-4">
                                            <button type="submit"
                                                class="btn btn-primary btn-block btn-flat">Register</button>
                                        </div>
                                        <div class="col-lg-2 col-xs-4">
                                            <a href="{{ route('products.index') }}"
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
@endsection