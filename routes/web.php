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

Route::get('/test', function(){
    $client = new \GuzzleHttp\Client();
    $res = $client->request('GET', 'https://jsonplaceholder.typicode.com/posts/1');
    dd($res->getBody()->getContents());
});