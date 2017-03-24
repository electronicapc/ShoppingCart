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
	
	public function addcant($id, $can)
	{
		$procom	= Producto::where('id', $id)->select('precpu','Descripcion','foto','cantidadex')->first();
		$precp	= $procom->precpu;
		$total	= $precp * $can;
		$desc	= $procom->Descripcion;
		$foto	= $procom->foto;
		$exis	= $procom->cantidadex;
		$arreg  = array('precio' => $precp,'descripcion' => $desc,'foto' => $foto,'cantidad' => $can, 'total' => $total, 'existencia' => $exis);
		//dd($arreg);
		session(['cart.'.$id => $arreg]);
		$data = Session::get('cart');
		$totsum	= 0;
		foreach ($data as $key => $value)
		{
			$totsum = ($value['cantidad']*$value['precio']) + $totsum;
		}
		return response()->json(array('msg'=> $totsum), 200);
	}
	
	public function remcant($id)
	{
		Session::forget('cart.'.$id);
		//return view('cart');
		return back();
	}
}
