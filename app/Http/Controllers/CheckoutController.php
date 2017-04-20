<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmarCompra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use App\Producto;
use App\Venta;
use Carbon\Carbon;

class CheckoutController extends Controller
{
	public function addprod(Request $request)
	{
		$cant 	= $request->input('cantidad');
		$idp	= $request->input('id_prod');
		$precp	= $request->input('pre_pu');
		
		//Por seguridad verificamos que no se han anadido productos malintencionados
		//$request->session()->flush();
		$procom	= Producto::where('id', $idp)->select('precpu','Descripcion','foto','cantidadex','iva','ivap')->first();
		
		if($procom->precpu == $precp )
		{
			$ivaex	= $procom->iva;
			$ivapc	= $procom->ivap;
			if ($ivaex == 'SI')
			{
				$poriva = ($ivapc/100) + 1	;
				$total	= ($precp * $cant) * $poriva;
			}
			else
			{
				$poriva = 1	;
				$total	= $precp * $cant;
			}

			$desc	= $procom->Descripcion;
			$foto	= $procom->foto;
			$exis	= $procom->cantidadex;
			$arreg  = array('precio' => $precp,'descripcion' => $desc,'foto' => $foto,'cantidad' => $cant, 'total' => $total, 'existencia' => $exis, 'iva' => $poriva);
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
		$procom	= Producto::where('id', $id)->select('precpu','Descripcion','foto','cantidadex','iva','ivap')->first();
		$precp	= $procom->precpu;
		$ivaex	= $procom->iva;
		$ivapc	= $procom->ivap;
		if ($ivaex == 'SI') 
		{
			$poriva = ($ivapc/100) + 1	;
			$total	= ($precp * $can) * $poriva;
		}
		else 
		{
			$poriva = 1;
			$total	= $precp * $can;
		}
		$desc	= $procom->Descripcion;
		$foto	= $procom->foto;
		$exis	= $procom->cantidadex;
		$arreg  = array('precio' => $precp,'descripcion' => $desc,'foto' => $foto,'cantidad' => $can, 'total' => $total, 'existencia' => $exis, 'iva' => $poriva);
		//dd($arreg);
		session(['cart.'.$id => $arreg]);
		$data = Session::get('cart');
		$totsum	= 0;
		foreach ($data as $key => $value)
		{
			$totsum = ($value['cantidad']*$value['precio'] * $value['iva']) + $totsum;
		}
		return response()->json(array('msg'=> $totsum), 200);
	}
	
	public function remcant($id)
	{
		Session::forget('cart.'.$id);
		//return view('cart');
		return back();
	}
	
	public function confpago(Request $request)
	{
		//dd($request);
		$dir 	= $request->input('dir_entrega');
		$depto	= $request->input('depto');
		$mun	= $request->input('mun');
		$barr 	= $request->input('barrio');
		$tel	= $request->input('tel_con');
		$forpa	= $request->input('forma-pago');
		$ctbrt	= $request->input('totalct');
		$ctfin	= $request->input('totalcf');
		$ctenv	= $request->input('totalge');
		$ctiva	= $request->input('totaliv');
		$ctota	= $request->input('totalpg');
		//Guardamos un ID de venta previo
		$idven = new Venta;		
		$idven->idCliente 		= Auth::user()->documento;
		$idven->valorFacturado	= $ctota;
		$idven->fechatx			= Carbon::now('America/Bogota');
		$idven->ivac			= $ctiva;
		$idven->confirmado		= 'NO';
		$idven->save();
		//fIN INSERCION
		$last_id = $idven->id;
		//echo $last_id, exit(-1);
		//Signature
		//$strsig = "5eiu9cu1hjo9kuhdajsj1k1luq~505232~".$last_id."~".$ctota."~COP";
		$strsig = "4Vj8eK4rloUd272L48hsrarnUA~508029~".$last_id."~".round($ctota, 0)."~COP";
		$signature  = sha1($strsig);
		//End signature
		
		
		$arrcp  = array('dir' => $dir,'depto' => $depto,'mun' => $mun,'barr' => $barr, 'tel' => $tel, 'ctbrt' => $ctbrt, 'ctfin' => $ctfin,'ctiva' => round($ctiva,2), 'ctenv' => $ctenv, 'ctota' => round($ctota,0), 'last_id' => $last_id,'signature' => $signature, 'forpa' => $forpa,'lafirma'=>$strsig);
		return view('confpago')->with(array('arrcp'=>$arrcp));
	}
	
	public function insven(Request $request)
	{
		/*$datcor = $request->all();
		\Mail::send('emails.compra', $datcor, function($message) use ($request)
		{
			//$message->from($request->email, $request->name);
			$message->from('electronicapcolombia@gmail.com');
			$message->subject('Nueva compra sitio Web');
			$message->to('electronicapcolombia@gmail.com');
			//$message->to(env('CONTACT_MAIL'), env('CONTACT_NAME'));
		
		});*/

		$data =  [
				'nomcli'    => $request->input('buyerFullName'),
				'emacli'   	=> $request->input('buyerEmail'),
				'dircli'   	=> $request->input('shippingAddress'),
				'ciucli'   	=> $request->input('shippingCity'),
				'telcli'   	=> $request->input('telephone'),
				'refcli'   	=> $request->input('referenceCode'),
				'valbru'   	=> $request->input('valbru'),
				'gasfin'   	=> $request->input('gasfin'),
				'gasenv'   	=> $request->input('gasenv'),
				'ivacli'   	=> $request->input('tax'),
				'totcli'   	=> $request->input('amount')
		];
		//Rutina de envio de mail
		$totmail  = array('valbru' => $request->input('valbru'),'gasfin' => $request->input('gasfin'),'gasenv' => $request->input('gasenv'),'ivacli' => $request->input('tax'),'totcli' => $request->input('amount'));
		\Mail::to($request->input('buyerEmail'))->send(new ConfirmarCompra($totmail));
		//Fin de rutina de mail
		//Inicio COntruccion PDF
		$pdf = \PDF::loadView('genpdf',['data' => $data]);
		return $pdf->download('detalleVenta.pdf');
		//FIn construccion pdf
		//return view('cart');
	}
	public function res_payu(Request $request)
	{
		
		$api_key		= env('API_PAYU_KEY','ERROR');
		$mer_id			= env('MER_PAY_ID','ERROR');
		$referenceCode  = $request->input('referenceCode');
		$TX_VALUE   	= $request->input('TX_VALUE');
		$currency   	= $request->input('currency');
		$txState   		= $request->input('transactionState');
		$signature   	= $request->input('signature');
		$reference_pol  = $request->input('reference_pol');
		$descrp   		= $request->input('description');
		$cus 			= $request->input('cus');
		$pseBank   		= $request->input('pseBank');
		$lapPayMethod 	= $request->input('lapPaymentMethod');
		$txId 			= $request->input('transactionId');
		$tx_val_m		= number_format($TX_VALUE, 1, '.', '');
		$firma_cadena	= "$api_key~$mer_id~$referenceCode~$tx_val_m~$currency~$txState";
		$firmacreada 	= md5($firma_cadena);
		$url 			= $request->fullUrl();
		$mensaje 		= $request->input('message');
		
		if ($txState == 4 )
		{
			$estadoTx = "aprobada";
		}
		
		else if ($txState == 6 )
		{
			$estadoTx = "rechazada";
		}
		
		else if ($txState == 104 )
		{
			$estadoTx = "Error";
		}
		else if ($txState == 7 )
		{
			$estadoTx = "pendiente";
		}
		
		else
		{
			$estadoTx= "desconocido";
		}
		$data =  [
				'lapPayMethod'  => $lapPayMethod,
				'pseBank'   	=> $pseBank,
				'tx_val_m'   	=> $tx_val_m,
				'mensaje'   	=> $mensaje,
				'descrp'   		=> $descrp,
				'estadoTx' 		=> $estadoTx
		];
		if (strtoupper($signature) == strtoupper($firmacreada) && $estadoTx != "aprobada" && $estadoTx != "desconocido")
		{
			return view('cart')->with('respay', $data);
		}
		else if(strtoupper($signature) == strtoupper($firmacreada) && $estadoTx == "aprobada" )
		{
			return view('fintx')->with('respay', $data);
		}
		else
		{
			abort(401, 'Unauthorized.');
		}
	}	
	
}
