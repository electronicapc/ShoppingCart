<!DOCTYPE html>
<html>
<head>
<title>Softecol</title>
@php
	$data 		= Session::get('cart');
	$totalct 	= 0;
	$totalcf	= 0;
	$totalge	= 0;
	$totalpg	= 0;
	$totaliv	= 0;
	foreach($data as $key => $value)
	{
		$totalct = ($value['cantidad']*$value['precio'] *$value['iva']) + $totalct;
		$totaliv = ($value['cantidad']*$value['precio'] * ($value['iva'] - 1)) + 	$totaliv;
	}

@endphp

@includeIf('layouts.header')
<link rel="stylesheet" href="{{ asset('css/etalage.css') }}" type="text/css" media="all" />

<meta name="csrf-token" content="{{ csrf_token() }}">
<style type="text/css">
.dl-horizontal dt{
    text-align: left;
}
</style>

<script src="{{ asset('js/jquery.etalage.min.js') }}"></script>
    <!--Scriot para llenar la cantidad en el carrito-->

	<body> 
    <div class="container">
    	<div class="row" style="margin-top:15px">
	        <div class="col-md-8 col-xs-12 col-lg-4">
	            <div class="panel panel-default">
	                <div class="panel-heading"><h4>Datos de Entrega</h4></div>
		                <div class="panel-body">
			                {!! Form::open(['url' => 'confpago','method' => 'post']) !!}
								  <div class="form-group">
								    <label for="dir_entrega">Direcci&oacute;n entrega</label>
								    <input type="text" class="form-control" id="dir_entrega"
								           placeholder="Introduce la direcci&oacute;n" name="dir_entrega" required>
								  </div>
								 <div class="form-group">
								    <label for="depto">Departamento</label>
								      <select class="form-control" id="depto" name="depto" required>
									  </select>
								  </div>
								  <div class="form-group">
								    <label for="mun">Municipio</label>
								      <select class="form-control" id="mun" name="mun" required>
									  </select>
								  </div>
								  <div class="form-group">
								    <label for="barrio">Barrio</label>
								    <input type="text" class="form-control" id="Barrio" 
								           placeholder="Barrio" name="barrio" required>
								  </div>
								  <div class="form-group">
								    <label for="tel_con">Tel&eacute;fono contacto</label>
								    <input type="number" class="form-control" id="tel_con"
								           placeholder="Introduce el tel&eacute;fono" name="tel_con" min="0" required pattern="[0-9]+">
								  </div>

								 <!--  <button type="submit" class="btn btn-success">Enviar</button> -->
							
		                </div>
	                </div>
	            </div>
	            <div class="col-md-8 col-xs-12 col-lg-4">
	            <div class="panel panel-default">
	                <div class="panel-heading"><h4>Forma de pago</h4></div>
		                <div class="panel-body">
		                
		                	
	  
							<div class="panel-group" id="accordion">
							  <div class="panel panel-default">
							    <div class="panel-heading">
							      <h4 class="panel-title">
							        <input name="forma-pago" id="consignacion" value="Consignacion" type="radio" checked="checked" data-toggle="collapse" data-parent="#accordion" data-target="#collapse1"/><span data-toggle="tooltip" data-placement="top" title="Este pago es permitido para cualquier ciudad de colombia, se incluiran cargos de envio de acuerdo al producto y peso, ademas recargo por consignaci&oacute;n desde otras plazas fuera de Bogot&aacute; igual a $10.000.oo COP">PAGO EN CONSIGNACI&oacute;N</span>
							      </h4>
							    </div>
							    <div id="collapse1" class="panel-collapse collapse in">
							      <div class="panel-body"><p>PUEDE REALIZAR CONSIGNACI&oacute;N EN LOS SIGUIENTES BANCOS:<br>		  
																		DAVIVIENDA:					  
																		Cta Ahorros	<br>					 
																		057000-6770210935                    	
																		NELSON REYES<br>
																		Nequi y DaviPlata: 3005672190                     </p></div>
							    </div>
							  </div>
							  <div class="panel panel-default">
							    <div class="panel-heading">
							      <h4 class="panel-title">
							        <input name="forma-pago" id="efectivo"  value="efectivo" type="radio" data-toggle="collapse" data-parent="#accordion" data-target="#collapse2"/><span data-toggle="tooltip" data-placement="top" title="Este pago aplica &uacute;nicamente para la ciudad de Bogot&aacute;">PAGO CONTRAENTREGA</span> 
							      </h4>
							    </div>
							    <div id="collapse2" class="panel-collapse collapse">
							      <div class="panel-body"><p>ASEGURESE DE DILIGENCIAR CORRECTAMENTE LOS DATOS DE ENTREGA Y TENER EL DINERO DISPONIBLE</p></div>
							    </div>
							  </div>
							  <div class="panel panel-default">
							    <div class="panel-heading">
							      <h4 class="panel-title">
							        <input name="forma-pago" id="Payu" value="Payu" type="radio" data-toggle="collapse" data-parent="#accordion" data-target="#collapse3"/><span data-toggle="tooltip" data-placement="top" title="Este pago es permitido &uacute;nicamente para montos de compra superiores a $30.000.oo pesos, la comisi&oacute;n de pago igual al 3.5% de total, 900 COP o $2.900 si es inferior y los cargos de env&iacute;o">Tarjeta y PSE</span>
							       </h4>
							    </div>
							    <div id="collapse3" class="panel-collapse collapse">
							      <div class="panel-body"><p>PAGO SEGURO CON TARJETA: 
																		<input type="image" src="{{  asset('images/payu.jpg') }}" border="0" name="" alt="Payu. La forma rápida y segura de pagar en Internet.">
																		<img alt="" border="0" width="1" height="1"><p></div>
							    </div>
							  </div>
							</div>
		                
		                
		                </div>
	                </div>
	            </div>
	            <div class="col-md-8 col-xs-12 col-sm-12 col-lg-4">
	            <div class="panel panel-default">
	                <div class="panel-heading"><h4>Confirma tu pedido</h4></div>
		                <div class="panel-body">
							<dl class="dl-horizontal">
							  <dt><h4><p class="text-success align-right">TOTAL:</p></h4></dt>
							  <dd><h4><p class="text-success" id="totalcart">${{number_format($totalct,0)}}</p></h4></dd>
							  <hr>
							  <dt><h4>Costos financieros:</h4></dt>
							  <dd><h4 id="totalcost">$0.00</h4></dd>
							  <hr>
							  <dt><h4>Gastos de envio:</h4></dt>
							  <dd><h4 id="totalenv">$0.00</h4></dd>
							  <hr>
							  <dt><h4><p class="text-danger">TOTAL A PAGAR:</p></h4></dt>
							  <dd><h4><p class="text-danger" id="totalpago">${{number_format($totalct,0)}}</p></h4></dd>
							</dl>
							<div class="form-group">

                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" required><a href="terminos"  target="_blank">Acepto t&eacute;rminos y condiciones</a> 
                                    </label>
                                </div>
                            </div>

							<button type="submit" class="btn btn-success">Confirmar</button>
						</div>           
	                </div>	            
	            </div>
	            {{ Form::hidden('totalct', $totalct, array('id' => 'totalct')) }}
	            {{ Form::hidden('totalcf', $totalcf, array('id' => 'totalcf')) }}
	            {{ Form::hidden('totalge', $totalge, array('id' => 'totalge')) }}
	            {{ Form::hidden('totaliv', $totaliv, array('id' => 'totaliv')) }}
	            {{ Form::hidden('totalpg', $totalpg, array('id' => 'totalpg')) }}
	            {!! Form::close() !!} 
        </div>
    </div>

  <script type="text/javascript">

  $(document).ready(function() {
	  $.ajax ({
	  type:'get',
	  url: "depto",
	  datatype: "json",
	  success: function(data) {
	  $.each(JSON.parse(data), function(i,obj){
	  $("#depto").append('<option id="' + i + '">' + obj.id +   
	  '</option>');
	        })
	       }
	     });
	  });

  </script>  
    
    
   <script type="text/javascript">

  $(document).ready(function() {
	  $("#depto").change(function(){
	  var depto = $( "#depto" ).val();
	  $.ajax ({
	  type:'get',
	  url: 'depto/' + depto,
	  datatype: "json",
	  success: function(data) {
		  $("#mun").empty();
		  $.each(JSON.parse(data), function(i,obj){
		  $("#mun").append('<option id="' + i + '">' + obj.nombre +   
		  '</option>');
		        })
		       }
		     });
		  });
	  });

  </script>
  
 <script type="text/javascript">

  $(document).ready(function() {
	  $("#depto").change(function(){
	  var depto = $( "#depto" ).val();
	  var total = $( "#totalct" ).val();

     if (depto == "BOGOTA" && total < 500000) 
     {
     	$("#efectivo").removeAttr("disabled");
	 }
     else
     {
    	 $("#efectivo").prop("disabled", "disabled");
    	 $("#consignacion").prop("checked", true);
     }
       
  	});
  });

  </script> 
  
   <script type="text/javascript">

  $(document).ready(function() {
		var total = $( "#totalct" ).val();
		if (total < 30) 
		{
			$("#Payu").prop("disabled", "disabled");
		}
  });

  </script> 
 
<script type="text/javascript">
  $(document).ready(function() {  
	  $("#depto").change(function(){
	    var consigna = $("input[name='forma-pago']:checked" ).val();
		//alert(consigna);
		var city = $("#depto").val();
		//alert(city);
		var total = parseFloat($( "#totalct" ).val());
		if (total > 1100000)
		{
			var envioct	= 0.00;
			var enviocb	= 0.00;
		}
		else
		{		
			var envioct	= 11000;
			var enviocb	= 5500;
		}
		if ((consigna == "Consignacion") && (city == 'BOGOTA' || city == 'Seleccionar'))
		{
			var consigc	= 0.00;
			var costfin	= total + consigc + enviocb;
			$("#totalcost").html('$' + consigc.toFixed(2));//alert(consigc);
			$("#totalenv").html('$' + enviocb);//alert(consigc);
			$("#totalpago").html('$' + costfin.toFixed(2));//alert(costfin);

			//change input value
			$("#totalcf").val(consigc);
			$("#totalge").val(enviocb);
			$("#totalpg").val(costfin);
	   
		}
		else
		{
			if (consigna == "Consignacion" && city != 'BOGOTA')
			{
				var consigc	= 12000;
				var costfin	= total + consigc + envioct;
				$("#totalcost").html('$' + consigc);
				$("#totalenv").html('$' + envioct);//alert(consigc);
				$("#totalpago").html('$' + costfin.toFixed(2));

				//change input value
				$("#totalcf").val(consigc);
				$("#totalge").val(envioct);
				$("#totalpg").val(costfin);
			}	
		}
	  });
  });
</script>  
  
<script type="text/javascript">
  $(document).ready(function() {  
	  $('input[type=radio][name=forma-pago]').change(function () {
	    var consigna = $("input[name='forma-pago']:checked" ).val();
		//alert(consigna);
		var city = $("#depto").val();
		//alert(city);
		var total = parseFloat($( "#totalct" ).val());
		if (total > 1100000)
		{
			var envioct	= 0.00;
			var enviocb	= 0.00;
		}
		else
		{
			var envioct	= 11000;
			var enviocb	= 5500;
		}
		if ((consigna == "Consignacion") && (city == 'BOGOTA' || city == 'Seleccionar'))
		{
			var consigc	= 0.00;
			var costfin	= total + consigc + enviocb;
			$("#totalcost").html('$' + consigc.toFixed(2));
			$("#totalenv").html('$' + enviocb);
			$("#totalpago").html('$' + costfin.toFixed(2));
			//change input value
			$("#totalcf").val(consigc);
			$("#totalge").val(enviocb);
			$("#totalpg").val(costfin);
	   
		}
		else
		{
			if (consigna == "Consignacion" && city != 'BOGOTA')
			{
				var consigc	= 12000;
				var costfin	= total + consigc + envioct;
				$("#totalcost").html('$' + consigc);
				$("#totalenv").html('$' + envioct);
				$("#totalpago").html('$' + costfin.toFixed(2));
				//change input value
				$("#totalcf").val(consigc);
				$("#totalge").val(envioct);
				$("#totalpg").val(costfin);
				
			}
		}

		if (consigna == "efectivo" && city == 'BOGOTA')
		{
			
			var costfin	= total + enviocb;
			$("#totalcost").html('$0.00');
			$("#totalenv").html('$' + enviocb);
			$("#totalpago").html('$' + costfin);
			//change input value
			$("#totalcf").val(0);
			$("#totalge").val(enviocb);
			$("#totalpg").val(costfin);
	   
		}
		else
		{
			if (consigna == "efectivo" && city != 'BOGOTA')
			{
				
				var costfin	= total + envioct;
				$("#totalcost").html('$0.00');
				$("#totalenv").html('$' + envioct);
				$("#totalpago").html('$' + costfin);
				//change input value
				$("#totalcf").val(12000);
				$("#totalge").val(envioct);
				$("#totalpg").val(costfin);
		   
			}
		}

		if (consigna == "Payu" && city == 'BOGOTA')
		{
			//var costpp	= (total * 0.035) + 900;
			var ivat	= (total - ((total*100)/119));
			var costpp	= (((total * 0.035) + 900) * 0.19) + ((total * 0.035) + 900) + ((total * 0.015) + (total * 0.00414));// + (ivat * 0.15));
			costpp		= Math.floor(costpp);
			if(costpp < 2901)
			{
				costpp = 2900;
			}
			var costppt	= total + costpp + enviocb;
			$("#totalcost").html('$' + costpp.toFixed(2));
			$("#totalenv").html('$' + enviocb);
			$("#totalpago").html('$' + costppt.toFixed(2));
			//change input value
			$("#totalcf").val(costpp);
			$("#totalge").val(enviocb);
			$("#totalpg").val(costppt);
	   
		}
		else
		{
			if (consigna == "Payu" && city != 'BOGOTA')
			{
				var ivat	= (total - ((total*100)/119));
				var costpp	= (((total * 0.035) + 900) * 0.19) + ((total * 0.035) + 900) + ((total * 0.015) + (total * 0.00414));// + (ivat * 0.15));
				costpp		= Math.floor(costpp);
				if(costpp < 2901)
				{
					costpp = 2900;
				}
				var costppt	= total + costpp + envioct;
				$("#totalcost").html('$' + costpp.toFixed(2));//alert(costpp);
				$("#totalenv").html('$' + envioct);//alert(consigc);
				$("#totalpago").html('$' + costppt.toFixed(2));//alert(costppt);

				//change input value
				$("#totalcf").val(costpp);
				$("#totalge").val(envioct);
				$("#totalpg").val(costppt);
			}
		}
	  });
  });
</script>   
  
    @includeIf('layouts.footer')
    </body>
</html>    