@php
header("Content-Type: application/vnd.ms-excel");

header("Expires: 0");

header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

header("content-disposition: attachment;filename=Reporte_Productos.xls");
@endphp
<table border="3" cellpadding="1" cellspacing="2">
  <tr>
    <td>CODIGO DEL PRODUCTO</td>
    <td>NOMBRE DEL PRODUCTO</td>
    <td>PRECIO ACTUAL DEL PRODUCTO</td>
    <td>CATEGORIA DEL PRODUCTO</td>
    <td>REFERENCIA DEL FABRICANTE</td>
    <td>DESCRIPCION DEL PRODUCTO</td>
    <td>RUTA DE LA IMAGEN DEL PRODUCTO</td>
    <td>FECHA DE OBSOLESCENCIA DEL PRODUCTO</td>
    <td>ESTADO COMERCIAL DEL PRODUCTO</td>
  </tr>

@foreach ($producs as $produc)	 
    <tr>
      <td>{{ $produc->Descripcion }}</td>
      <td>{{ $produc->Descripcion }}</td>
      <td>{{ $produc->Descripcion }}</td>
      <td>{{ $produc->Descripcion }}</td>
      <td>{{ $produc->Descripcion }}</td>
      <td>{{ $produc->Descripcion }}</td>
      <td>{{ $produc->Descripcion }}</td>
      <td>{{ $produc->Descripcion }}</td>
      <td>{{ $produc->Descripcion }}</td>
    </tr>
@endforeach			
 

</table>