@extends('layouts.admlay')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<h1>Editar Ventas</h1>
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
                            Ventas
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
								{!! Form::open(['url' => 'admin/ventas/edicion','method' => 'post', 'class' => 'form-horizontal']) !!}
	
								<div class="row" style="margin-bottom:10px">
									<div class="center-block col-sm-12">   
										<a href="categorias/add"><button type="submit" class="btn btn-success btn-lg pull-right">
												<span class="glyphicon glyphicon-floppy-saved"></span>
										</button>
										</a>
									</div>
								</div>
								@php
									$array =  $dventa->first();
								@endphp	

								<div class="row">
									<fieldset>
									  	<div class="form-group">
										    <label class="control-label col-sm-2" for="nombre">Nombre del Cliente:</label>
										    <div class="col-sm-6">
										      <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $array->nomcli }}" placeholder="Ingrese nombre" disabled>
										    </div>
										</div>
									  	<div class="form-group">
										    <label class="control-label col-sm-2" for="email">Email cliente:</label>
										    <div class="col-sm-6">
										      <input type="text" class="form-control" id="email" name="email" value="{{ $array->email }}" placeholder="Ingrese email" disabled>
										    </div>
										</div>
										<div class="form-group">
										    <label class="control-label col-sm-2" for="dir">Direcci&oacute;n del Cliente:</label>
										    <div class="col-sm-6">
										      <input type="text" class="form-control" id="dir" name="dir" value="{{ $array->address }}" placeholder="Ingrese direccion" disabled>
										    </div>
										</div>
									  	<div class="form-group">
										    <label class="control-label col-sm-2" for="phone">Tel&eacute;fono cliente:</label>
										    <div class="col-sm-6">
										      <input type="text" class="form-control" id="phone" name="phone" value="{{ $array->phonen }}"  disabled>
										    </div>
										</div>
										<div class="form-group">
										    <label class="control-label col-sm-2" for="vf">Valor total Factura:</label>
										    <div class="col-sm-6">
										      <input type="text" class="form-control" id="vf" name="vf" value="{{ $array->valorFacturado }}"  disabled>
										    </div>
										</div>
									  	<div class="form-group">
										    <label class="control-label col-sm-2" for="ftx">Fecha transacci&oacute;n:</label>
										    <div class="col-sm-6">
										      <input type="text" class="form-control" id="ftx" name="ftx" value="{{ $array->fechatx }}" disabled>
										    </div>
										</div>
										<div class="form-group">
										    <label class="control-label col-sm-2" for="ivac">Iva facturado:</label>
										    <div class="col-sm-6">
										      <input type="text" class="form-control" id="ivac" name="ivac" value="{{ $array->ivac }}"  disabled>
										    </div>
										</div>
										<div class="form-group">
										    <label class="control-label col-sm-2" for="mp">Medio de Pago:</label>
										    <div class="col-sm-6">
										      <input type="text" class="form-control" id="mp" name="mp" value="{{ $array->med_pag }}"  disabled>
										    </div>
										</div>
									  	<div class="form-group">
										    <label class="control-label col-sm-2" for="com">Comentarios:</label>
										    <div class="col-sm-6">
										      <textarea rows="6" class="form-control" id="com" name="com" placeholder="Ingrese Comentarios" required >{{ $array->comentarios }}</textarea>
										    </div>
										</div>
										<div class="form-group">
										    <label class="control-label col-sm-2" for="conf">Confirmado? :</label>
										    <div class="col-sm-6">
										    @if ($array->confirmado == 'SI')	
										      <select name="conf" id="conf" class="form-control"  disabled>
										      	  <option selected="selected" value="{{ $array->confirmado }}">{{ $array->confirmado }}</option>
											 </select>
											@else	
											 <select name="conf" id="conf" class="form-control"  required>
										      	  <option selected="selected" value="{{ $array->confirmado }}">{{ $array->confirmado }}</option>
												  <option value="SI">SI</option>
												  <option value="NO">NO</option>
											 </select>
											@endif
										    </div>
										 </div>
									</fieldset>	 
									<fieldset style="margin-left: 10px;margin-right:10px;">
										<h3><p> Relaci&oacute;n de productos por venta:</p></h3>
									  	  <div class="table-responsive">          
											  <table class="table">
											    <thead>
											      <tr>
											        <th>#</th>
											        <th>C&oacute;digo de producto</th>
											        <th>Nombre</th>
											        <th>Cantidad</th>
											        <th>Valor facturado</th>
											        <th>Iva facturado</th>
											      </tr>
											    </thead>
											    <tbody>
											    @foreach ($dventa as $list)
											      <tr>
											        <td>{{ $loop->index + 1}}</td>
											        <td>{{ $list->CodigoProducto}}</td>
											        <td>{{ $list->name}}</td>
											        <td>{{ $list->Cantidad}}</td>
											        <td>{{ $list->valorFac}}</td>
											        <td>{{ $list->ivaFac}}</td>
											      </tr>
											    @endforeach  
											    </tbody>
											  </table>
											</div>
									</fieldset>	
									{{ Form::hidden('idV', $array->CodigoVenta) }}
									{!! Form::close() !!} 
                        		</div>
       
                        
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
		</div>
	</div>
</div>


@endsection