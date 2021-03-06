<!DOCTYPE html>
<html>
<head>
<title>Softecol</title>

@includeIf('layouts.header')
<style media="screen" type="text/css">

	.dl-horizontal dt 
	{
	    white-space: normal;
	    width: 350px; 
	}

</style>
<link rel="stylesheet" href="{{ asset('css/etalage.css') }}" type="text/css" media="all" />

<meta name="csrf-token" content="{{ csrf_token() }}">

<script src="{{ asset('js/jquery.etalage.min.js') }}"></script>
    <!--Scriot para llenar la cantidad en el carrito-->

<body> 
   <div class="container ">
    	<div class="row" style="margin-top:15px">                
			<div class="col-md-7 col-xs-12 col-lg-7 col-md-offset-2">
			   	<div class="panel panel-success">
			              <div class="panel-heading text-center"><h4>Gracias por tu compra!!</h4></div>
				        	    <div class="panel-body">
				        	    	<h2><p class="text-center">Resultado de la transacci&oacute;n</p></h2>
									<dl class="dl-horizontal">											  
											  @if ($respay['tiptx']  == 1 || $respay['tiptx'] == 2)
											  <dt><h4><p class="text-left">M&eacute;todo de pago utilizado:</p></h4></dt>
											  @if ( $respay['tiptx']  == 1)
											  	<dd><h4>Consginaci&oacute;n</h4></dd>
											  @else
											  <dd><h4>Efectivo</h4></dd>
											  @endif											  
											  <dt><h4><p class="text-left">Estado transacci&oacute;n:</p></h4></dt>
											  <dd><h4>Pendiente por pagar/Confirmar</h4></dd>
											  
											  <dt><h4><p class="text-left">Valor bruto:</p></h4></dt>
											  <dd><h4>{{ $respay['valbru'] }}</h4></dd>
											  											
											  <dt><h4><p class="text-left">Costos financieros:</p></h4></dt>
											  <dd><h4>{{ $respay['gasfin'] }}</h4></dd>
										
											  <dt><h4><p class="text-left">Gastos de envio:</p></h4></dt>
											  <dd><h4>{{ $respay['gasenv'] }}</h4></dd>
											 
											  <dt><h4><p class="text-left">Iva facturado:</p></h4></dt>
											  <dd><h4>{{ $respay['ivacli'] }}</h4></dd>
											  
											  <dt><h4><p class="text-left">Monto de transacci&oacute;n:</p></h4></dt>
											  <dd><h4>${{ number_format($respay['totcli'],2) }}</h4></dd>

											  @else
											  <dt><h4><p class="text-left">M&eacute;todo de pago utilizado:</p></h4></dt>
											  <dd><h4>{{ $respay['lapPayMethod'] }}</h4></dd>
											  <dt><h4><p class="text-left">Estado transacci&oacute;n:</p></h4></dt>
											  <dd><h4>{{ $respay['mensaje'] }}</h4></dd>
											 
											  <dt><h4><p class="text-left">Monto de transacci&oacute;n:</p></h4></dt>
											  <dd><h4>${{ number_format($respay['tx_val_m'],2) }}</h4></dd>
											
											  <dt><h4><p class="text-left">Banco de pago:</p></h4></dt>
											  <dd><h4>{{ $respay['pseBank'] }}</h4></dd>
										
											  <dt><h4><p class="text-left">Descripcion del pago:</p></h4></dt>
											  <dd><h4>{{ $respay['descrp'] }}</h4></dd>
											 @endif
											</dl>											
											<a href="{{ url('/') }}"> <button type="button" class="btn btn-success">
	                                			 Regresar al inicio</button></a>
	                                		<a href="pdf/{{ $respay['refcli'] }}.pdf"> <button type="button" class="btn btn-warning">
	                                			 Descargar comprobante</button></a>
							</div>           
				       </div>	            
				  </div>
			</div>      
 		</div>			
 
    @includeIf('layouts.footer')
</body>
</html>