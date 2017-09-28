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
    return redirect(route('dashboard'));
});

Auth::routes();

Route::middleware(['auth'])->group(function(){

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
    Route::get('/orders/paid-and-shipped', 'Order\OrderController@getPaidAndShippedList')->name('orders.paid_and_shipped');
    Route::get('/order/{id}', 'Order\OrderController@show')->name('order.show');
    Route::post('/tracking-number/save', 'Order\OrderController@saveTrackingNumber')->name('tracking_no.save');
    Route::post('/tracking-number/sync', 'Order\OrderController@syncTrackingNumber')->name('tracking_no.sync');

    Route::post('/order/invoice/save', 'Order\OrderController@saveInvoice')->name('invoice.save');
    Route::post('/order/submit', 'Order\OrderController@orderSubmit')->name('order.submit');

    Route::get('/listing/find', 'Item\ListingController@getFindListing')->name('item.listing.find');
    Route::get('/listing/new', 'Item\ListingController@getNewListing')->name('item.listing.new');
    Route::post('/listing/new/{store_id}', 'Item\ListingController@postNewListing')->name('item.listing.new.store');
    Route::get('/listing/active', 'Item\ListingController@getActiveListings')->name('item.listing.active');
    Route::get('/listing/{id}/revise', 'Item\ListingController@getReviseListing')->name('item.listing.revise');
    Route::post('/listing/{id}/revise', 'Item\ListingController@updateListing')->name('item.listing.update');
    Route::get('/listing/item/{id}', 'Item\ListingController@getItem')->name('item.listing.get');

    Route::get('ebay/find/{store_id}/{item_id}', 'Item\ItemController@findItem')->name('ebay.item.find');
});


Route::get('/store-price/sync', function(){
    dispatch(new \App\Jobs\SyncStorePriceJob());
    /*$priceService = new \App\Service\Store\PriceService();
    $priceService->saveKeystone();*/
});

Route::get('/store/listing/sync', function(){
    dispatch(new \App\Jobs\SyncStoreListing(\App\Models\Store::first()));
    //dd(\App\Service\Time::getDateFromISO8061Duration(\Carbon\Carbon::now(), 'PT23M'));
    //(new \App\Service\Store\ItemService())->syncListings(\App\Models\Store::first());

});

Route::get('/test', function(){
    
});

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');