@extends('layouts.app')

@section('title','Crear Producto')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
		<div class="container-fluid">
		</div>
    </section>

	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header bg-secondary">
							<h3>@yield('title')</h3>
						</div>
						<form method="POST" action="{{ route('products.store') }}">
							@csrf
							<div class="card-body">
								<div class="row">
									<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
										<div class="form-group label-floating">
											<label class="control-label">Nombre <strong style="color:red;">(*)</strong></label>
											<input type="text" class="form-control" name="name" placeholder="Por ejemplo, Positiva" autocomplete="off" value="{{ old('nombre') }}">
										</div>
										
											
							

										<div class="form-group label-floating">
											<label class="control-label">Fotografía</label>
											<input type="file" class="form-control-file" name="image" id="image" >
										</div>
									</div>
								</div>
											<input type="cantidad">
											<img src="file" alt="">
										</div>
									</div>
								</div>
								<input type="hidden" class="form-control" name="estado" value="1">
								<input type="hidden" class="form-control" name="registradopor" value="{{ Auth::user()->id }}">
							</div>
							<div class="card-footer">
								<div class="row">
									<div class="col-lg-2 col-xs-4">
										<button type="submit" class="btn btn-primary btn-block btn-flat">Registrar</button>
									</div>
									<div class="col-lg-2 col-xs-4">
										<a href="{{ route('products.index') }}" class="btn btn-danger btn-block btn-flat">Atras</a>
									</div>
								</div>
							</div>
						</form>
						enctype="multipart/form-data"
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection
