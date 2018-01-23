<!DOCTYPE html>
<html>
<head>
<title>Softecol</title>
@includeIf('layouts.header')
</head>
<body> 
   <!-- Inicio fotos de descuento -->
   @if( ! empty($producs[0]))
	  <div class="container"> 
			<div class="shoes-grid">
			
			<div class="wrap-in">
				<div class="wmuSlider example1 slide-grid">		 
				   <div class="wmuSliderWrapper">	
				   		@foreach ($producs as $produc)	  
						   <article style="position: absolute; width: 100%; opacity: 0;">					
							<div class="banner-matter">
							<div class="col-md-5 banner-bag">
							    @php 
                                	$imgpath = asset('../storage/app/PrdImages').'/'.$produc->id.'.jpg'
                                @endphp
								<img class="img-responsive " src="{{$imgpath}}" alt=" " />
								</div>
								<div class="col-md-7 banner-off">							
									<h2>Hasta 50% de descuento</h2>
									<label>EN COMPRAS <b>VALUE</b></label>
									<p>{{ $produc->Descripcion }}</p>					
									<a href="categoria/single/{{$produc->id}}" class="btn btn-primary btn-lg active" role="button">Comprar</a>
								</div>
								
								<div class="clearfix"> </div>
							</div>							
						 	</article>
						 	@break($loop->iteration > 3)
					 	@endforeach
						
					 </div>

	                <ul class="wmuSliderPagination">
	                	<li><a href="{{ $produc->id }}" class="">0</a></li>
	                	<li><a href="{{ $produc->id }}" class="">1</a></li>
	                	<li><a href="{{ $produc->id }}" class="">2</a></li>
	                </ul>
					 <script src="js/jquery.wmuSlider.js"></script> 
				  <script>
	       			$('.example1').wmuSlider();         
	   		     </script> 
	            </div>
	          </div>
	          
	          <!-- Fin fotos de descuento-->
	          
	           
	           <!-- inicio productos con descuent-->
	
	   		     <div class="products">
	   		     	<h5 class="latest-product">ULTIMOS PRODUCTOS</h5>	
	   		     	  <a class="view-all" href="product.html">VER TODOS<span> </span></a> 		     
	   		     </div>
	   		     
	   		     <div class="product-left"> 


 @foreach ($producs as $produc)	
 					@php 
                       	$imgpath = asset('../storage/app/PrdImages').'/'.$produc->id.'.jpg'
                    @endphp
	   		     	<div class="col-md-4 chain-grid grid-top-chain">
	   		     		<a href="categoria/single/{{ $produc->id }}"><img class="img-responsive chain" src="{{ $imgpath }}" alt=" " /></a>
	   		     		<span class="star"> </span>
	   		     		<div class="grid-chain-bottom">
	   		     			<h6><a href="categoria/single/{{ $produc->id }}">{{ $produc->Descripcion }}</a></h6>
	   		     			<div class="star-price">
	   		     				<div class="dolor-grid"> 
		   		     				<span class="actual">{{ $produc->precpu }}</span>
		   		     				
		   		     				  <span class="rating">
									        <input type="radio" class="rating-input" id="rating-input-1-5" name="rating-input-1">
									        <label for="rating-input-1-5" class="rating-star1"> </label>
									        <input type="radio" class="rating-input" id="rating-input-1-4" name="rating-input-1">
									        <label for="rating-input-1-4" class="rating-star1"> </label>
									        <input type="radio" class="rating-input" id="rating-input-1-3" name="rating-input-1">
									        <label for="rating-input-1-3" class="rating-star"> </label>
									        <input type="radio" class="rating-input" id="rating-input-1-2" name="rating-input-1">
									        <label for="rating-input-1-2" class="rating-star"> </label>
									        <input type="radio" class="rating-input" id="rating-input-1-1" name="rating-input-1">
									        <label for="rating-input-1-1" class="rating-star"> </label>
							    	   </span>
	   		     				</div>
	   		     				<a class="now-get get-cart" href="categoria/single/{{ $produc->id }}">COMPRAR</a> 
	   		     				<div class="clearfix"> </div>
							</div>
	   		     		</div>
	   		     	</div>
	   		    	@break($loop->iteration > 7)
	   		    	@if (($loop->iteration % 3) == 0)
					    <div class="clearfix visible-lg"> </div>
					@endif
				@endforeach
				<div class="clearfix"> </div>
			</div>
	     </div>
	   		    
	<div class="sub-cate">
		<div class=" top-nav rsidebar span_1_of_left">
			<h3 class="cate">CATEGORIAS</h3> 					
			 					
			 					
			<ul class="menu">
			@foreach ($lists as $list)
				<ul class="kid-menu">
						<li><a href="categoria/{{$list->id}}"> {{ $list->name }} </a></li>
				</ul>
			@endforeach	
			</ul>
		</div>
	</div>
</div>	 
@endif
<div class="clearfix"> </div>        	         

@includeIf('layouts.footer')
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
</body>
</html>
