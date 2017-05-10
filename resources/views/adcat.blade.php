@extends('layouts.admlay')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<h1>Adicionar/Editar Categoria</h1>
			<hr>
		</div>
	</div>	
</div>
@if (session('status'))
<div class="alert alert-success alert-dismissable">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Exito!</strong> {{ session('status') }}
</div>
@endif
<div class="container-fluid">
	{!! Form::open(['url' => 'admin/categorias/add','method' => 'post', 'class' => 'form-horizontal','files' => true]) !!}
	
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
			      <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese nombre" required>
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="control-label col-sm-2" for="descripcion">Descripci&oacute;n:</label>
			    <div class="col-sm-6"> 
			    	<textarea rows="6" class="form-control" id="descripcion" name="descripcion" placeholder="Ingrese descripci&oacute;n" required ></textarea>			      
			    </div>
			 </div> 
			 <div class="form-group">
				 <label class="control-label col-sm-2" for="foto">Imagen:</label>
					 <div class="col-md-6">
						{{ Form::file('photo', ['class' => 'form-control']) }}
					 </div>
				</div>
		</fieldset>	 
		{!! Form::close() !!} 

	</div>
</div>
<!-- DataTables JavaScript -->
<script src="{{  asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{  asset('js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{  asset('js/dataTables.responsive.js')}}"></script>


<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
  $(document).ready(function() {
       $('#dataTables-example').DataTable({
           responsive: true
       });
  });
</script>
@endsection