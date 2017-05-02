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

/*Route::get('/', function () {
    return view('welcome');
});*/





Route::get('/', ['uses' => 'ProductController@getIndex' , 'as' => 'product.index']);

Route::get('/add-to-cart/{id}',[
		'uses' => 'ProductController@getAddToCart',
		 'as' => 'product.addToCart'
	]);


Route::get('/view_product_details/{id}',[
	'uses' => 'ProductController@viewD', 
	'as' => 'product.productDetails'
	]);


//Route::post('/view',['uses'=>'ProductController@postComents','as'=>'view.c']);
Route::post('/createseller','ProductController@postComents');
/*Route::any('users/{id}', function() {
    //
});*/

Route::get('/autocomplete',array('as'=>'autocomplete','uses'=>'ProductController@autocomplete'));

Route::get('/reduce/{id}',[
		'uses' => 'ProductController@getReduceByOne', 'as' => 'product.reduceByOne'
	]);


Route::get('/remove/{id}',[
		'uses' => 'ProductController@getRemoveItem', 'as' => 'product.removeItem'
	]);



Route::get('/shopping-cart',[
		'uses' => 'ProductController@getCart', 'as' => 'product.shoppingCart'
	]);



Route::get('/checkout',[
		'uses' => 'ProductController@getCheckout', 'as' => 'checkout',
		'middleware' => 'auth1'
	]);


Route::post('/checkout',[
		'uses' => 'ProductController@postCheckout', 'as' => 'checkout',
		'middleware' => 'auth1'
		]);


Route::group(['prefix' => 'user'],function(){
	// Route::group(['middleware' => 'guest'], function(){

	Route::get('/signup',['uses' => 'UserController@getSignup',
		'as' => 'user.signup'
		]);

	Route::post('/signup',['uses' => 'UserController@postSignup',
		'as' => 'user.signup'
		]);


	Route::get('/signin',['uses' => 'UserController@getSignin',
		'as' => 'user.signin'
		]);

	Route::post('/signin',['uses' => 'UserController@postSignin',
		'as' => 'user.signin'
		]);

	// });
	

	Route::group(['middleware' => 'auth1'], function(){


	Route::get('/profile',['uses' => 'UserController@getProfile',
		'as' => 'user.profile'
		]);

	Route::get('/logout',['uses' => 'UserController@getLogout',
		'as' => 'user.logout'
		]);
});

});




