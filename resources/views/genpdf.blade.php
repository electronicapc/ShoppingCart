<!DOCTYPE html>
<html>
<meta charset="utf-8" />
@php
	$datacar	= Session::get('cart');
	$totalct 	= 0;
	$totalcf	= 0;
	$totalge	= 0;
	$totalpg	= 0;
	$totaliv	= 0;
	foreach($datacar as $key => $value)
	{
		$totalct = ($value['cantidad']*$value['precio'] *$value['iva']) + $totalct;
		$totaliv = ($value['cantidad']*$value['precio'] * ($value['iva'] - 1)) + 	$totaliv;
	}
@endphp
<!--Librerias bootstrap y Jquery-->	
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- Fin Librerias bootstrap y Jquery-->	
<style>@import url(http://fonts.googleapis.com/css?family=Bree+Serif);
  body, h1, h2, h3, h4, h5, h6{
    font-family: 'Bree Serif', serif;
  }
</style>
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-5">
		<h1><a href=" "><img alt="" width="100" height="100" src="{{asset('images/logo.png') }}" />Softecol</a></h1>
		</div>
		<div class="col-xs-5 text-left">
		<h4>Comprobante de compromiso de compra/ Factura de venta</h4>
		<h1>Compra No.: {{$data['refcli'] }}</h1>
		<h4>Fecha: {{$data['today'] }}</h4>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-5">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h5>De: <a href="#">Softecol</a></h5>
				</div>
				<div class="panel-body">Direcci&oacute;n: Dg 2B No. 82-30<br>
					Tel&eacute;fono: 305 7159818<br>
					Email: servicio@softecol.com<br>
					Bogot&aacute; - Colombia<br>
					Regimen Simplificado
				</div>
			</div>
		</div>
		<div class="col-xs-5 text-left">
			<div class="panel panel-default">
				<div class="panel-heading">			
					<h5>Para : <a href="#">{{$data['nomcli'] }}</a></h5>
				</div>
				<div class="panel-body">
					NIT/CC : {{$data['idcli'] }}<br>
					Email : {{$data['emacli'] }}<br>
					Direcci&oacute;n Entrega: {{$data['dircli'] }}<br>
					Ciudad entrega: {{$data['ciucli'] }}<br>
					Tel&eacute;fono Contacto: {{$data['telcli'] }}	
				</div>
			</div>
		</div>
  </div>
  <h3 style="margin-top: 0px;">Detalle de compra</h3>
  <div class="row">
	<div class="">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>
								<h5>Servicio</h5>
							</th>
							<th>
								<h5>Descripci&oacute;n</h5>
							</th>
							<th>
								<h5>Hrs / Cantidad</h5>
							</th>
							<th>
								<h5>Tarifa / Precio</h5>
							</th>
							<th>
								<h5>Sub-Total</h5>
							</th>
						</tr>
					</thead>
				<tbody>
					@foreach($datacar as $key => $value)
					<tr>
						<td>Art&iacute;culo</td>
						<td><a href="#">{{ $value['descripcion'] }}</a></td>
						<td class=" text-right ">{{ $value['cantidad'] }}</td>
						<td class=" text-right ">${{ $value['precio'] * $value['iva']}}</td>
						<td class=" text-right ">${{ $value['precio'] * $value['iva']}}</td>
					</tr>
					@endforeach	
				</tbody>
			</table>	
		</div>
	</div>
    <div class="row text-right">
		<div class="col-xs-3 col-xs-offset-5">
				<h5>Sub Total:</h5>
				<h5>Impuestos IVA:</h5>
				<h5>Gastos Financieros:</h5>
				<h5>Gastos Envio:</h5>
				<h4>Total:</h4>

		</div>
		<div class="">

				<h5>${{ number_format($data['valbru']) }}</h5>
				<h5>${{number_format($data['ivacli']) }}</h5>
				<h5>${{ number_format($data['gasfin']) }}</h5>
				<h5>${{number_format($data['gasenv']) }}</h5>
				<h4>${{number_format($data['totcli']) }}</h4>

		</div>
	</div>
	
	<div class="row">
		<div class = "col-xs-12">

			<div class="panel panel-info">
				<div class="panel-heading">
					<h4> Condiciones pago efectivo/Consignaci&oacute;n </h4>
						</div>
							<div class="panel-body">
								<p>Recuerde que si el pago seleccionado es mediante consignaci&oacute;n se debe anexar copia de esta mediante 
							        correo el&eacute;ctronico a servicio@softecol.com o mensajer&iacute;a instantanea al n&uacute;mero 305 7159818
							        indicando el n&uacute;mero de referencia de la compra, que ser&aacute; enviado al correo el&eacute;ctronico registrado para proceder con el envio.
							        Si el pago es contra-entrega en efectivo recibir&aacute; una llamada de confirmaci&oacute;n el d&iacute;a de la entrega confirmando disponibilidad de pago.
								</p>
							</div>

					<h4><small> Se seleccion&oacute; pago en consignaci&oacute;n &oacute; efectivo contraentrega </h4>
				</div>
		</div>						
	</div>
</div>

    </body>
</html> 