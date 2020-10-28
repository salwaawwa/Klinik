<?php

use Illuminate\Support\Facades\Route;

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
    return redirect()->route('login');
});

/**
 * 
 * Route Auth
 * 
 */

Route::group(['middleware' => 'guest'], function() {
    Route::get('login', 'Auth\AuthController@loginView')->name('login');
    Route::post('login', 'Auth\AuthController@login')->name('login');
    
    // Route::get('register', 'Auth\AuthController@registerView')->name('register');
    // Route::post('register', 'Auth\AuthController@register')->name('register');
});

Route::group (['middleware' => 'auth'], function(){

	/**
	 * 
	 * Route Dashboard
	 * 
	 */
	Route::get('perhitungan-perperiode/{tglawal}/{tglakhir}','DashboardController@perhitungan')->name('perhitungan-perperiode');
	Route::resource('dashboard', 'DashboardController')->except(['show'])->middleware('auth');

	//logout
	Route::get('logout', 'Auth\AuthController@logout')->name('logout');

	//user
	Route::get('user/setting', 'UserController@form')->name('user.setting');
	Route::post('user/setting', 'UserController@update_form');
	Route::get('user/data','UserController@data')->name('user.data');
	Route::get('users/{id}/destroy', 'UserController@destroy')->name('user.destroy');
	Route::resource('user','UserController')->except(['destroy']);

	//Produk
	Route::get('produk/data','ProdukController@data')->name('produk.data');
	Route::get('produk/show','ProdukController@show')->name('produk.show');
	Route::get('produk/print','ProdukController@print')->name('produk.print');
	Route::get('produk/{id}/destroy', 'ProdukController@destroy')->name('produk.destroy');
	Route::resource('produk','ProdukController')->except(['destroy','show']);

	//Transaksi
	Route::get('transaksi/{id}/cetak-detal','TransaksiController@cetakDetail')->name('transaksi.cetakdet');
	Route::get('transaksi/data','TransaksiController@data')->name('transaksi.data');
	Route::get('transaksi/print','TransaksiController@print')->name('transaksi.print');
	Route::get('transaksi/{id}/destroy', 'TransaksiController@destroy')->name('transaksi.destroy');
	Route::post('transaksi/confim','TransaksiController@confirm')->name('transaksi.confirm');
	Route::resource('transaksi','TransaksiController')->except(['destroy']);

});