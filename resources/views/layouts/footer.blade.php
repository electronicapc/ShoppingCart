	<!---->
	<div class="footer">
		<div class="footer-top">			
			<div class="container">
				<div class="row">
					<div class="latter col-xs-6">					
						<div class="sub-left-right">
							<form action="{{ asset('/suscribir')}}" method="post">
								<input type="text" value="Ingrese Email" name="suscript" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Ingrese Email';}" />
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<input type="submit" value="SUSCRIBIRSE" />
							</form>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="latter-right">
						<p>SIGUENOS</p>
						<ul class="face-in-to">
							<li><a href="https://www.facebook.com/Softecolsoftwareyhardware/" target="_blank"><span> </span></a></li>
							<li><a href="https://www.facebook.com/Softecolsoftwareyhardware/" target="_blank"><span class="facebook-in"> </span></a></li>
							<div class="clearfix"> </div>
						</ul>
						<div class="clearfix"> </div>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>	
		</div>
		<div class="footer-bottom">
			<div class="container">
				<div class="footer-bottom-cate">
					<h6>CATEGORIAS</h6>
					<ul>
					 <li><a href="{{ asset('categoria/1')}}">Computadores</a></li>
						<li><a href="{{ asset('categoria/2')}}">Smartphones</a></li>
						<li><a href="{{ asset('categoria/3')}}">Copiadoras</a></li>
						<li ><a href="{{ asset('categoria/4')}}">Impresoras</a></li>
						<li ><a href="{{ asset('categoria/5')}}">Redes</a></li>
					</ul>
				</div>
				<div class="footer-bottom-cate bottom-grid-cat">
					<h6>PRODUCTOS MAS COMPRADOS</h6>
					<ul>
						<li><a href="{{ asset('categoria/2')}}">Celular Samsung S8+</a></li>
						<li><a href="{{ asset('categoria/3')}}">Copiadora Sharp 2041</a></li>
						<li><a href="{{ asset('categoria/3')}}">Celular Xiaomi Redmi Note 4</a></li>
					</ul>
				</div>
				<div class="footer-bottom-cate">
					<h6>MARCAS ELEGIDAS</h6>
					<ul>
						<li><a href="{{ asset('categoria/3')}}">Copiadoras Sharp</a></li>
						<li><a href="{{ asset('categoria/2')}}">Celular Xiaomi</a></li>
						<li><a href="{{ asset('categoria/2')}}">Celular Samsumg</a></li>
						<li><a href="{{ asset('categoria/1')}}">Port&aacute;til Lenovo</a></li>
					</ul>
				</div>
				<div class="footer-bottom-cate cate-bottom">
					<h6>Nuestra direcci&oacute;n</h6>
					<ul>
						<li>Dg 2B No 82 - 40</li>
						<li>Bogot&aacute;, Colombia</li>
						<li class="phone"><a href="tel:3005672190"><img src="{{ asset('images/phone.png') }}" width="50" height="50"></a></li>
						<li class="temp"> <p class="footer-class">En colaboraci&oacute;n con W3layouts </p></li>
					</ul>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
	var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
	(function(){
	var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
	s1.async=true;
	s1.src='https://embed.tawk.to/592837c2b3d02e11ecc66fa0/default';
	s1.charset='UTF-8';
	s1.setAttribute('crossorigin','*');
	s0.parentNode.insertBefore(s1,s0);
	})();
</script>
<!--End of Tawk.to Script-->