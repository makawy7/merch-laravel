<?php

//Locale change
Route::get('lang/{lang}',function($lang){
  if(!empty($lang)){
    ((session()->has('lang'))?session()->forget('lang'):'');
    (($lang=='ar')?session()->put('lang','ar'):session()->put('lang','en'));
  }
  return back();
})->name('lang');

Auth::routes();
Auth::routes(['verify' => true]);
//Adminlogin
Route::get('/admin/login','Admin\AdminController@adminlogin')->name('adminlogin');


Route::get('/','HomeController@index')->name('index');

//Products
Route::get('/products/{slug}','HomeController@showproduct')->name('show.product');
Route::get('/sub/{slug}','HomeController@showsubcat')->name('show.subcat');
Route::get('/type/{slug}','HomeController@showtype')->name('show.type');
Route::get('/extoptions','HomeController@getextoptions')->name('get.extoptions');

//Best Selling
Route::get('/bestselling','HomeController@bestselling')->name('bestselling');
//Newly Listed
Route::get('/newlylisted','HomeController@newlylisted')->name('newlylisted');

Route::get('/currencychange/{id}','HomeController@currencychange')->name('currencychange');
Route::get('/login','HomeController@login')->name('login');


Route::resource('/cart','CartController');
Route::get('/guestcart','CartController@guestcart')->name('guestcart');
Route::post('/updatequantity','CartController@updatecartquantity')->name('updatequantity');
Route::post('/deletefromcart','CartController@deletefromcart')->name('deletefromcart');
Route::post('/addtocart','CartController@addtocart')->name('addtocart');
Route::get('/shippingaddress','CartController@shippingaddress')->name('shippingaddress');
Route::get('/shippingmethod','CartController@shippingmethod')->name('shippingmethod');
Route::post('/shippingselected','CartController@shippingselected')->name('shippingselected');
Route::get('/paymentmethod','CartController@paymentmethod')->name('paymentmethod');
Route::post('/submitorder','CartController@submitorder')->name('submitorder');
Route::get('/orderplaced/{ordergroup}','CartController@orderplaced')->name('orderplaced');

//User
Route::get('/myorders','UserController@myorders')->name('myorders');
Route::get('/myaccount','UserController@myaccount')->name('myaccount');
Route::get('/account','UserController@account')->name('account');
Route::put('/updateaccount','UserController@updateaccount')->name('updateaccount');
Route::put('/changepassword','UserController@changepassword')->name('changepassword');
Route::get('/verifyphone','UserController@verifyphone')->name('verifyphone');
Route::post('/sendcode','UserController@sendcode')->name('sendcode');
Route::post('/confirmcode','UserController@confirmcode')->name('confirmcode');

Route::get('/addresses','UserController@addresses')->name('addresses');
Route::post('/addnewaddress','UserController@addnewaddress')->name('addnewaddress');
Route::get('/editaddress/{id}','UserController@editaddress')->name('editaddress');
Route::put('/updateaddress/{id}','UserController@updateaddress')->name('updateaddress');
Route::delete('/destroyaddress/{id}','UserController@destroyaddress')->name('destroyaddress');
Route::get('/myorders/{ordernumber}','UserController@orderdetails')->name('userorderdetails');
Route::get('/order/{ordernumber}','UserController@order_details')->name('order_details');


//Pages
Route::get('/privacypolicy','HomeController@privacypolicy')->name('privacypolicy');
Route::get('/returnpolicy','HomeController@returnpolicy')->name('returnpolicy');
Route::get('/terms','HomeController@terms')->name('terms');


//Comments & Ratings
Route::post('/addcomment','HomeController@addcomment')->name('addcomment');
Route::get('/deletecomment/{id}','HomeController@deletecomment')->name('deletecomment');

//Wish List
Route::post('/addtowishlist','UserController@addtowishlist')->name('addtowishlist');
Route::get('/wishlist','UserController@wishlist')->name('wishlist');
Route::get('/addtowatchlist/{id}','UserController@addtowatchlist')->name('addtowatchlist');

//product search
Route::get('/search','HomeController@search')->name('search');


//Seller
Route::get('/subscribe','HomeController@subscribe')->name('subscribe');
Route::post('/submitplan','HomeController@submitplan')->name('submitplan');
Route::post('/submitpayment','HomeController@submitpayment')->name('submitpayment');
Route::post('/submitsub','HomeController@submitsub')->name('submitsub');
Route::get('/reviewsubrequest','HomeController@reviewsubrequest')->name('reviewsubrequest');
Route::get('/confirmsubscribe','HomeController@confirmsubscribe')->name('confirmsubscribe');
Route::post('/createstore','HomeController@createstore')->name('createstore');
Route::get('/createstore','HomeController@create_store')->name('create_store');
Route::get('/getcansell','HomeController@getcansell')->name('getcansell');

//Store
Route::get('/store/{id}','HomeController@store')->name('store');

//Notifications
Route::get('notifications/{id}','HomeController@notifications')->name('notifications');
//Contact Us
Route::get('/contactus','HomeController@contactus')->name('contactus');
Route::post('/contactus','HomeController@contact_us')->name('contact_us');

//Messages
Route::get('/messages/{id}','MessageController@messages')->name('messages');
Route::post('/sendmessage/{id}','MessageController@sendmessage')->name('sendmessage');
Route::get('/inbox','MessageController@inbox')->name('inbox');

Route::post('/selectshipping','AddressController@selectshipping')->name('selectshipping');

Route::get('/cart-data', function () {
    return view('site.pages.cart_data');
});
