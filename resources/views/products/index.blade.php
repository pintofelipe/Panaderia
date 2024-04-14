@extends('layouts.app')


@section('content')
    <div class=content-wrapper>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>DataTables</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">DataTables</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">DataTable with minimal features & hover style</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="products-table" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Indentifier</th>
                                            <th>Product</th>
                                            <th>Image</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>{{ $product->id }}</td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->image }}</td>
                                                <td>{{ $product->price }}</td>
                                                <td>{{ $product->quantity }}</td>
                                                <td>
                                                    {{-- @can('products.edit') --}}
                                                    <a href="{{ route('products.edit', $product->id) }}"
                                                        class="btn btn-info btn-sm" title=Edit>
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    {{-- @endcan --}}
                                                    <form class="d-inline-delete-form"
                                                        action="{{ route('products.destroy', $product) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Indentifier</th>
                                            <th>Product</th>
                                            <th>Image</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card -->
                        </div>

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
        </section>
    </div>

    @push('scripts')
        <script type="text/javascript">
            $(function() {
                $("#products-table").DataTable({
                    "responsive": true,
                    "lengthChange": true,
                    "autoWidth": false,
                    //"buttons": ["excel", "pdf", "print", "colvis"],
                    "language": {
                        "sLengthMenu": "Mostrar MENU entradas",
                        "sEmptyTable": "No hay datos disponibles en la tabla",
                        "sInfo": "Mostrando START a END de TOTAL entradas",
                        "sInfoEmpty": "Mostrando 0 a 0 de 0 entradas",
                        "sSearch": "Buscar:",
                        "sZeroRecords": "No se encontraron registros coincidentes en la tabla",
                        "sInfoFiltered": "(Filtrado de MAX entradas totales)",
                        "oPaginate": {
                            "sFirst": "Primero",
                            "sPrevious": "First",
                            "sNext": "Last",
                            "sLast": "Ultimo"
                        },
                        /*"buttons": {
                            "print": "Imprimir",
                            "colvis": "Visibilidad Columnas"
                            /*"create": "Nuevo",
                            "edit": "Cambiar",
                            "remove": "Borrar",
                            "copy": "Copiar",
                            "csv": "fichero CSV",
                            "excel": "tabla Excel",
                            "pdf": "documento PDF",
                            "collection": "Colección",
                            "upload": "Seleccione fichero...."
                        }*/
                    }
                }); //.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            });
        </script>
    @endpush
@endsection