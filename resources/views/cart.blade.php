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
<body> 

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
		                        <td class="col-sm-1 col-md-1 text-center"></td>
		                        <td class="col-sm-1 col-md-1 text-center">{{ $value['cantidad'] }}</td>
		                        <td class="col-sm-1 col-md-1 text-center"><strong>${{ $value['precio'] }}</strong></td>
		                        <td class="col-sm-1 col-md-1">
		                            <a href="/removeItem/{{ $key }}"> <button type="button" class="btn btn-danger">
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
                    <td class="text-right"><h3><strong>${{$total}}</strong></h3></td>
                </tr>
                <tr>
                    <td>   </td>
                    <td>   </td>
                    <td>   </td>
                    <td>
                        <a href="/"> <button type="button" class="btn btn-default">
                                <span class="fa fa-shopping-cart"></span> Continuar comprando
                            </button>
                        </a></td>
                    <td>
                        <button type="button" class="btn btn-success">
                            Comprar <span class="fa fa-play"></span>
                        </button></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    @includeIf('layouts.footer')
</body>
</html>-