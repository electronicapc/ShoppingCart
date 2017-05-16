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
										 <div class="form-group">
										    <label class="control-label col-sm-2" for="categoria">Categoria:</label>
										    <div class="col-sm-6">
										      <select name="categoria" id="categoria" class="form-control" required>
										      		<option selected="selected" value=""></option>
												</select>
										    </div>
										 </div>
										 <div class="form-group">
										    <label class="control-label col-sm-2" for="ppublico">P. Publico:</label>
										    <div class="col-sm-6">
										      <input type="number" class="form-control" id="ppublico" name="ppublico"  min="0" max="999999999999" placeholder="Ingrese Precio de venta al publico - solo numeros" value="{{ $producto['precpu'] }}" required>
										    </div>
										 </div>
										 <div class="form-group">
										    <label class="control-label col-sm-2" for="costo">Costo:</label>
										    <div class="col-sm-6">
										      <input type="number" class="form-control" id="costo" name="costo" min="0" max="999999999999" value="{{ $producto['costo'] }}" placeholder="Ingrese Costo del producto - solo numeros" required>
										    </div>
										 </div>
										 <div class="form-group">
										    <label class="control-label col-sm-2" for="referencia">Referencia:</label>
										    <div class="col-sm-6">
										      <input type="text" class="form-control" id="referencia" name="referencia" min="0" value="{{ $producto['ReferenciaOEM'] }}" placeholder="Ingrese Referencia" required>
										    </div>
										 </div>
										 <div class="form-group">
										    <label class="control-label col-sm-2" for="iva">Iva:</label>
										    <div class="col-sm-6">
										      <select name="iva" id="iva" class="form-control" placeholder="Seleccione IVA" required>
										      	  <option selected="selected" value="{{ $producto['iva'] }}">{{ $producto['iva'] }}</option>
												  <option value="SI">SI</option>
												  <option value="NO">NO</option>
												</select>
										    </div>
										 </div>
										<div class="form-group">
										    <label class="control-label col-sm-2" for="piva">Porcentaje de Iva:</label>
										    <div class="col-sm-6">
										      <input type="number" class="form-control" id="piva" name="piva"  min="0" max="99" value="{{ $producto['ivap'] }}" placeholder="Ingrese porcentaje de IVA - solo numeros" required>
										    </div>
										 </div>
										 <div class="form-group">
										    <label class="control-label col-sm-2" for="activo">Activo?:</label>
										    <div class="col-sm-6">
										      <select name="activo" class="form-control" id="activo" placeholder="Activo?" required>
										      	  <option selected="selected" value="{{ $producto['activo'] }}">{{ $producto['activo'] }}</option>
												  <option value="SI">SI</option>
												  <option value="NO">NO</option>
												</select>
										    </div>
										 </div>
										 <div class="form-group">
										    <label class="control-label col-sm-2" for="destacado">Destacado:</label>
										    <div class="col-sm-6">
										      <select name="destacado" class="form-control" id="destacado" placeholder="Producto destacado?" required>
										          <option selected="selected" value="{{ $producto['destacado'] }}">{{ $producto['destacado'] }}</option>
												  <option value="SI">SI</option>
												  <option value="NO">NO</option>
												</select>
										    </div>
										 </div>
										 <div class="form-group">
										    <label class="control-label col-sm-2" for="cexist">Cantidad en Existencia:</label>
										    <div class="col-sm-6">
										      <input type="number" class="form-control" id="cexist" name="cexist"  min="0" min="0" max="99"  value="{{ $producto['cantidadex'] }}" placeholder="Ingrese cantidad en inventario - solo numeros" required>
										    </div>
										 </div>
										@php 
                                			$imgpath1 = asset($producto['foto']).'/'.$producto['id'].'.jpg'  ; 
                                			$imgpath2 = asset($producto['foto']).'/'.$producto['id'].'_2.jpg' ;
                                			$imgpath3 = asset($producto['foto']).'/'.$producto['id'].'_3.jpg'                              			
                                		@endphp 
										<div class="form-group">
										    <label class="control-label col-sm-2" for="descripcion">Imagen Principal:</label>
										    <div class="col-sm-6"> 
										    	<img src="{{$imgpath1}}" alt="Categoria" width="80" height="79">			      
										    </div>
										 </div> 
										 <div class="form-group">
											 <label class="control-label col-sm-2" for="foto">Imagen Principal:</label>
												 <div class="col-md-6">
													{{ Form::file('photo1', ['class' => 'form-control']) }}
												 </div>
										 </div>
										 <div class="form-group">
										    <label class="control-label col-sm-2" for="descripcion">Imagen No. 2:</label>
										    <div class="col-sm-6"> 
										    	<img src="{{$imgpath2}}" alt="Categoria" width="80" height="79">			      
										    </div>
										 </div> 
										 <div class="form-group">
											 <label class="control-label col-sm-2" for="foto">Imagen No. 2:</label>
												 <div class="col-md-6">
													{{ Form::file('photo2', ['class' => 'form-control']) }}
												 </div>
										 </div>
										 <div class="form-group">
										    <label class="control-label col-sm-2" for="descripcion">Imagen No. 3:</label>
										    <div class="col-sm-6"> 
										    	<img src="{{$imgpath3}}" alt="Categoria" width="80" height="79">			      
										    </div>
										 </div> 
										 <div class="form-group">
											 <label class="control-label col-sm-2" for="foto">Imagen No. 3:</label>
												 <div class="col-md-6">
													{{ Form::file('photo3', ['class' => 'form-control']) }}
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

<script type="text/javascript">
  $(document).ready(function() {
	  $.ajax ({
	  type:'get',
	  url: 'prodcat',
	  datatype: "json",
	  success: function(data) {
		  //$("#categoria").empty();
		  $.each(JSON.parse(data), function(i,obj){
		  $("#categoria").append('<option value="' + obj.id + '">' + obj.name +   
		  '</option>');
		        })
		       }
		     });
	  });

  </script>

@endsection