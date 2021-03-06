{{-- @section('header') --}} 
	@php
		$data = Session::get('cart');
		$total = count($data);
	@endphp
	<!--header-->
	<div class="header">
		<div class="top-header" id="headersop">
			<div class="container">
				<div class="top-header-left">
					<ul class="support">
						<li><a href="#"><label> </label></a></li>
						<li><a href="#">Soporte <span class="live">8x5 en vivo</span></a></li>
					</ul>
					<ul class="support">
						<li class="van"><a href="#"><label> </label></a></li>
						<li><a href="#">Entrega gratis<span class="live"> compras mayores a $ 1.100.000 COP</span></a></li>
					</ul>
					<div class="clearfix"> </div>
				</div>
				<div class="top-header-right">
				 <div class="down-top">		
						  <select class="in-drop">
							  <option value="English" class="in-of">Espa&ntilde;ol</option>
							 <!--  <option value="Japanese" class="in-of">Japanese</option>
							  <option value="French" class="in-of">French</option>
							  <option value="German" class="in-of">German</option>-->
							</select>
					 </div>
					<div class="down-top top-down">
						  <select class="in-drop">						  
						  <option value="Dollar" class="in-of">Pesos</option>
						 <!--  <option value="Yen" class="in-of">Yen</option>
						  <option value="Euro" class="in-of">Euro</option> -->
							</select>
					 </div>
					 <!---->
					<div class="clearfix"> </div>	
				</div>
				<div class="clearfix"> </div>		
			</div>
		</div>
		<div class="bottom-header">
			<div class="container">
				<div class="header-bottom-left">
					<div class="logo">
						<a href="{{asset('/') }}"><img src="{{asset('images/logo.png') }}" alt="Softecol, tecnologias de vanguardia, hardware y software" id="mylogo"/></a>
					</div>
					<!-- <div class="search">
						<input type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}" >
						<input type="submit"  value="SEARCH">

					</div> -->
					
				</div>
				<div class="header-bottom-right">	
					@if (Auth::guest())				
						<div class="account"><a href="{{ url('/login') }}"><span> </span>TU CUENTA</a></div>
							<ul class="login">
								<li><a href="{{ url('/login') }}"><span> </span>INGRESAR</a></li><span id="pipe"> |</span> 
								<li ><a href="{{ url('/register') }}">REGISTRATE</a></li>
							</ul>
					@else

						   <div class="dropdown account">
						        <a href="#" data-toggle="dropdown" class="dropdown-toggle"><span></span>{{ Auth::user()->name }}<b class="caret"></b></a>
						        <ul class="dropdown-menu">
						         @if (Auth::user()->isAdmin == 'SI')
						            <li><a href="{{ url('/admin') }}">Administrar</a></li>
						       	 @endif
						            <li><a href="{{ url('/logout') }}">Salir</a></li>
						        </ul>
				   		 </div>
						  
                  @endif		
						<div class="cart"><a href="{{ url('/checkout') }}"><span></span></a>@if($total > 0) <span class="badge badge-success" style="background-color: green"> {{ $total }} </span>@endif</div>
					
				</div>
					
			</div>
		</div>
	</div>
	
<!--Librerias bootstrap y Jquery-->	
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<!-- Fin Librerias bootstrap y Jquery-->	

<!--theme-style propios de la app-->
<link href="{{  asset('css/style.css') }}" rel="stylesheet" type="text/css" media="all" />	
<!--//theme-style-->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!--Fin Librerias propias -->
    <style>
        @media screen and (min-width: 760px) {
			  #mylogo {
			    height: 100px;
			  }
	  
			  #whatsappcall{
			  	display: none;
			  }
		  }
		  @media (max-width:640px) and (min-width:100px){
			  #mylogo {
			    height: 50px;

			  }
		 }		  
	</style> 
<!--Fin estilo logo -->
@show