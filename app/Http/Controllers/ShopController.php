<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;
use App\Producto;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists 	= Categoria::all();
        $produc	= Producto::where('destacado', 'SI')->get();
    	//return view('index')->with('lists', $lists->toArray());
    	//dd($produc); 
        return view('index')->with('lists', $lists)
        					->with('producs', $produc);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $asc = 'asc')
    {
    	if($asc == 'asc')
    	{
    		$sort = 'asc';	
    	}
    	else 
    	{
    		$sort = 'desc';
    	}
    	$lists 		= Categoria::all();
       	$categories	= Producto::where('categoria', $id)->orderBy('precpu',$sort)->paginate(15);
       	return view('categorias')->with('lists', $lists)
       							 ->with('categorias', $categories);
    }
    
    //*Metodo para mostrar la descripcion de un solo producto
    public function showprod($id)
    {
    	$lists 		= Categoria::all();
    	$products	= Producto::where('id', $id)->get()->first();;
    	return view('single')->with('lists', $lists)
    						 ->with('productos', $products);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function suscript(Request $request)
    {
    	//Rutina de prueba mail
    	
    	require app_path('Mail/class.phpmailer.php');
    	require app_path('Mail/class.smtp.php');
    	//Fin
    	
    	$maillist 	= $request->input('suscript');
    	
    	$mail 		= new \PHPMailer;
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
    	$mail->addAddress('electronicapcolombia@gmail.com');
    	$mail->isHTML(true);                                  // Set email format to HTML
    	
    	$messsage	   = 'Solicitaron NewsLetter '. $maillist;

    	$mail->Subject = 'Solicitud suscripcion Softecol';
    	$mail->Body    = $messsage;

    	//$mail->send();
    	return redirect('/');
    }
    
    
    public function destroy($id)
    {
        //
    }
}
