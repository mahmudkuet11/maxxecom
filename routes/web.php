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
Route::get('/orders/awaiting-payment', 'Order\OrderController@getAwaitingPaymentOrders')->name('orders.awaiting_payment');
Route::get('/orders/awaiting-shipment', 'Order\OrderController@getAwaitingShipmentOrders')->name('orders.awaiting_shipment');
Route::get('/orders/awaiting-order', 'Order\OrderController@getAwaitingOrderList')->name('orders.awaiting_order');
Route::get('/order/{id}', 'Order\OrderController@show')->name('order.show');
Route::post('/tracking-number/save', 'Order\OrderController@saveTrackingNumber')->name('tracking_no.save');
Route::get('/store/price/', 'Store\ItemController@getStorePrices')->name('store.price.get');
Route::post('/order/invoice/save', 'Order\OrderController@saveInvoice')->name('invoice.save');
Route::post('/order/submitted', 'Order\OrderController@orderSubmitted')->name('order.submitted');


Route::get('/store-price/sync', function(){
    $service = app(\App\Service\Store\PriceService::class);
    $service->save();
});

Route::get('/test', function(){
    dispatch(new \App\Jobs\SetupStoreJob(\App\Models\Store::find(2)));
});