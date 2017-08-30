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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'DashboardController@getDashboard')->name('dashboard');
Route::resource('/dashboard/store', 'Store\StoreController');
Route::get('/orders', 'Order\OrderController@getAll')->name('orders.all');
Route::get('/order/{id}', 'Order\OrderController@show')->name('order.show');
Route::post('/tracking-number/save', 'Order\OrderController@saveTrackingNumber')->name('tracking_no.save');
Route::get('/price/{sku}', 'Store\ItemController@getStorePrices')->name('price.get');


Route::get('/price/sync', function(){

});

Route::get('/test', function(){
/*    $client = new \GuzzleHttp\Client();
    $resource = fopen(__DIR__ . '../test.xlsx', 'w');
    $stream = GuzzleHttp\Psr7\stream_for($resource);
    $client->request('GET', 'http://127.0.0.1:3000/test.xlsx', ['save_to' => $stream]);*/
    return 'asdadd';
});