@extends('layouts.app')
@section('tittle', 'Listado de productos')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                 
                    @include('layouts.partial.msg')
       
                  </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title text-lg">@yield('tittle')</h3>

                                <a href="{{ route('products.create') }}" class="btn btn-primary float-right"><i
                                        class="fas fa-plus nav-icon"></i></a>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead class="text-primary">
                                        <tr>
                                            <th width="10px">ID</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Price</th>
                                            <th>Stock</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>{{ $product->id }}</td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->description }}</td>
                                                <td>
                                                    @if ($product->image != null)
                                                        <center>
                                                            <p><img class="img-responsive img-thumbnail"
                                                                    src="{{ asset('uploads/products/' . $product->image) }}"
                                                                    style="height: 70px; width: 70px;" alt=""></p>
                                                        </center>
                                                    @elseif ($product->image == null)
                                                    @endif
                                                </td>
                                                <td>{{ $product->price }}</td>
                                                <td>{{ $product->quantity }}</td>
                                                <td>
                                                    <a href="{{ route('products.edit', $product->id) }}"
                                                        class="btn btn-info btn-sm" tittle="Editar">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <form class="d-inline delete-form"
                                                        action="{{ route('products.destroy', $product) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            tittle="Eliminar">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th width="10px">ID</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Price</th>
                                            <th>Stock</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->


                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(function() {
            $("#example1").DataTable({
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
                        "sPrevious": "Anterior",
                        "sNext": "Siguiente",
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
