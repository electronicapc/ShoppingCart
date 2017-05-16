<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;
use App\Producto;
use App\User;
use App\Categoria;
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
	
	public function excel()
	{
		$produc	= Producto::where('activo', 'SI')->get();
		return view('genexcel')->with('producs', $produc);
		
	}
	//Categorias
	public function categoria()
	{
		$lists 	= Categoria::all();
       return view('lstcat')->with('categoria', $lists);      					
	
	}
	
	public function categedit($id)
	{
		$lists 	= Categoria::findOrFail($id);//dd($lists);
		return view('edcat')->with('categoria', $lists);
	
	}
	
	public function categedsv(Request $request)
	{
		if ($request->hasFile('photo'))
		{
			if ($request->file('photo')->isValid())
			{
				$ecat 				= Categoria::find($request->input('id'));		
				$ecat->name 		= $request->input('nombre');	
				$ecat->Descripcion 	= $request->input('descripcion');
				$ecat->foto			= '../storage/app/CatImages/';
				$ecat->save();	
				
				//obtenemos el campo file definido en el formulario
				$path = $request->photo->storeAs('CatImages', $request->input('id').'.jpg');
				
				return redirect('/admin/categorias')->with('status', 'Se modifico la categoria correctamente');
			}
			return back();
			
		}
		else
		{
			return back();
		}

	}
	
	public function categadd(Request $request)
	{
		if ($request->hasFile('photo'))
		{
			if ($request->file('photo')->isValid())
			{
		
				$idcat = new Categoria;
				$idcat->name 		= $request->input('nombre');
				$idcat->Descripcion	= $request->input('descripcion');
				$idcat->foto		= '../storage/app/CatImages/';
				$idcat->save();
			   //obtenemos el campo file definido en el formulario				     
			   $path = $request->photo->storeAs('CatImages', $idcat->id.'.jpg');
			   
			  return redirect('/admin/categorias/add')->with('status', 'Se agrego la categoria correctamente');
			   
			}	
			return back();
			
		}
		else
		{
			return back();
		}
	
	}
	//Productos
	public function producto()
	{
		$lists 	= Producto::all();
		return view('lstprod')->with('producto', $lists);
	
	}
	
	public function prodadd(Request $request)
	{
		if ($request->hasFile('photo1'))
		{
			if ($request->file('photo1')->isValid())
			{
	
				$idprd = new Producto;
				$idprd->name 			= $request->input('nombre');
				$idprd->categoria 		= $request->input('categoria');
				$idprd->precpu 			= $request->input('ppublico');
				$idprd->costo 			= $request->input('costo');
				$idprd->ReferenciaOEM 	= $request->input('referencia');
				$idprd->iva 			= $request->input('iva');
				$idprd->ivap 			= $request->input('piva');
				$idprd->activo 			= $request->input('activo');
				$idprd->destacado 		= $request->input('destacado');
				$idprd->cantidadex 		= $request->input('cexist');
				$idprd->Descripcion		= $request->input('descripcion');
				$idprd->foto		= '../storage/app/PrdImages/';
				$idprd->save();
				//obtenemos el campo file definido en el formulario
				$path = $request->photo1->storeAs('PrdImages', $idprd->id.'.jpg');
				if ($request->hasFile('photo2'))
				{
					$path = $request->photo2->storeAs('PrdImages', $idprd->id.'_2.jpg');
				}
				if ($request->hasFile('photo3'))
				{
					$path = $request->photo3->storeAs('PrdImages', $idprd->id.'_3.jpg');
				}
	
				return redirect('/admin/producto/add')->with('status', 'Se agrego el producto correctamente');
	
			}
			return back();
				
		}
		else
		{
			return back();
		}
	
	}
	
	public function prodedit($id)
	{
		$lists 	= Producto::findOrFail($id);//dd($lists);
		return view('edprd')->with('producto', $lists);
	
	}
	
	
	//Retorno de catgroias para anadir producto
	
	public function prdcat()
	{
		$aprcat	= Categoria::select('id','name')->get()->toJson();//
		return $aprcat;
	}
	
	public function prodedsv(Request $request)
	{
		$eprd 					= Producto::find($request->input('id'));
		$eprd->name 			= $request->input('nombre');
		$eprd->Descripcion 		= $request->input('descripcion');
		$eprd->categoria 		= $request->input('categoria');
		$eprd->ReferenciaOEM 	= $request->input('referencia');
		$eprd->precpu 			= $request->input('ppublico');
		$eprd->costo 			= $request->input('costo');
		$eprd->iva 				= $request->input('iva');
		$eprd->ivap 			= $request->input('piva');
		$eprd->activo 			= $request->input('activo');
		$eprd->destacado 		= $request->input('destacado');
		$eprd->cantidadex 		= $request->input('cexist');
		
		if ($request->hasFile('photo1'))
		{
			if ($request->file('photo1')->isValid())
			{
				//obtenemos el campo file definido en el formulario
				$path = $request->photo1->storeAs('PrdImages', $request->input('id').'.jpg');
				$eprd->foto			= '../storage/app/PrdImages/';
				
			}
		}	
		if ($request->hasFile('photo2'))
		{
			$path = $request->photo2->storeAs('PrdImages', $request->input('id').'_2.jpg');
		}
		if ($request->hasFile('photo3'))
		{
			$path = $request->photo3->storeAs('PrdImages', $request->input('id').'_3.jpg');
		}
		
		$eprd->save();
		
		return redirect('/admin/productos')->with('status', 'Se modifico el producto correctamente');
	
	}
	
	//Metodos de usuarios

	public function ausered()
	{
		$aprcat	= User::select('id','name','address','email','phonen','documento','isAdmin')->get();
		return view('lstusr')->with('users', $aprcat);
	}
	
}
