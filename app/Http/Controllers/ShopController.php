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
    public function destroy($id)
    {
        //
    }
}
