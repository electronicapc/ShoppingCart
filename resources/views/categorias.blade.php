<!DOCTYPE html>
<html>
<head>
<title>Softecol</title>
@includeIf('layouts.header')
</head>
<body> 
	<!-- start content -->
	<div class="container">
	<div class="women-product">
		<div class=" w_content">
			<div class="women">
				<!-- <a href="#"><h4>Enthecwear - <span>4449 itemms</span> </h4></a> -->
				<ul class="w_nav">
					<li>Sort : </li>
			     	<li><a class="active" href="#">popular</a></li> |
			     	@php
			     		$expre = array("/\/asc/","/\/dsc/");
			     		$urlor = preg_replace($expre,'', url()->current());
			     	@endphp
			     	<li><a href="{{  $urlor }}/asc">price: Low </a></li> |
			     	<li><a href="{{  $urlor }}/dsc">price: High </a></li> 
			     <div class="clearfix"> </div>	
			     </ul>
			     <div class="clearfix"> </div>	
			</div>
		</div>
		<!-- grids_of_4 -->
		<div class="grid-product">
		@foreach ($categorias as $categorie)
		  <div class="  product-grid">
		    @php
			    $expre = array("/\/asc/","/\/dsc/" ,"/\/\d+/");
			    $urlpr = preg_replace($expre,'', url()->current());
			@endphp
			<div class="content_box"><a href="{{ $urlpr }}/single/{{ $categorie->id }}">
			   	<div class="left-grid-view grid-view-left">
			   	   	 <img src="{{  asset('images/pic13.jpg') }}" class="img-responsive watch-right" alt=""/>
				   	   	<div class="mask">
	                        <div class="info">Quick View</div>
			            </div>
				   	  </a>
				</div>
				    <h4><a href="#">{{ $categorie->name }}</a></h4>
				     <p>{{ $categorie->Descripcion }}</p>
					    @if ($categorie->iva === 'SI')
						    ${{ $categorie->precpu * (1 + ($categorie->ivap)/100) }}
						@else
						    ${{ $categorie->precpu}}
						@endif
				     
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