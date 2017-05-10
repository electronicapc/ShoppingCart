<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Rutas para publicar productos
Route::get('/','ShopController@index');

Route::get('/categoria/{id}/{asc?}', 'ShopController@show')->where(['id' => '[0-9]+'],['asc' => '[a-zA-Z]+']);

Route::get('/categoria/single/{id}', 'ShopController@showprod')->where(['id' => '[0-9]+']);
//Fin rutas

//Rutas para agregar productos
Route::post('/checkout', 'CheckoutController@addprod');
Route::get('/checkout', function () {
    return view('cart');
});
Route::post('/checkout/{id}/{can}', 'CheckoutController@addcant')->where(['can' => '[0-9]+'],['id' => '[0-9]+']);
Route::get('/checkout/{id}', 'CheckoutController@remcant')->where(['id' => '[0-9]+']);

Route::get('/vrfauth', 'ShopController@showprod')->where(['id' => '[0-9]+']);
//Fin rutas
//Rutas autenticacion
Auth::routes();
//Fin rutas
//Rutas ciudades
Route::get('/depto', 'CityController@index');
Route::get('/depto/{id}', 'CityController@munic')->where('id', '[A-Za-z]+');
//Fin rutas
//Rutas Payu response
Route::get('/response_Payu', 'CheckoutController@res_payu');
Route::post('/conf_Payu', 'CheckoutController@conf_payu');
//Rutas autenticadas
Route::group(['middleware' =>'auth'], function () {
	Route::match(['get', 'post'],'/pago', function () {
		return view('pago');
	});
	
	Route::post('/confpago', 'CheckoutController@confpago');
	
	Route::post('/ins_ven', 'CheckoutController@insven');
	
	//Route::get('/response_Payu', 'CheckoutController@res_payu');
});
//Fin rutas	

//Rutas administrativas
	Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function()
	{
		Route::get('/admin', 'AdminController@admin');
		Route::get('/admin/categorias', 'AdminController@categoria');
		Route::get('/admin/categorias/{id}', 'AdminController@categedit')->where(['id' => '[0-9]+']);
		Route::get('/admin/categorias/add', function () {
		    return view('adcat');
		});
		Route::post('/admin/categorias/add', 'AdminController@categadd');
		
		
		Route::get('/admin/productos', 'AdminController@producto');
		Route::get('/admin/prodmasivo', function () {
		    return view('prodmas');
		});
		Route::get('/admin/user', 'AdminController@ausered');
		
		Route::post('admin/upload', 'AdminController@save');
		Route::post('admin/excel', 'AdminController@excel');

	});
//Din rutas adminitrativas

Route::get('/logout', function () {
    Auth::logout();
    return back();
    
});

//Rutas de pruebas

Route::get('/pruebas', function () {
	return view('pruebas');
});
Route::get('/pdf', function () {
	$data =  [
			'quantity'      => '1' ,
			'description'   => 'some ramdom text',
			'price'   => '500',
			'total'     => '898900'
	];
	$pdf = PDF::loadView('genpdf',['data' => $data]);
	return $pdf->download('detalleVenta.pdf');
});

Route::get('/deptos', 'CityController@indexx');
//Fin rutas de pruebas	