@extends('layouts.admlay')

@section('content')
<div class="container-fluid">
	<div class="col-sm-12 col-md-10">
		<h1>Carga Masiva y Export Excel</h1>
		<hr>
	</div>
</div>
<div class="container-fluid">
	<div class="col-sm-12 col-md-10">
			<div class="panel panel-success">
			  <div class="panel-heading"><h3>Carga Masiva de Productos</h3></div>
			  	<div class="panel-body">
					{!! Form::open(['url' => 'admin/upload','method' => 'post']) !!}
					
						<div class="form-group">
							 <label class="col-md-4 control-label">Subir archivo en formato csv, 13 columnas</label>
							 <div class="col-md-6">
							{{ Form::file('file', ['class' => 'form-control']) }}
							 </div>
						</div>
							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
								      <p>
								        <button type="submit" class="btn btn-success btn-lg">
								          <span class="glyphicon glyphicon-floppy-open"></span>
								        </button>
								      </p> 
								
							</div>
						</div>
						{!! Form::close() !!} 
				</div>
			</div>
	</div>
</div>	
<div class="container-fluid">
	<div class="col-sm-12 col-md-10">
		<hr>
		<h1>Export Excel</h1>
		<hr>
	</div>
		<div class="col-sm-12 col-md-10">
			<div class="panel panel-success">
			  <div class="panel-heading"><h3>Exportal a Excel todos los productos</h3></div>
			  	<div class="panel-body">
					{!! Form::open(['url' => 'admin/excel','method' => 'post']) !!}	
							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
								      <p>
								        <button type="submit" class="btn btn-success btn-lg">
								          <span class="glyphicon glyphicon-floppy-save"></span>
								        </button>
								      </p> 
								
							</div>
						</div>
						{!! Form::close() !!} 
				</div>
			</div>
	</div>
</div>	  
@endsection