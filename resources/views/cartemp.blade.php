
@php
	$data = Session::get('cart');
	
	$total = 0;
	
@endphp

<div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Product</th>
                    <th></th>
                    <th class="text-center"></th>
                    <th class="text-center">Cantidad</th>
                    <th class="text-center">Total</th>
                    <th> </th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $key => $value)
    				           
		                    <tr>
		                        <td class="col-sm-8 col-md-6">
		                            <div class="media">
		                                <a class="thumbnail pull-left" href="#"> <img class="media-object" src="{{-- $item->product->imageurl --}}" style="width: 100px; height: 72px;"> </a>
		                                <div class="media-body">
		                                    <h4 class="media-heading"><a href="#">{{ $value['descripcion'] }}</a></h4>
			                            </div>
		                            </div></td>
		                        <td class="col-sm-1 col-md-1" style="text-align: center">
		                        </td>
		                        <td class="col-sm-1 col-md-1 text-center">	                        
			                        	<select id="cantidad" name="cantidad" class="form-control input-sm">
							             	@for ($i = 1; $i < $value['existencia'] + 1; $i++)
							             		@if($i == $value['cantidad'])
		    										<option selected="selected">{{ $i }}</option>
		    									@else
		    										<option value="{{ $key }}">{{ $i }}</option>	
		    									@endif	
											@endfor					                
						            	</select>
						            	
					            </td>
		                        <td class="col-sm-1 col-md-1 text-center"><strong>${{ $value['precio'] }}</strong></td>
		                        <td class="col-sm-1 col-md-1">
		                            <a href="checkout/{{ $key }}"> <button type="button" class="btn btn-danger">
		                                    <span class="fa fa-remove"></span> Remove
		                                </button>
		                            </a>
		                        </td>
		                    </tr>
		                    @php
		                    	$total = ($value['cantidad']*$value['precio']) + $total;
		                    @endphp
			@endforeach
 				
                <tr>
                    <td>   </td>
                    <td>   </td>
                    <td>   </td>
                    <td><h3>Total</h3></td>
                    <td class="text-right"><h3><strong><div id="totalc">${{$total}}</div></strong></h3></td>
                </tr>
                <tr>
                    <td>   </td>
                    <td>   </td>
                    <td>   </td>
                    <td>
                        <a href="{{ url('/') }}"> <button type="button" class="btn btn-default">
                                <span class="fa fa-shopping-cart"></span> Continuar comprando
                            </button>
                        </a></td>
                    <td>
                    {!! Form::open(['url' => 'foo/bar']) !!}
                        <button type="submit" class="btn btn-success">
                            Comprar <span class="fa fa-play"></span>
                        </button></td>
                    {!! Form::close() !!}    
                </tr>
                </tbody>
            </table>
        </div>
    </div>