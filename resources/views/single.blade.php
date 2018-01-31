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
@php 
  	$imgpath  = asset('../storage/app/PrdImages').'/'.$productos->id.'.jpg';
  	$imgpath2 = asset('../storage/app/PrdImages').'/'.$productos->id.'_2.jpg'; 
  	$imgpath3 = asset('../storage/app/PrdImages').'/'.$productos->id.'_3.jpg'
@endphp
	 <div class="container"> 
	 	<div class=" single_top">
	      <div class="">
				<div class="grid images_3_of_2">
						<ul id="etalage">
							<li>
								<a href="#">
									<img class="etalage_thumb_image" src="{{ $imgpath }}" class="img-responsive" />
									<img class="etalage_source_image" src="{{ $imgpath }}" class="img-responsive" title="" />
								</a>
							</li>
							<li>   
							    <img class="etalage_thumb_image" src="{{ $imgpath }}" class="img-responsive" />
								<img class="etalage_source_image" src="{{ $imgpath }}" class="img-responsive" title="" />
							      
							</li>
							<li>
								@if(file_exists(storage_path('app/PrdImages/'.$productos->id.'_2.jpg')))
									<img class="etalage_thumb_image" src="{{ $imgpath2 }}" class="img-responsive"  />
									<img class="etalage_source_image" src="{{ $imgpath2 }}"class="img-responsive"  />
								@else
									<img class="etalage_thumb_image" src="{{ $imgpath }}" class="img-responsive"  />
									<img class="etalage_source_image" src="{{ $imgpath }}"class="img-responsive"  />								
								@endif
							</li>
						    <li>
						    	@if(file_exists(storage_path('app/PrdImages/'.$productos->id.'_3.jpg')))
						       		<img class="etalage_thumb_image" src="{{ $imgpath3 }}" class="img-responsive" />
									<img class="etalage_source_image" src="{{ $imgpath3 }}" class="img-responsive" title="" />
							    @else
							    	<img class="etalage_thumb_image" src="{{ $imgpath }}" class="img-responsive"  />
									<img class="etalage_source_image" src="{{ $imgpath }}"class="img-responsive"  />						    
							    @endif
							</li>
						</ul>
						 <div class="clearfix"> </div>		
				  </div> 
				  <div class="desc1 span_3_of_2">
				  
					
					<h4>{{$productos->name}}</h4>
				<div class="cart-b">
				{!! Form::open(['url' => 'checkout'], ['method' => 'post'], ['class' => 'form-inline'], ['role'=> 'form'] ) !!}
					
						<div class="form-group">
					 		<div class="left-n ">
					 			@if ($productos->iva === 'SI')
						    		${{ $productos->precpu * (1 + ($productos->ivap)/100) }}
								@else
								    ${{ $productos->precpu}}
								@endif

					 		</div>
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
			   	<p>{{ $productos->ReferenciaOEM }}</p>
			   	<div class="share">
							<h5>Compartir producto :</h5>
							<ul class="share_nav">
								<li><a href="https://www.facebook.com/sharer.php?u=http://www.softecol.com/public/categoria/single/{{ $productos->id }}"><img src="{{asset('images/facebook.png')}}" title="facebook"></a></li>
								<li><a href="https://plus.google.com/share?url=http://www.softecol.com/public/categoria/single/{{ $productos->id }}"><img src="{{asset('images/gpluse.png')}}" title="Google+"></a></li>
				    		</ul>
						</div>
			   
				
				</div>
          	    <div class="clearfix"> </div>
          	   </div>
          	  <ul id="flexiselDemo1">
          	  @foreach($lists as $categ)
          	    @php 
                   $imgpath = asset('../storage/app/CatImages').'/'.$categ->id.'.jpg'
                @endphp
				<li><img src="{{ $imgpath }}" /><div class="grid-flex"><a href="../../categoria/{{ $categ->id}}">{{ $categ->name}}</a></div></li>
			  @endforeach	
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
				     	<h3 class="m_3">Detalles del Producto</h3>
				     	<p class="m_text">{!! $productos->DescripcionS or $productos->Descripcion !!}</p>
				     </div>	
          	   </div>
          	   
          	   <!---->
	<div class="sub-cate">
				<div class=" top-nav rsidebar span_1_of_left">
					<h3 class="cate">CATEGORIAS</h3>
			<ul class="menu">
			@foreach ($lists as $list)
				<ul class="kid-menu">
						<li><a href="../{{ $list->id }}"> {{ $list->name }} </a></li>
				</ul>
			@endforeach	
			</ul>
					</div>

	   		     	 <a class="view-all all-product" href="product.html">VER TODOS<span> </span></a> 	
			</div>
<div class="clearfix"> </div>			
		</div>
	<!---->
@includeIf('layouts.footer')
</body>
</html>