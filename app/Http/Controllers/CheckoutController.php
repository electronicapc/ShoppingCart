<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmarCompra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use DB;
use App\Detalleventa;
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
		$procom	= Producto::where('id', $idp)->select('precpu','Descripcion','DescripcionS','foto','cantidadex','iva','ivap')->first();
		
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
			$descS	= $procom->DescripcionS;
			$foto	= $procom->foto;
			$exis	= $procom->cantidadex;
			$arreg  = array('precio' => $precp,'descripcion' => $desc,'descripcionS' => $descS,'foto' => $foto,'cantidad' => $cant, 'total' => $total, 'existencia' => $exis, 'iva' => $poriva);
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
		$procom	= Producto::where('id', $id)->select('precpu','Descripcion','DescripcionS','foto','cantidadex','iva','ivap')->first();
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
		$descS	= $procom->DescripcionS;
		$foto	= $procom->foto;
		$exis	= $procom->cantidadex;
		$arreg  = array('precio' => $precp,'descripcion' => $desc,'descripcionS' => $descS,'foto' => $foto,'cantidad' => $can, 'total' => $total, 'existencia' => $exis, 'iva' => $poriva);
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
		$idven->med_pag			= $forpa;
		$idven->fechatx			= Carbon::now('America/Bogota');
		$idven->ivac			= $ctiva;
		$idven->confirmado		= 'NO';
		$idven->save();
		//Fin insercion
		$last_id = $idven->CodigoVenta;
		//echo $last_id, exit(-1);
		//Signature
		//$strsig = "5eiu9cu1hjo9kuhdajsj1k1luq~505232~".$last_id."~".$ctota."~COP";
		$strsig = "4Vj8eK4rloUd272L48hsrarnUA~508029~".$last_id."~".round($ctota, 0)."~COP";
		//$strsig = "4Vj8eK4rloUd272L48hsrarnUA~508029~555527~".round($ctota, 0)."~COP";
		$signature  = sha1($strsig);
		//End signature
		if($forpa == 'Payu')
		{
			$datcar = Session::get('cart');
			foreach ($datcar as $key =>$value)
			{
				DB::table('detalleVentas')->insert([
						'CodigoVenta'       => $last_id,
						'CodigoProducto' 	=> $key,
						'descuento'         => 0,
						'cantidad'          => $value['cantidad'],
						'valorFac'          => $value['total'],
						'ivaFac'            => $value['iva']]);
			}
		}
		
		$arrcp  = array('dir' => $dir,'depto' => $depto,'mun' => $mun,'barr' => $barr, 'tel' => $tel, 'ctbrt' => $ctbrt, 'ctfin' => $ctfin,'ctiva' => round($ctiva,2), 'ctenv' => $ctenv, 'ctota' => round($ctota,0), 'last_id' => $last_id,'signature' => $signature, 'forpa' => $forpa,'lafirma'=>$strsig);
		//dd($arrcp);
		return view('confpago')->with(array('arrcp'=>$arrcp));
	}
	
	public function insven(Request $request)
	{
		//dd($request);
		/*$datcor = $request->all();
		\Mail::send('emails.compra', $datcor, function($message) use ($request)
		{
			//$message->from($request->email, $request->name);
			$message->from('electronicapcolombia@gmail.com');
			$message->subject('Nueva compra sitio Web');
			$message->to('electronicapcolombia@gmail.com');
			//$message->to(env('CONTACT_MAIL'), env('CONTACT_NAME'));
		
		});*/
		if ($request->input('forpa') == 'Consignacion')
		{
			$tiptx = 1;
		}
		else 
		{
			$tiptx = 2;
		}

		$data =  [
				'refcli'    => $request->input('referenceCode'),
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
				'totcli'   	=> $request->input('amount'),
				'forpa'   	=> $request->input('forpa'),
				'tiptx'		=> $tiptx
		];
		//Inicio COntruccion PDF
		$pdf = \PDF::loadView('genpdf',['data' => $data])->save('pdf/'.$request->input('referenceCode').'.pdf');
		//Fin pdf
		//Rutina de envio de mail
		$totmail  = array('refcod'=>$request->input('referenceCode'),'valbru' => $request->input('valbru'),'gasfin' => $request->input('gasfin'),'gasenv' => $request->input('gasenv'),'ivacli' => $request->input('tax'),'totcli' => $request->input('amount'),'dirent' => $request->input('shippingAddress'),'ciuent' => $request->input('shippingCity'),'telent' => $request->input('telephone'),'metpag'=>$tiptx,'ip'=>$request->ip());
		//Rutina de envio de Correos
		//\Mail::to($request->input('buyerEmail'))->send(new ConfirmarCompra($totmail));
		
		//Rutina de prueba mail
		
		require app_path('Mail/class.phpmailer.php');
		require app_path('Mail/class.smtp.php');
		
		$message = file_get_contents('../resources/views/emails/compra.blade.php');
		//$message = str_replace('%testusername%', $username, $message);
		//$message = str_replace('%testpassword%', $password, $message);
		
		$mail = new \PHPMailer;
		
		//$mail->SMTPDebug = 3;                               // Enable verbose debug output
		
		$mail->isSMTP();                                      // Set mailer to use SMTP
		//$mail->Host = 'smtp.mailgun.org';  // Specify main and backup SMTP servers
		$mail->Host = 'smtp.live.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		//$mail->Username = 'postmaster@electronicapc.hol.es';                 // SMTP username
		$mail->Username = 'gunsnjrc_999@hotmail.com';                 // SMTP username
		//$mail->Password = 'Super1982@';                           // SMTP password
		$mail->Password = 'NOVEMBERRAIN';                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to
		
		//$mail->setFrom('ventas@electronicapc.hol.es', 'Softecol');
		$mail->setFrom('gunsnjrc_999@hotmail.com', 'Softecol');
		$mail->addAddress($request->input('buyerEmail'), $request->input('buyerFullName'));     // Add a recipient
		$mail->addAddress('electronicapcolombia@gmail.com');               // Name is optional
		$mail->addReplyTo('electronicapcolombia@gmail.com', 'Information');
		$mail->addCC('gunsnjrc@yahoo.com');
		$mail->addBCC('gunsnjrc_999@hotmail.com');
		
		$mail->addAttachment('pdf/'.$request->input('referenceCode').'.pdf');         // Add attachments
		//$mail->addAttachment('pdf/1.pdf');    // Optional name
		$mail->isHTML(true);                                  // Set email format to HTML
		
		$mail->Subject = 'Nueva Compra de productos en Softecol';
		$mail->Body    = $message;
		$mail->AltBody = $message;
		
		/*if(!$mail->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
			echo 'Message has been sent';
		}*/
		//Fin de rutina de mail
		//Descargamos el carrito en tabla
		$datcar = Session::get('cart');
		foreach ($datcar as $key =>$value)
		{
			DB::table('detalleVentas')->insert([
				'CodigoVenta'       => $request->input('referenceCode'),
				'CodigoProducto' 	=> $key,
				'descuento'         => 0,
				'cantidad'          => $value['cantidad'],
				'valorFac'          => $value['total'],
				'ivaFac'            => $value['iva']]);
		}
		//fin descarga
		$request->session()->forget('cart');
		return view('fintx')->with('respay', $data);
		//return $pdf->download('detalleVenta.pdf');
		//Fin construccion pdf
	}
	public function res_payu(Request $request)
	{
		
		$api_key		= env('API_PAYU_KEY','ERROR');
		$mer_id			= env('MER_PAY_ID','ERROR');
		$referenceCode  = $request->input('referenceCode');
		$TX_VALUE   	= $request->input('TX_VALUE');
		$ivatot   		= $request->input('TX_TAX');
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
		//$tx_val_m		= round( $TX_VALUE, 1, PHP_ROUND_HALF_EVEN);
		$firma_cadena	= "$api_key~$mer_id~$referenceCode~$tx_val_m~$currency~$txState";
		$firmacreada 	= sha1($firma_cadena);
		$url 			= $request->fullUrl();
		$mensaje 		= $request->input('message');
		$valbru 		= $request->input('extra1');
		$valfin 		= $request->input('extra2');
		$valenv 		= $request->input('extra3');
		$mailcl 		= $request->input('buyerEmail');
		
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
		else if ($txState == 5 )
		{
			$estadoTx = "Expirada";
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
				'estadoTx' 		=> $estadoTx,
				'valbru' 		=> $valbru,
				'nomcli'   		=> Auth::user()->name,
				//'nomcli'   		=> 'nesiton reyes',
				'emacli'   		=> $mailcl,
				'dircli'   		=> 'Confirmada por correo',
				'ciucli'   		=> 'Confirmada por correo',
				'telcli'   		=> 'Confirmado por correo',
				'refcli'   		=> $referenceCode,
				'gasfin'   		=> $valfin,
				'gasenv'   		=> $valenv,
				'ivacli'   		=> $ivatot,
				'totcli'   		=> $TX_VALUE,
				'txId'   		=> $txId,
				'tiptx'			=> 3
				
		];
		/*echo $firmacreada."\n";
		echo "\n".$signature;
		echo $estadoTx;*/
		
		if (strtoupper($signature) == strtoupper($firmacreada) && $estadoTx != "aprobada" && $estadoTx != "desconocido")
		{
			return redirect('/checkout')->with('respay', $data);
		}
		else if((strtoupper($signature) == strtoupper($firmacreada)) && $estadoTx == "aprobada" )
		{
			$pdf = \PDF::loadView('genpdf',['data' => $data])->save('pdf/'.$referenceCode.'.pdf');
			sleep(3);
			$request->session()->forget('cart');
			return view('fintx')->with('respay', $data);
			//return $pdf->download('detalleVenta.pdf');
		}
		else
		{
			abort(401, 'Unauthorized.');
		}
	}	
	
	public function conf_payu(Request $request)
	{
		$api_key			= env('API_PAYU_KEY','ERROR');
		$mer_id				= env('MER_PAY_ID','ERROR');
		$state_pol			= $request->input('state_pol');
		$response_code_pol	= $request->input('response_code_pol');
		$reference_sale		= $request->input('reference_sale');
		$reference_pol		= $request->input('reference_pol');
		$sign				= $request->input('sign');
		$currency			= $request->input('currency');		
		$extra1				= $request->input('extra1');
		$extra2				= $request->input('extra2');
		$extra3				= $request->input('extra3');
		$payment_method		= $request->input('payment_method');
		$payment_method_type= $request->input('payment_method_type');
		$value				= $request->input('value');
		$value_new			= number_format($value, 1, '.', '');
		$tax				= $request->input('tax');
		$transaction_date	= $request->input('transaction_date');
		$email_buyer		= $request->input('email_buyer');
		$pse_bank			= $request->input('pse_bank');
		$test               = $request->input('test');
		$description        = $request->input('description');
		$billing_address    = $request->input('billing_address');
		$shipping_address   = $request->input('shipping_address');
		$phone              = $request->input('phone');
		$office_phone       = $request->input('office_phone');
		$admin_fee          = $request->input('administrative_fee');
		$admin_fee_base     = $request->input('administrative_fee_base');
		$admin_fee_tax      = $request->input('administrative_fee_tax');
		$billing_city       = $request->input('billing_city');
		$billing_country	= $request->input('billing_country');
		$commision_pol      = $request->input('commision_pol');
		$commision_pol_cur  = $request->input('commision_pol_currency');
		$customer_number	= $request->input('customer_number');
		$date               = $request->input('date');
		$ip                 = $request->input('ip');
		$payment_method_id  = $request->input('payment_method_id');
		$payment_reqt_state = $request->input('payment_request_state');
		$response_mess_pol  = $request->input('response_message_pol');
		$shipping_city      = $request->input('shipping_city');
		$shipping_country   = $request->input('shipping_country');
		$transaction_id     = $request->input('transaction_id');
		$pay_method_name    = $request->input('payment_method_name');
		
		$firma_cadena		= "$api_key~$mer_id~$reference_sale~$value_new~$currency~$state_pol";
		$firmacreada 		= sha1($firma_cadena);
				
		if (strtoupper($sign) == strtoupper($firmacreada) && $state_pol == 4)
		{
			$venap	= Venta::find($reference_sale);
			$venap->confirmado = 'SI' ;
			$venap->save();
								
			$totmail  = array('refcod' => $reference_sale,'response_message_pol' => $response_mess_pol,'valbru' => $extra1,'gasfin' => $extra2,'gasenv' => $extra3,'ivacli' => $tax,'totcli' => $value,'fectx' => $transaction_date,'shipping_address' => $shipping_address,'phone'=>$phone,'billing_city'=>$billing_city,'ip'=>$ip,'shipping_city'=>$shipping_city,'pay_method_name'=>$pay_method_name,'metpag'=>3);
			\Mail::to($email_buyer)->send(new ConfirmarCompra($totmail));
		}
		else if(strtoupper($sign) == strtoupper($firmacreada) && $state_pol == 6 )
		{
			$totmail  = array('refcod' => $reference_sale,'response_message_pol' => $response_mess_pol,'valbru' => $extra1,'gasfin' => $extra2,'gasenv' => $extra3,'ivacli' => $tax,'totcli' => $value,'fectx' => $transaction_date,'shipping_address' => $shipping_address,'phone'=>$phone,'billing_city'=>$billing_city,'ip'=>$ip,'shipping_city'=>$shipping_city,'pay_method_name'=>$pay_method_name,'metpag'=>3);
			//\Mail::to($email_buyer)->send(new ConfirmarCompra($totmail));
		}
		else if(strtoupper($sign) == strtoupper($firmacreada) && $state_pol == 5)
		{
			$totmail  = array('refcod' => $reference_sale,'response_message_pol' => $response_mess_pol,'valbru' => $extra1,'gasfin' => $extra2,'gasenv' => $extra3,'ivacli' => $tax,'totcli' => $value,'fectx' => $transaction_date,'shipping_address' => $shipping_address,'phone'=>$phone,'billing_city'=>$billing_city,'ip'=>$ip,'shipping_city'=>$shipping_city,'pay_method_name'=>$pay_method_name,'metpag'=>3);
			//\Mail::to($email_buyer)->send(new ConfirmarCompra($totmail));
		}
		else
		{
			Log::notice('Existio un error de concordancia en la firma enviada desde Payu:  Codigo de referencia de compra->'.$reference_sale.' Valor reportado-> '.$value.' Metodo de pago->'.$payment_method.'Fecha de tx->'.$transaction_date.'Firma reportada ->'.$sign.'Firma creada ->'.$firmacreada);
		}
	}
	
}
