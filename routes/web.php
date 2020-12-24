
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

Route::get('/', function () {
    return redirect('/login');
    // return view('home')
});

Route::get('/login','AuthController@login')->name('login');
Route::post('/postlogin','AuthController@postlogin');
Route::get('/logout','AuthController@logout');


Route::group(['middleware' => 'auth'],function(){
	Route::get('/dashboard','DashboardController@index');

	//kategori
	Route::get('/kategori','KatCont@index');
	Route::post('/kategori/create','KatCont@create');
	Route::get('/kategori/{id}/edit','KatCont@edit');
	Route::post('/kategori/{id}/update','KatCont@update');
	Route::get('/kategori/{id}/delete','KatCont@delete');

	//satuan
	Route::get('/satuan','SatCont@index');
	Route::post('/satuan/create','SatCont@create');
	Route::get('/satuan/{id}/edit','SatCont@edit');
	Route::post('/satuan/{id}/update','SatCont@update');
	Route::get('/satuan/{id}/delete','SatCont@delete');	

	Route::get('/status','SatCont@indexstat');
	Route::post('/status/create','SatCont@createstat');

	//supplier
	Route::get('/suplier','SupCont@index');
	Route::post('/suplier/create','SupCont@create');
	Route::get('/suplier/{id}/edit','SupCont@edit');
	Route::post('/suplier/{id}/update','SupCont@update');
	Route::get('/suplier/{id}/delete','SupCont@delete');	

	//barang
	Route::get('/barang','BrgCont@index');
	Route::post('/barang/create','BrgCont@create');
	Route::get('/barang/{id}/edit','BrgCont@edit');
	Route::post('/barang/{id}/update','BrgCont@update');
	Route::get('/barang/{id}/delete','BrgCont@delete');
	Route::delete('/barang/delete','BrgCont@delete')->name('pdDelete');
	Route::get('/apiBarang','ProductController@apiProducts')->name('api.barang');

	//sales
	Route::get('/sales','SalesCont@index');
	Route::post('/sales/create','SalesCont@create');
	Route::get('/sales/{id}/edit','SalesCont@edit');
	Route::post('/sales/{id}/update','SalesCont@update');
	Route::get('/sales/{id}/delete','SalesCont@delete');	

	//customer
	Route::get('/customer','CustCont@index');
	Route::post('/customer/create','CustCont@create');
	Route::get('/customer/{id}/edit','CustCont@edit');
	Route::post('/customer/{id}/update','CustCont@update');
	Route::get('/customer/{id}/delete','CustCont@delete');

	// beli
	Route::get('/beli','BeliCont@index');
	Route::post('/beli/store','BeliCont@store');
	Route::get('/beli/{id}/delete','BeliCont@delete_beli');	
	Route::get('/beli/{id}/edit','BeliCont@edit');
	Route::post('/beli/{id}/update','BeliCont@update');
	Route::get('/beli/finish/{id}','BeliCont@finish');

	Route::get('/detailbeli/{id}','BeliCont@detail');
	Route::post('/detailbeli/add','BeliCont@add_detail');
	Route::get('/detailbeli/{id}/delete','BeliCont@delete_detail');	
	Route::put('/detailbeli/{id}','BeliCont@update_detail');	
	
	// jual
	Route::get('/jual','jualCont@index');
	Route::post('/jual/store','jualCont@store');
	Route::get('/jual/{id}/delete','jualCont@delete_jual');	
	Route::get('/jual/{id}/edit','jualCont@edit');
	Route::post('/jual/{id}/update','jualCont@update');
	Route::get('/jual/finish/{id}','jualCont@finish');

	Route::get('/detailjual/{id}','jualCont@detail');
	Route::post('/detailjual/add','jualCont@add_detail');
	Route::get('/detailjual/{id}/delete','jualCont@delete_detail');	
	Route::put('/detailjual/{id}','jualCont@update_detail');	

	// Report
	Route::get('/buy_report','finishCont@indexbuy');
	Route::get('/sell_report','finishCont@indexsell');
	Route::get('/sell_detail/{id}','finishCont@sell_detail');
	Route::get('/sell/pdf/{id}','finishCont@exportpdf');
	
	// Route::get('/barang/ajax/{kode}','jualCont@get_brg');
});
	