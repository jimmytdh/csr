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

Route::get('/','HomeCtrl@index');

Route::get('/logout','LoginCtrl@logoutUser');
Route::get('/login','LoginCtrl@index')->middleware('isLogin');
Route::post('/login/validate','LoginCtrl@validateLogin');


//SUPPLIES
Route::get('/supply','SupplyCtrl@index');
Route::get('/supply/list','SupplyCtrl@getSupplies');
Route::get('/supply/brand','SupplyCtrl@getBrands');
Route::post('/supply/save','SupplyCtrl@save');

//END SUPPLY

//STOCKS
Route::get('/stock/{id}','StockCtrl@index');
Route::get('/stock/delete/{id}','StockCtrl@delete');
Route::post('/stock/update/qty/{id}','StockCtrl@updateQty');
Route::post('/stock/update/expiry/{id}','StockCtrl@updateExpiry');
//END STOCKS


