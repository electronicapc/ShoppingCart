<!DOCTYPE html>
<html>
<head>
<title>Softecol</title>
@includeIf('layouts.header')
<link rel="stylesheet" href="{{ asset('css/etalage.css') }}" type="text/css" media="all" />

<meta name="csrf-token" content="{{ csrf_token() }}">

<script src="{{ asset('js/jquery.etalage.min.js') }}"></script>
    <!--Scriot para llenar la cantidad en el carrito-->

	<body> 
    <div class="container">
    	<div class="row" style="margin-top:15px">
	        <div class="col-md-8 col-xs-12 col-lg-4">
	            <div class="panel panel-default">
	                <div class="panel-heading"><h4>Datos de Entrega</h4></div>
		                <div class="panel-body">
			                <form role="form">
								  <div class="form-group">
								    <label for="dir_entrega">Direcci&oacute;n entrega</label>
								    <input type="text" class="form-control" id="dir_entrega"
								           placeholder="Introduce la direcci&oacute;n" required>
								  </div>
								 <div class="form-group">
								    <label for="depto">Departamento</label>
								      <select class="form-control" id="depto">
									  </select>
								  </div>
								  <div class="form-group">
								    <label for="mun">Municipio</label>
								      <select class="form-control" id="mun">
									  </select>
								  </div>
								  <div class="form-group">
								    <label for="barrio">Barrio</label>
								    <input type="text" class="form-control" id="Barrio" 
								           placeholder="Barrio" required>
								  </div>
								  <div class="form-group">
								    <label for="tel_con">Tel&eacute;fono contacto</label>
								    <input type="number" class="form-control" id="tel_con"
								           placeholder="Introduce el tel&eacute;fono" min="0" required pattern="[0-9]+">
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
							        <input name="forma-pago" id="consignacion" type="radio" checked="checked" data-toggle="collapse" data-parent="#accordion" data-target="#collapse1"/><span data-toggle="tooltip" data-placement="top" title="Este pago es permitido para cualquier ciudad de colombia, se incluiran cargos de envio de acuerdo al producto y peso, ademas recargo por consignaci&oacute;n desde otras plazas fuera de Bogot&aacute; igual a $10.000.oo COP">PAGO EN CONSIGNACI&oacute;N</span>
							      </h4>
							    </div>
							    <div id="collapse1" class="panel-collapse collapse in">
							      <div class="panel-body"><p>PUEDE REALIZAR CONSIGNACI&oacute;N EN LOS SIGUIENTES BANCOS:		  
																		BANCOLOMBIA:					  
																		Cta Ahorros						 
																		042-06735-401                    	
																		NELSON REYES                      </p></div>
							    </div>
							  </div>
							  <div class="panel panel-default">
							    <div class="panel-heading">
							      <h4 class="panel-title">
							        <input name="forma-pago" id="efectivo" type="radio" data-toggle="collapse" data-parent="#accordion" data-target="#collapse2"/><span data-toggle="tooltip" data-placement="top" title="Este pago aplica &uacute;nicamente para la ciudad de Bogot&aacute;">PAGO CONTRAENTREGA</span> 
							      </h4>
							    </div>
							    <div id="collapse2" class="panel-collapse collapse">
							      <div class="panel-body"><p>ASEGURESE DE DILIGENCIAR CORRECTAMENTE LOS DATOS DE ENTREGA Y TENER EL DINERO DISPONIBLE</p></div>
							    </div>
							  </div>
							  <div class="panel panel-default">
							    <div class="panel-heading">
							      <h4 class="panel-title">
							        <input name="forma-pago" id="paypal" type="radio" data-toggle="collapse" data-parent="#accordion" data-target="#collapse3"/><span data-toggle="tooltip" data-placement="top" title="Este pago es permitido &uacute;nicamente para montos de compra superiores a $50.000.oo pesos, se liquidara haciendo conversi&oacute;n a dolares USD, la comisi&oacute;n de pago igual al 4% de total, 900 COP  y los cargos de env&iacute;o">PAY-U</span>
							       </h4>
							    </div>
							    <div id="collapse3" class="panel-collapse collapse">
							      <div class="panel-body"><p>PAGO SEGURO CON TARJETA: 
																		<input type="image" src="{{  asset('images/payu.jpg') }}" border="0" name="" alt="PayPal. La forma rápida y segura de pagar en Internet.">
																		<img alt="" border="0" width="1" height="1"><p></div>
							    </div>
							  </div>
							</div>
		                
		                
		                </div>
	                </div>
	            </div>
	            <div class="col-md-8 col-xs-12 col-lg-4">
	            <div class="panel panel-default">
	                <div class="panel-heading"><h4>Confirma tu pedido</h4></div>
		                <div class="panel-body">
		                	<button type="submit" class="btn btn-success">Confirmar</button>
		                </div>		            
	                </div>	            
	            </div>
	            </form>
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
     if (depto == "DE") 
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
     
    
    @includeIf('layouts.footer')
    </body>
</html>    