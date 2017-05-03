<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;
use App\Producto;
use Carbon\Carbon;

class AdminController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function admin()
	{
		return view('admin');
	}
	
	public function save(Request $request)
	{
		if ($request->hasFile('file'))
		{
			if ($request->file('file')->isValid())
			{
		
			   //obtenemos el campo file definido en el formulario				     
			   $path = $request->file->storeAs('Masivos', 'archcontrol.txt');
		       if(Storage::disk('local')->exists('Masivos/archivocontrolw.txt'))
		       {
		       		Storage::delete('Masivos/archivocontrolw.txt');
		       }
		       if(Storage::disk('local')->exists('Masivos/archivocontrolu.txt'))
		       {
		       		Storage::delete('Masivos/archivocontrolu.txt');
		       }
		       if(Storage::disk('local')->exists('Masivos/archivocontroli.txt'))
		       {
		       		Storage::delete('Masivos/archivocontroli.txt');
		       }
		       
		       //$contents = File::get(storage_path('app/Masivos/archcontrol.txt'));
		       //dd($contents);
		       $file      = fopen(storage_path('app/Masivos/archcontrol.txt'), "r") or exit("Unable to open file!");
		       
		       while(!feof($file))
		       {
		       		$linesp = fgets($file);
		       		$line   = trim($linesp);
		       		preg_match("/([^,]*),([^,]*),([^,]*),([^,]*),([^,]*),([^,]*),([^,]*),([^,]*),([^,]*),([^,]*),(NO|SI),(NO|SI),(NO|SI),(\d+)$/",$line,$outp);
		       		if (array_key_exists(0, $outp))
		       		{
		       			//Guardamos un ID de venta previo
		       			$nprod = Producto::updateOrCreate(
		       			['id' 				=> $outp[1]],
		       			['name' 			=> $outp[2],
		       			'precpu'			=> $outp[3],
		       			 'costo'			=> $outp[4],
		       			 'categoria'		=> $outp[5],
		       			'ReferenciaOEM'		=> $outp[6],
		       			'Descripcion' 		=> $outp[7],
		       			'foto'				=> $outp[8],
		       			'fechaRetiro'		=> $outp[9],
		       			'ivap'				=> $outp[10],
		       			'iva'				=> $outp[11],
		       			'activo'			=> $outp[12],
		       			'destacado'			=> $outp[13],
		       			'cantidadex'		=> $outp[14]]
		       			);	
		       			$nuevospr 	= storage_path('app/Masivos/archivocontroli.txt');
		       			$filei 		= fopen($nuevospr, "a") or exit("Unable to open file!");
		       			fwrite($filei, "$fecha::: Registros nuevos : ".$line);
		       			fclose($filei);
		       		}
		       		else 
		       		{
		       			$rechazos	= storage_path('app/Masivos/archivocontrolR.txt');
		       			$filew 		= fopen($rechazos, "a") or exit("Unable to open file!");
						fwrite($filew, Carbon::now('America/Bogota')." ::: Rechazado : ".$line);
						fclose($filew);
		       		}
		       }
       
		       fclose($file);
		       
		       
		       //return "archivo guardado";
			}
			else 
			{
				return back();
			}
		}
		else
		{
			return back();
		}
	}
	
}