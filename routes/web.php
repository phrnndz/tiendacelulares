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

// Route::get('/', function () {
//     return view('guest.index');
// });





Auth::routes();

// RUTAS AJAX PARA EL CARRITO DE COMPRAS
Route::get('products', 'ProductsController@index');
Route::get('products/add-to-cart/{id}', 'ProductsController@addToCart');
Route::patch('products/update-cart', 'ProductsController@update');
Route::delete('products/remove-from-cart', 'ProductsController@remove');

// RUTAS PARA MERCADOPAGO API 
// Route::post('/payments/pay', 'PaymentController@pay')->name('pay');
// Route::get('/payments/approval', 'PaymentController@approval')->name('approval');
// Route::get('/payments/cancelled', 'PaymentController@cancelled')->name('cancelled');




//RUTAS DE ADMINISTRACIÓN
Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/logout', 'Auth\LoginController@logout');

    Route::post('inventario/store', 'InventarioController@store')->name('inventario.store')
                                                        ->middleware('permission:inventario.create');
    Route::get('inventario', 'InventarioController@index')->name('inventario.index')
                                                        ->middleware('permission:inventario.index');
    Route::get('subscribers', 'InventarioController@subscribers')->name('inventario.subscribers')
                                                        ->middleware('permission:inventario.index');
    Route::get('inventario/create', 'InventarioController@create')->name('inventario.create')
                                                        ->middleware('permission:inventario.create');
    Route::put('inventario/{id}', 'InventarioController@update')->name('inventario.update')
                                                        ->middleware('permission:inventario.edit');
    Route::delete('inventario/{id}', 'InventarioController@destroy')->name('inventario.destroy')
                                                        ->middleware('permission:inventario.destroy');
    Route::get('inventario/{id}/edit', 'InventarioController@edit')->name('inventario.edit')
                                                        ->middleware('permission:inventario.edit');
    Route::get('inventario/{id}/module', 'InventarioController@module')->name('inventario.module')
                                                        ->middleware('permission:inventario.edit');
    Route::get('inventario/obtenersubmodulos/{idmodule}', 'InventarioController@obtenersubmodulos')
                                                        ->middleware('permission:inventario.edit');
    Route::post('inventario/deletemodule', 'InventarioController@deletemodule')->name('inventario.deletemodule')
                                                        ->middleware('permission:inventario.edit');                                                   
    Route::post('inventario/addmodule', 'InventarioController@addmodule')->name('inventario.addmodule')
                                                        ->middleware('permission:inventario.edit');
    Route::post('inventario/updatemodule', 'InventarioController@updatemodule')
                                                        ->middleware('permission:inventario.edit');
    Route::post('inventario/updatetitlemodule', 'InventarioController@updatetitlemodule')->name('inventario.updatetitlemodule')
                                                        ->middleware('permission:inventario.edit');
    Route::post('inventario/updatetitlesubmodule', 'InventarioController@updatetitlesubmodule')->name('inventario.updatetitlesubmodule')
                                                        ->middleware('permission:inventario.edit');
    Route::post('inventario/updatetitlesubtheme', 'InventarioController@updatetitlesubtheme')->name('inventario.updatetitlesubtheme')
                                                        ->middleware('permission:inventario.edit');                                                        
    Route::get('inventario/updatesubmodule', 'InventarioController@updatesubmodule')
                                                        ->middleware('permission:inventario.edit');
    Route::post('inventario/deletesubmodule', 'InventarioController@deletesubmodule')->name('inventario.deletesubmodule')
                                                        ->middleware('permission:inventario.edit');
    Route::post('inventario/deletesubtheme', 'InventarioController@deletesubtheme')->name('inventario.deletesubtheme')
                                                        ->middleware('permission:inventario.edit');
    Route::get('inventario/obtenersubtemas/{idsubmodule}', 'InventarioController@obtenersubtemas')
                                                        ->middleware('permission:inventario.edit');
                        
                                                        
    Route::get('payment', 'PaymentController@index')->name('payment.index')
                                                        ->middleware('permission:payment.index');
                                                        
});



//RUTAS ESTATICAS PARA LA PAGINA SIN LOGUEARSE
Route::get('/', 'GuestController@index');
// Route::get('obtenersubtemas','GuestController@obtenersubtemas');

Route::post('suscribir', 'GuestController@suscribir');
Route::get('contacto', 'GuestController@contacto');
Route::get('categoria/{categoria}', 'GuestController@categoria');
Route::get('articulo/{slug}', 'GuestController@singleproducto');
Route::get('evento/{slug}', 'GuestController@singleevento');
Route::get('cart', 'GuestController@cart');
Route::post('checkout', 'GuestController@checkout');
Route::get('checkout/success', 'GuestController@success');
Route::get('checkout/failure', 'GuestController@failure');
Route::get('checkout/pending', 'GuestController@pending');
Route::post('checkout/notifications', 'GuestController@notifications');
Route::get('generatepdf/{reference}', 'GuestController@generatepdf');



