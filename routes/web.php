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
Route::get('store/{id}/user/manage', 'UserController@getStoreUsers')->name('store.user.manage');
Route::post('store/{id}/user/add', 'UserController@addUserToStore')->name('store.user.add');
Route::get('store/{store_id}/user/{user_id}/permission', 'UserController@showUsersPermission')->name('store.user.permission');
Route::post('store/{store_id}/user/{user_id}/permission', 'UserController@updateUsersPermission')->name('store.user.permission.update');
Route::get('/store/price/', 'Store\ItemController@getStorePrices')->name('store.price.get');

Route::get('/orders', 'Order\OrderController@getAll')->name('orders.all');
Route::get('/orders/awaiting-payment', 'Order\OrderController@getAwaitingPaymentOrders')->name('orders.awaiting_payment');
Route::get('/orders/awaiting-shipment', 'Order\OrderController@getAwaitingShipmentOrders')->name('orders.awaiting_shipment');
Route::get('/orders/awaiting-order', 'Order\OrderController@getAwaitingOrderList')->name('orders.awaiting_order');
Route::get('/orders/print-label', 'Order\OrderController@getPrintLabelList')->name('orders.print_label');
Route::get('/orders/awaiting-tracking', 'Order\OrderController@getAwaitingTrackingList')->name('orders.awaiting_tracking');
Route::get('/order/{id}', 'Order\OrderController@show')->name('order.show');
Route::post('/tracking-number/save', 'Order\OrderController@saveTrackingNumber')->name('tracking_no.save');

Route::post('/order/invoice/save', 'Order\OrderController@saveInvoice')->name('invoice.save');
Route::post('/order/submit', 'Order\OrderController@orderSubmit')->name('order.submit');


Route::get('/store-price/sync', function(){
    $service = app(\App\Service\Store\PriceService::class);
    $service->save();
});

Route::get('/test', function(){

});