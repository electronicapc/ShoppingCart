<!DOCTYPE html>
<html>
<head>
<title>Softecol</title>
@includeIf('layouts.header')
</head>
<body>
<div class="container">
	<div class="row" style="margin-top:15px">
		<div class="col-md-6 col-md-offset-3">
			<div class="alert alert-danger alert-dismissable fade in">
			  <strong>Error</strong> No posee permisos para enviar esos datos al servidor.
			</div>
			<div class="col-md-offset-4">
				<button type="button" class="btn btn-danger"> <a style="color:white" href="{{ url('/') }}" >Ponerme a salvo!!</a></button>
			</div>
		</div>
	</div>
</div>
    @includeIf('layouts.footer')
</body>
</html>