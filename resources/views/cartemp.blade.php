
@php
	$data 	= Session::get('cart');
	$totalc = count($data);
	$total 	= 0;
	
@endphp
<div class="container">
	<div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1 table-responsive">
            <table class="table table-hover" style="width: auto">
                <thead>
                <tr class="table-active">
                    <th>Producto</th>
                    <th id="idtd"></th>
                    <th class="text-center">Cantidad</th>
                    <th class="text-center">Total U.</th>
                    <th class="text-center"></th>
                    
                </tr>
                </thead>
                <tbody>

                @if($totalc > 0)
	                @foreach($data as $key => $value)
	    				@php 
                    		$imgpath = '../storage/app/PrdImages/'.$key.'.jpg' ;
                    		$hrefe	 = 'categoria/single/'.$key                            			
                		@endphp     
			                    <tr>
			                        <td>
		                                <a class="thumbnail pull-left" href="{{ $hrefe }}"> <img class="media-object" src="{{ $imgpath }}" id="imgcart""> </a>
		                                <div class="media-body">
		                                    <h4 class="media-heading"><a href="{{ $hrefe }}">{{ $value['descripcion'] }}</a></h4>
			                            </div>		                            
			                          </td>
			                        <td id="idtd"></td>
			                        <td class="text-center">          
				                        	<select id="cantidad" name="cantidad" class="input-sm">
								             	@for ($i = 1; $i < $value['existencia'] + 1; $i++)
								             		@if($i == $value['cantidad'])
			    										<option value="{{ $key }}" selected="selected">{{ $i }}</option>
			    									@else
			    										<option value="{{ $key }}">{{ $i }}</option>	
			    									@endif	
												@endfor					                
							            	</select>
						            </td>
			                        <td class="text-center"><strong>${{ number_format($value['precio'] * $value['iva'],0)}}</strong></td>
			                        <td>
			                            <a href="checkout/{{ $key }}">
			                                    <span class="glyphicon glyphicon-remove-circle" style="font-size: 30px;color: red;"></span>
			                               
			                            </a>
			                        </td>
			                    </tr>
			                    @php
			                    	$total = ($value['cantidad']*$value['precio']*$value['iva']) + $total;
			                    @endphp
					@endforeach
 				@else
 					 <tr>
 					 	<div class="alert alert-danger">Opsss El carrito esta vacio, te invitamos a llenarlo con excelentes productos</div>
 					 </tr>
 				
 				@endif
                <tr>
                    <td id="idtd"></td>
                    <td id="idtd"></td>
                    <td id="idtd"></td>
                    <td><h3>Total</h3></td>
                    <td class="text-right"><h3><strong><div id="totalc">${{number_format($total,0)}}</div></strong></h3></td>
                </tr>
                <tr>
                    <td id="idtd"></td>
                    <td id="idtd"></td>
                    <td id="idtd"></td>
                    <td>
                        <a href="{{ url('/') }}"> <button type="button" class="btn btn-default">
                                <span class="fa fa-shopping-cart"></span> Continuar comprando
                            </button>
                        </a>
                    </td>
                    <td>
                    {!! Form::open(['url' => 'pago']) !!}
                    	 @if($totalc > 0)
	                        <button type="submit" class="btn btn-success">
	                            Comprar <span class="fa fa-play"></span>
	                        </button></td>
	                     @else
	                     	<button type="submit" disabled="disabled" class="btn btn-success disabled">
	                            Comprar <span class="fa fa-play"></span>
	                        </button></td>
	                     @endif   
                    {!! Form::close() !!}    
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>    