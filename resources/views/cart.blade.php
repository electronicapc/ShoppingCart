<!DOCTYPE html>
<html>
<head>
<title>Softecol</title>

	@includeIf('layouts.header')

<link rel="stylesheet" href="{{ asset('css/etalage.css') }}" type="text/css" media="all" />

<meta name="csrf-token" content="{{ csrf_token() }}">

<script src="{{ asset('js/jquery.etalage.min.js') }}"></script>
    <!--Scriot para llenar la cantidad en el carrito-->
</head>
<body> 
	@includeIf('cartemp')
    @includeIf('layouts.footer')

<script>
    $(document).ready(function(){
	
	$( "select" ).change(function (){
		var idt = $(this).val();
		var nca = $(this).find('option:selected').text();
		/*alert(idt);
		alert(nca);
		alert("Url  ="+document.location);*/
		$.ajax({
			type:'post',
			url:'checkout/' + idt + '/' + nca,
			headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		        success:function(data){
		        	$("#totalc").html('$' + data.msg);
		        }
		});
        });
	  
})
</script>    
</body>
</html>