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
									</fieldset>	 

									{!! Form::close() !!} 

                        		</div>
                        @foreach ($dventa as $list)
                        @endforeach
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
		</div>
	</div>
</div>


@endsection