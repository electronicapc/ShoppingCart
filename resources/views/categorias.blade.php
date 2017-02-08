<!DOCTYPE html>
<html>
<head>
<title>Softecol</title>

</head>
<body> 
@includeIf('layouts.header')


	<!-- start content -->
	<div class="container">
		
	<div class="women-product">
		<div class=" w_content">
			<div class="women">
				<a href="#"><h4>Enthecwear - <span>4449 itemms</span> </h4></a>
				<ul class="w_nav">
					<li>Sort : </li>
			     	<li><a class="active" href="#">popular</a></li> |
			     	<li><a href="#">new </a></li> |
			     	<li><a href="#">discount</a></li> |
			     	<li><a href="#">price: Low High </a></li> 
			     <div class="clearfix"> </div>	
			     </ul>
			     <div class="clearfix"> </div>	
			</div>
		</div>
		<!-- grids_of_4 -->
		<div class="grid-product">
		@foreach ($categorias as $categorie)
		  <div class="  product-grid">
			<div class="content_box"><a href="single.html">
			   	<div class="left-grid-view grid-view-left">
			   	   	 <img src="{{  asset('images/pic13.jpg') }}" class="img-responsive watch-right" alt=""/>
				   	   	<div class="mask">
	                        <div class="info">Quick View</div>
			            </div>
				   	  </a>
				</div>
				    <h4><a href="#">{{ $categorie->name }}</a></h4>
				     <p>{{ $categorie->Descripcion }}</p>
				     {{ $categorie->precpu }}
			   	</div>
              </div>
              
        	@if (($loop->iteration % 3) == 0)
			   <div class="clearfix visible-lg"> </div>
			@endif
		@endforeach    
              
			{{ $categorias->links() }}
			<div class="clearfix"> </div>
		</div>
	</div>
	
	
	
	<div class="sub-cate">
				<div class=" top-nav rsidebar span_1_of_left">
					<h3 class="cate">CATEGORIES</h3>
			<ul class="menu">
			@foreach ($lists as $list)
				<ul class="kid-menu">
						<li><a href="{{ $list->id }}"> {{ $list->name }} </a></li>
				</ul>
			@endforeach	
			</ul>
					</div>

	   		     	 <a class="view-all all-product" href="product.html">VIEW ALL PRODUCTS<span> </span></a> 	
			</div>
	<div class="clearfix"> </div>
</div>

























































@includeIf('layouts.footer')	
</body>
</html>