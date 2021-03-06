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

Route::post('/suscribir', 'ShopController@suscript');

Route::get('/terminos', function () {
	return view('terminos');
});
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

});
//Fin rutas	

//Rutas administrativas
	Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function()
	{
		Route::get('/admin', 'AdminController@admin');
		//Categorias
		Route::get('/admin/categorias', 'AdminController@categoria');
		Route::get('/admin/categorias/{id}', 'AdminController@categedit')->where(['id' => '[0-9]+']);
		Route::post('/admin/categorias/edicion', 'AdminController@categedsv');
		
		Route::get('/admin/categorias/add', function () {
		    return view('adcat');
		});
		Route::post('/admin/categorias/add', 'AdminController@categadd');
		
		//Productos
		Route::get('/admin/productos', 'AdminController@producto');
		Route::get('/admin/producto/{id}', 'AdminController@prodedit')->where(['id' => '[0-9]+']);
		Route::get('/admin/producto/add', function () {
			return view('adprd');
		});
		Route::post('/admin/productos/add', 'AdminController@prodadd');
		Route::get('/admin/producto/prodcat', 'AdminController@prdcat');
		Route::post('/admin/productos/edicion', 'AdminController@prodedsv');
			
		Route::get('/admin/prodmasivo', function () {
		    return view('prodmas');
		});
		
		Route::post('admin/upload', 'AdminController@save');
		Route::post('admin/excel', 'AdminController@excel');
		//Ventas
		Route::get('/admin/ventas', 'AdminController@lstven');
		Route::get('/admin/ventas/{id}', 'AdminController@ventedit')->where(['id' => '[0-9]+']);
		Route::post('/admin/ventas/edicion', 'AdminController@ventedsv');
		
		//Usuarios		
		Route::get('/admin/user', 'AdminController@ausered');
		Route::get('/admin/user/{id}/{isAdmin}', 'AdminController@addmin')->where(['id' => '[0-9]+']);


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