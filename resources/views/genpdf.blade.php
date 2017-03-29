<html>
<h2>Hola esto es un pdf</h2>
 @foreach($data as $key => $value)
			                                <div class="media-body">
			                                    <h4 class="media-heading"><a href="#">{{ $value }}</a></h4>
				                            </div>
 @endforeach


</html>