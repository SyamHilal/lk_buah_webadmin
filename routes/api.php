<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// toko 
Route::get('showalamat', 'admin\PengaturanController@get_alamat_toko');

// user 
Route::post('register', 'UserController@registerUser');
Route::post('login', 'UserController@loginUser');
Route::post('updateUser', 'UserController@updateUser');

// produk 
Route::get('showproduct', 'user\ProdukController@index');
Route::post('cariproduct', 'user\ProdukController@cari');
Route::get('transaksi/{id?}', 'user\OrderController@get_transaksi');

// keranjang 
Route::post('showkranjang', 'user\KeranjangController@index');
Route::post('simpankranjang','user\KeranjangController@simpan');
Route::post('updatekranjang','user\KeranjangController@update');
Route::post('deletekranjang','user\KeranjangController@delete');

// Order
Route::post('/order/simpan','user\OrderController@simpan')->name('user.order.simpan');
Route::post('/handling/notification', 'user\OrderController@notification');
Route::get('/handling/finish/', 'user\OrderController@sukses');
Route::post('confirm', 'user\OrderController@confirmation');
Route::post('cancel', 'user\OrderController@cancelOrder');
Route::post('notificationMidtrans', 'user\OrderController@notificationMidtrans');