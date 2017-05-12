@extends('layouts.admlay')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<h1>Editar Producto</h1>
			<hr>
		</div>
	</div>	
</div>
@if (session('status'))
<div class="alert alert-success">
  <strong>Exito!</strong> {{ session('status') }}
</div>
@endif

<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			   <div class="panel panel-default">
                        <div class="panel-heading">
                            Productos
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
								{!! Form::open(['url' => 'admin/productos/edicion','method' => 'post', 'class' => 'form-horizontal','files' => true]) !!}
	
								<div class="row" style="margin-bottom:10px">
									<div class="center-block col-sm-12">   
										<a href="categorias/add"><button type="submit" class="btn btn-success btn-lg pull-right">
												<span class="glyphicon glyphicon-floppy-saved"></span>
										</button>
										</a>
									</div>
								</div>
								<div class="row">
									<fieldset>
									  	<div class="form-group">
										    <label class="control-label col-sm-2" for="nombre">Nombre:</label>
										    <div class="col-sm-6">
										      <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $producto['name'] }}" placeholder="Ingrese nombre" required>
										    </div>
										  </div>
										  <div class="form-group">
										    <label class="control-label col-sm-2" for="descripcion">Descripci&oacute;n:</label>
										    <div class="col-sm-6"> 
										    	<textarea rows="6" class="form-control" id="descripcion" name="descripcion" placeholder="Ingrese descripci&oacute;n" required >{{ $producto['Descripcion'] }}</textarea>			      
										    </div>
										 </div> 
										@php 
                                			$imgpath = asset($producto['foto']).'/'.$producto['id'].'.jpg'                                			
                                		@endphp 
										<div class="form-group">
										    <label class="control-label col-sm-2" for="descripcion">Descripci&oacute;n:</label>
										    <div class="col-sm-6"> 
										    	<img src="{{$imgpath}}" alt="Categoria" width="80" height="79">			      
										    </div>
										 </div> 
										 <div class="form-group">
											 <label class="control-label col-sm-2" for="foto">Imagen:</label>
												 <div class="col-md-6">
													{{ Form::file('photo', ['class' => 'form-control']) }}
												 </div>
											</div>
									</fieldset>	 
									{{ Form::hidden('id', $producto['id']) }}
									{!! Form::close() !!} 

                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
		</div>
	</div>
</div>

<!-- DataTables JavaScript -->
<script src="{{  asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{  asset('js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{  asset('js/dataTables.responsive.js')}}"></script>

@endsection