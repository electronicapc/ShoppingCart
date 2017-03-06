<!--A Design by W3layouts 
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<title>Softecol</title>

@includeIf('layouts.header')
<link rel="stylesheet" href="{{ asset('css/etalage.css') }}" type="text/css" media="all" />
<!--//theme-style-->
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--fonts-->

<script src="{{ asset('js/jquery.etalage.min.js') }}"></script>
<script>
			jQuery(document).ready(function($){

				$('#etalage').etalage({
					thumb_image_width: 300,
					thumb_image_height: 400,
					source_image_width: 900,
					source_image_height: 1200,
					show_hint: true,
					click_callback: function(image_anchor, instance_id){
						alert('Callback example:\nYou clicked on an image with the anchor: "'+image_anchor+'"\n(in Etalage instance: "'+instance_id+'")');
					}
				});

			});
</script>

</head>

<body> 
	 <div class="container"> 

	 	<div class=" single_top">
	      <div class="">
				<div class="grid images_3_of_2">
						<ul id="etalage">
							<li>
								<a href="optionallink.html">
									<img class="etalage_thumb_image" src="{{ asset('images/s4.jpg') }}" class="img-responsive" />
									<img class="etalage_source_image" src="{{ asset('images/s4.jpg') }}" class="img-responsive" title="" />
								</a>
							</li>
							<li>
								<img class="etalage_thumb_image" src="{{ asset('images/s4.jpg') }}" class="img-responsive" />
								<img class="etalage_source_image" src="images/si2.jpg" class="img-responsive" title="" />
							</li>
							<li>
								<img class="etalage_thumb_image" src="{{ asset('images/s4.jpg') }}" class="img-responsive"  />
								<img class="etalage_source_image" src="images/si3.jpg"class="img-responsive"  />
							</li>
						    <li>
								<img class="etalage_thumb_image" src="{{ asset('images/s4.jpg') }}" class="img-responsive"  />
								<img class="etalage_source_image" src="{{ asset('images/s4.jpg') }}"class="img-responsive"  />
							</li>
						</ul>
						 <div class="clearfix"> </div>		
				  </div> 
				  <div class="desc1 span_3_of_2">
				  
					
					<h4>Lorem ipsum dolor sit amet, consectetur adipisicing elit</h4>
				<div class="cart-b">
				{!! Form::open(['url' => 'checkout'], ['method' => 'post'], ['class' => 'form-inline'], ['role'=> 'form'] ) !!}
					
						<div class="form-group">
					 		<div class="left-n ">${{ $productos->precpu }}</div>
						 </div>
						  <div class="form-group">
						  <!--    <label for="cantidad" >Cantidad :</label>
						    <input type="number" value="1" id="cantidad" class="form-control" onkeydown="return false" min="1" max="20" style="width: 65px;">  -->
						   
					        <div class="col-xs-3">
					           <label for="cantidad" >Cant:</label>
					           <select id="cantidad" name="cantidad" class="form-control">
					             	@for ($i = 1; $i < $productos->cantidadex +1; $i++)
    									<option>{{ $i }}</option>
									@endfor
					                
					            </select> 
					        </div>
							{{ Form::hidden('id_prod', $productos->id) }}
							{{ Form::hidden('pre_pu', $productos->precpu) }}
						  </div>
						<div class="form-group">
					    	<input type="submit" class="btn btn-primary" value="Comprar">
					    </div>

				
				{!! Form::close() !!}
				<div class="clearfix"></div>
				 </div>
				 
				 <h6>{{ $productos->cantidadex }} productos en existencia</h6>
			   	<p>{{ $productos->Descripcion }}</p>
			   	<div class="share">
							<h5>Share Product :</h5>
							<ul class="share_nav">
								<li><a href="#"><img src="images/facebook.png" title="facebook"></a></li>
								<li><a href="#"><img src="images/twitter.png" title="Twiiter"></a></li>
								<li><a href="#"><img src="images/rss.png" title="Rss"></a></li>
								<li><a href="#"><img src="images/gpluse.png" title="Google+"></a></li>
				    		</ul>
						</div>
			   
				
				</div>
          	    <div class="clearfix"> </div>
          	   </div>
          	   <ul id="flexiselDemo1">
			<li><img src="images/pi.jpg" /><div class="grid-flex"><a href="#">Bloch</a><p>Rs 850</p></div></li>
			<li><img src="images/pi1.jpg" /><div class="grid-flex"><a href="#">Capzio</a><p>Rs 850</p></div></li>
			<li><img src="images/pi2.jpg" /><div class="grid-flex"><a href="#">Zumba</a><p>Rs 850</p></div></li>
			<li><img src="images/pi3.jpg" /><div class="grid-flex"><a href="#">Bloch</a><p>Rs 850</p></div></li>
			<li><img src="images/pi4.jpg" /><div class="grid-flex"><a href="#">Capzio</a><p>Rs 850</p></div></li>
		 </ul>
	    <script type="text/javascript">
		 $(window).load(function() {
			$("#flexiselDemo1").flexisel({
				visibleItems: 5,
				animationSpeed: 1000,
				autoPlay: true,
				autoPlaySpeed: 3000,    		
				pauseOnHover: true,
				enableResponsiveBreakpoints: true,
		    	responsiveBreakpoints: { 
		    		portrait: { 
		    			changePoint:480,
		    			visibleItems: 1
		    		}, 
		    		landscape: { 
		    			changePoint:640,
		    			visibleItems: 2
		    		},
		    		tablet: { 
		    			changePoint:768,
		    			visibleItems: 3
		    		}
		    	}
		    });
		    
		});
	</script>
	<script type="text/javascript" src="{{ asset('js/jquery.flexisel.js') }}"></script>

          	    	<div class="toogle">
				     	<h3 class="m_3">Product Details</h3>
				     	<p class="m_text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum.</p>
				     </div>	
          	   </div>
          	   
          	   <!---->
	<div class="sub-cate">
				<div class=" top-nav rsidebar span_1_of_left">
					<h3 class="cate">CATEGORIES</h3>
			<ul class="menu">
			@foreach ($lists as $list)
				<ul class="kid-menu">
						<li><a href="../{{ $list->id }}"> {{ $list->name }} </a></li>
				</ul>
			@endforeach	
			</ul>
					</div>

	   		     	 <a class="view-all all-product" href="product.html">VIEW ALL PRODUCTS<span> </span></a> 	
			</div>
<div class="clearfix"> </div>			
		</div>
	<!---->
@includeIf('layouts.footer')
</body>
</html>