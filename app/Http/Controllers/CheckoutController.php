<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Producto;

class CheckoutController extends Controller
{
	public function addprod(Request $request)
	{
		$cant 	= $request->input('cantidad');
		$idp	= $request->input('id_prod');
		$precp	= $request->input('pre_pu');
		
		//Por seguridad verificamos que no se han anadido productos malintencionados
		//$request->session()->flush();
		$procom	= Producto::where('id', $idp)->select('precpu','Descripcion','foto','cantidadex')->first();
		
		if($procom->precpu == $precp )
		{
			$total	=  $precp * $cant;	
			$desc	= $procom->Descripcion;
			$foto	= $procom->foto;
			$exis	= $procom->cantidadex;
			$arreg  = array('precio' => $precp,'descripcion' => $desc,'foto' => $foto,'cantidad' => $cant, 'total' => $total, 'existencia' => $exis);
			//$request->session()->push('cart',$arreglo); Tambien sepuede hacer de esta forma
			session(['cart.'.$idp => $arreg]);
			//Session::save(); Esto toca caherlo si se pone el dd, puesto que no deja gardar la sesion
			//$data = $request->session()->all();
			//$data = Session::get('cart');
			//dd($data);
			return view('cart');
		}
	}
	
	public function addcant($can,$id)
	{
		echo $can;
	}
}