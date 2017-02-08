<!DOCTYPE html>
<html>
<head>
<title>Softecol</title>

</head>
<body> 

@includeIf('layouts.header')
   <!-- Inicio fotos de descuento -->
	  <div class="container"> 
			<div class="shoes-grid">
			<a href="single.html">
			<div class="wrap-in">
				<div class="wmuSlider example1 slide-grid">		 
				   <div class="wmuSliderWrapper">	
				   		@foreach ($producs as $produc)	  
						   <article style="position: absolute; width: 100%; opacity: 0;">					
							<div class="banner-matter">
							<div class="col-md-5 banner-bag">
								<img class="img-responsive " src="images/bag.jpg" alt=" " />
								</div>
								<div class="col-md-7 banner-off">							
									<h2>Hasta 50% de descuento</h2>
									<label>EN COMPRAS <b>VALUE</b></label>
									<p>{{ $produc->Descripcion }}</p>					
									<span class="on-get">COMPRAR</span>
								</div>
								
								<div class="clearfix"> </div>
							</div>							
						 	</article>
						 	@break($loop->iteration > 3)
					 	@endforeach
						
					 </div>
					 </a>
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
	   		     	<h5 class="latest-product">LATEST PRODUCTS</h5>	
	   		     	  <a class="view-all" href="product.html">VIEW ALL<span> </span></a> 		     
	   		     </div>
	   		     
	   		     <div class="product-left"> 


 @foreach ($producs as $produc)	
	   		     	<div class="col-md-4 chain-grid grid-top-chain">
	   		     		<a href="single.html"><img class="img-responsive chain" src="images/baa.jpg" alt=" " /></a>
	   		     		<span class="star"> </span>
	   		     		<div class="grid-chain-bottom">
	   		     			<h6><a href="single.html">{{ $produc->Descripcion }}</a></h6>
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
	   		     				<a class="now-get get-cart" href="{{ $produc->id }}">ACARRITO</a> 
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
			<h3 class="cate">CATEGORIES</h3> 					
			 					
			 					
			<ul class="menu">
			@foreach ($lists as $list)
				<ul class="kid-menu">
						<li><a href="categoria/{{ $list->id }}"> {{ $list->name }} </a></li>
				</ul>
			@endforeach	
			</ul>
		</div>
	</div> 



	   <div class="clearfix"> </div>        	         

@includeIf('layouts.footer')	
</body>
</html>
