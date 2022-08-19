<?php




Route::group(['prefix'=>'seller','namespace'=>'Seller'],function(){

  Route::get('/','SellerController@index')->name('sellerindex');
  Route::get('/storesettings','SellerController@storesettings')->name('storesettings');
  Route::post('/updatestore/{id}','SellerController@updatestore')->name('updatestore');


  //Add Staff Members To The Store
  Route::post('/addstaff/{id}','SellerController@addstaff')->name('addstaff');
  //Delete Store Staff Member
  Route::get('/deletestaff/{id}','SellerController@deletestaff')->name('deletestaff');
  //Request To Chnage Store Plan
  Route::post('/changeplan','SellerController@changeplan')->name('changeplan');


  //products
  Route::get('/products','ProductController@index')->name('seller.product.index');
  Route::get('/product/create','ProductController@create')->name('seller.product.create');
  Route::post('/product/store','ProductController@store')->name('seller.product.store');
  Route::get('/product/{id}/edit','ProductController@edit')->name('seller.product.edit');
  Route::put('/product/{id}/update','ProductController@update')->name('seller.product.update');
  Route::delete('/product/destroy','ProductController@destroy')->name('seller.product.destroy');
  Route::post('/productdeletem','ProductController@deletem')->name('seller.product.deletem');
  Route::get('/productminmax/{id}','ProductController@productminmax')->name('seller.productminmax');
  //add product variation
  Route::get('/productaddvar/{id}','ProductController@addvariationshow')->name('seller.add.variation');
  // Route::post('/productaddvar','ProductController@addvariation')->name('seller.product.addvar');
  Route::post('/productaddvar','ProductController@storevariation')->name('seller.store.variation');
  Route::put('/productaddvar','ProductController@updatevariation')->name('seller.update.variation');
  Route::delete('/productaddvar','ProductController@deletevariation')->name('seller.delete.variation');
  //add variation options
  Route::get('/variationoptions/{id}','ProductController@addoptionsshow')->name('seller.add.options');
  Route::post('/variationoptions','ProductController@addoptions')->name('seller.var.addoptions');
  Route::delete('/variationoptions','ProductController@removeoptions')->name('seller.var.removeoptions');
  Route::put('/variationoptions','ProductController@updateoptions')->name('seller.var.updateoptions');
  //add extended options to product
  Route::get('/extoptions/{id}','ProductController@addextoption')->name('seller.add.extoption');
  Route::post('/extoptions','ProductController@storeextoption')->name('seller.store.extoption');
  Route::put('/extoptions','ProductController@updateextoption')->name('seller.update.extoption');



  //Store Messages
  Route::get('/sellermessages','SellerController@sellermessages')->name('sellermessages');
  Route::get('/sellermessage/{id}','SellerController@sellermessage')->name('sellermessage');
  Route::post('/sellersend/{id}','SellerController@sellersend')->name('sellersend');

  //Profits
  Route::get('/profits','SellerController@profits')->name('storeprofits');
});
