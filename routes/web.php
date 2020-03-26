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

Route::get('/index/{id}',function($id){
	echo $id;
});
Route::get('/indexx','IndexController@indexx');
Route::get('/add','IndexController@add');
Route::post('/adddo','IndexController@adddo');
Route::post('/register','IndexController@register');
Route::get('/list','IndexController@list');
Route::get('/update{id}','IndexController@update');
Route::post('/brand/updates{id}','IndexController@updates');
Route::get('/delete{id}','IndexController@delete');
Route::get('/category/index','IndexController@index');
Route::post('/insert','IndexController@insert');
Route::get('/category/list','IndexController@lists');
Route::get('/category/delete{id}','IndexController@deletes');
Route::get('/category/update{id}','IndexController@upda');
Route::post('/category/upda{id}','IndexController@updas');


Route::get('/housing/index','Housing@index');
Route::post('/housing/insert','Housing@insert');
Route::get('/housing/list','Housing@list');



Route::prefix('books')->group(function(){
	Route::get('index','Books@index');
	Route::post('insert','Books@insert');
	Route::get('list','Books@list');
});

Route::prefix('goods_man')->group(function(){
	Route::get('index','Goods_man@index');
	Route::post('insert','Goods_man@insert');
	Route::get('list','Goods_man@list');
	Route::get('upda{id}','Goods_man@upda');
	Route::post('update{id}','Goods_man@update');

});

Route::prefix('news')->group(function(){
	Route::get('index','News@index')->middleware('islogin');
	Route::post('insert','News@insert');
	Route::get('list','News@list');
});

Route::get('login','LoginController@login');
Route::post('logindo','LoginController@logindo');

Route::prefix('article')->middleware('islogin')->group(function(){
	Route::get('index','Article@index');
	Route::get('insert','Article@insert');
	Route::get('list','Article@list');
	Route::get('delete{id}','Article@delete');
});


Route::get('/logs','Index\LoginController@log');
Route::get('/reg','Index\LoginController@reg');
Route::get('/reg/sendSMS','Index\LoginController@sendSMS');
Route::get('/reg/sendEmail','Index\LoginController@sendEmail');
Route::prefix('log')->group(function(){
	Route::post('insert','Index\LoginController@insert');
	Route::get('login','Index\LoginController@login');
	Route::get('index','Index\LoginController@index');
	Route::get('detail{id}','Index\LoginController@detail');
	Route::any('/doRegister','Index\LoginController@doRegister');
	Route::get('/cookie/add','Index\LoginController@addcookie');
	Route::get('/cookie/get','Index\LoginController@getcookie');
	//商品详情
	Route::get('goods{id}','Index\GoodsController@index')->name('goods');
	Route::post('addcart','Index\GoodsController@addcart');
	Route::post('/dolog','Index\LoginController@dologin');
	Route::get('cartlist','Index\GoodsController@cartlist');

	Route::get('pay','Index\GoodsController@pay');
	Route::get('success','Index\GoodsController@success');
	Route::get('pays','Index\GoodsController@pays');
	Route::post('wappaypay','Index\GoodsController@wappaypay');

});
Route::prefix('goods')->group(function(){
	Route::get('index','Goods@index');
	Route::post('insert','Goods@insert');
	Route::get('list','Goods@list');
});

Route::get('/home', 'HomeController@index')->name('home');
