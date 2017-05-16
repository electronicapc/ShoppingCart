@extends('layouts.admlay')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<h1>Editar Usuario</h1>
			<hr>
		</div>
	</div>	
	<div class="row" style="margin-bottom:10px">
		<div class="center-block col-sm-12">   
			<a href="categorias/add"><button type="button" class="btn btn-success btn-lg pull-right">
					<span class="glyphicon glyphicon-plus-sign"></span>
			</button>
			</a>
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
                            Categorias
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Tel&eacute;fono</th>
                                        <th>Direcci&oacute;n</th>
                                        <th>Email</th>
                                        <th>Administrador?</th>
                                        <th>Editar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php
                                	$parity = 0
                                @endphp
                                @foreach ($users as $list)
                                	@if(($parity % 2) == 0)
	                                    <tr class="odd gradeA">
	                                        <td>{{ $list->name }}</td>
	                                        <td>{{ $list->phonen }}</td>
	                                        <td>{{ $list->address }}</td>
	                                        <td>{{ $list->email }}</td>
	                                        <td>{{ $list->isAdmin }}</td>
	                                        <td class="center"><a href="user/{{$list->id}}"><button type="button" class="btn btn-success btn-lg pull-right"><span class="glyphicon glyphicon-edit"></span></button><a></a></td>
	                                    </tr>
	                                @else    
	                                    <tr class="even gradeA">
	                                        <td>{{ $list->name }}</td>
	                                        <td>{{ $list->phonen }}</td>
	                                        <td>{{ $list->address }}</td>
	                                        <td>{{ $list->email }}</td>
	                                        <td>{{ $list->isAdmin }}</td>
	                                        <td class="center"><a href="user/{{$list->id}}"><button type="button" class="btn btn-success btn-lg pull-right"><span class="glyphicon glyphicon-edit"></span></button><a></a></td>
	                                    </tr>
	                                @endif    
                                    @php
                                    	$parity = $parity + 1
                                    @endphp	
                                @endforeach    
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->

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


<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
  $(document).ready(function() {
       $('#dataTables-example').DataTable({
           responsive: true
       });
  });
</script>
@endsection