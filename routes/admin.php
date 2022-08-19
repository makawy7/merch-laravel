<?php




Route::get('/admin', function () {
    return view('admin.index');
})->name('admindash');


Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){

  //Users
  Route::resource('/user','UserController');
  Route::post('/userdeletem','UserController@deletemusers')->name('user.deletem');
  Route::get('/usersetadmin/{id}','UserController@setadmin')->name('user.setadmin');

  //Admins
  Route::get('/admins','UserController@admins')->name('admin.index');
  Route::delete('/admin/{id}','UserController@destroyadmin')->name('admin.destroy');
  Route::post('/admindeletem','UserController@deletemadmins')->name('admin.deletem');
  Route::get('/revokeadmin/{id}','UserController@revokeadmin')->name('admin.revokeadmin');

  //Main Categories
  Route::resource('/maincat','MainCatController');
  Route::post('/maincatdeletem','MainCatController@deletem')->name('maincat.deletem');
  //Sub Categories
  Route::resource('/subcat','SubCatController');
  Route::post('/subcatdeletem','SubCatController@deletem')->name('subcat.deletem');
  //Types
  Route::resource('/type','TypeController');
  Route::post('/typedeletem','TypeController@deletem')->name('type.deletem');
  //Brands
  Route::resource('/brand','BrandController');
  Route::post('/branddeletem','BrandController@deletem')->name('brand.deletem');
  //products
  Route::resource('/product','ProductController');
  Route::post('/productdeletem','ProductController@deletem')->name('product.deletem');
  Route::get('/productminmax/{id}','ProductController@productminmax')->name('productminmax');
  //add product variation
  Route::get('/productaddvar/{id}','ProductController@addvariationshow')->name('add.variation');
  // Route::post('/productaddvar','ProductController@addvariation')->name('product.addvar');
  Route::post('/productaddvar','ProductController@storevariation')->name('store.variation');
  Route::put('/productaddvar','ProductController@updatevariation')->name('update.variation');
  Route::delete('/productaddvar','ProductController@deletevariation')->name('delete.variation');
  //Pre defined variations
  Route::post('/predefinedvar','ProductController@predefinedvar')->name('predefinedvar');
  //add variation options
  Route::get('/variationoptions/{id}','ProductController@addoptionsshow')->name('add.options');
  Route::post('/variationoptions','ProductController@addoptions')->name('var.addoptions');
  Route::delete('/variationoptions','ProductController@removeoptions')->name('var.removeoptions');
  Route::put('/variationoptions','ProductController@updateoptions')->name('var.updateoptions');
  //add extended options to product
  Route::get('/extoptions/{id}','ProductController@addextoption')->name('add.extoption');
  Route::post('/extoptions','ProductController@storeextoption')->name('store.extoption');
  Route::put('/extoptions','ProductController@updateextoption')->name('update.extoption');
  //Countries
  Route::get('/countries','AdminController@countries')->name('countries');
  Route::get('/addcountry','AdminController@addcountry')->name('addcountry');
  Route::post('/storecountry','AdminController@storecountry')->name('storecountry');
  Route::get('/editcountry/{id}','AdminController@editcountry')->name('editcountry');
  Route::post('/updatecountry/{id}','AdminController@updatecountry')->name('updatecountry');
  Route::delete('/destroycountry/{id}','AdminController@destroycountry')->name('destroycountry');
  Route::post('/deletemcountries','AdminController@deletemcountries')->name('deletemcountries');
  Route::get('/editcountriesorder','AdminController@editcountriesorder')->name('editcountriesorder');
  Route::post('/updatecountriesorder','AdminController@updatecountriesorder')->name('updatecountriesorder');
  //Cities
  Route::get('/cities','AdminController@cities')->name('cities');
  Route::get('/addcity','AdminController@addcity')->name('addcity');
  Route::post('/storecity','AdminController@storecity')->name('storecity');
  Route::get('/editcity/{id}','AdminController@editcity')->name('editcity');
  Route::post('/updatecity/{id}','AdminController@updatecity')->name('updatecity');
  Route::delete('/destroycity/{id}','AdminController@destroycity')->name('destroycity');
  Route::post('/deletemcities','AdminController@deletemcities')->name('deletemcities');
  Route::get('/editcitiesorder','AdminController@editcitiesorder')->name('editcitiesorder');
  Route::post('/updatecitiesorder','AdminController@updatecitiesorder')->name('updatecitiesorder');
  //Shipping Methods
  Route::get('/shippingmethods','AdminController@shippingmethods')->name('shippingmethods');
  Route::get('/addshippingmethod','AdminController@addshippingmethod')->name('addshippingmethod');
  Route::post('/storeshippingmethod','AdminController@storeshippingmethod')->name('storeshippingmethod');
  Route::get('/editshippingmethod/{id}','AdminController@editshippingmethod')->name('editshippingmethod');
  Route::post('/updateshippingmethod/{id}','AdminController@updateshippingmethod')->name('updateshippingmethod');
  Route::delete('/destroyshippingmethod/{id}','AdminController@destroyshippingmethod')->name('destroyshippingmethod');
  Route::post('/deletemshippingmethods','AdminController@deletemshippingmethods')->name('deletemshippingmethods');
  //Currencies
  Route::get('/currencies','AdminController@currencies')->name('currencies');
  Route::get('/addcurrency','AdminController@addcurrency')->name('addcurrency');
  Route::post('/storecurrency','AdminController@storecurrency')->name('storecurrency');
  Route::get('/editcurrency/{id}','AdminController@editcurrency')->name('editcurrency');
  Route::post('/updatecurrency/{id}','AdminController@updatecurrency')->name('updatecurrency');
  Route::delete('/destroycurrency/{id}','AdminController@destroycurrency')->name('destroycurrency');
  Route::post('/deletemcurrencies','AdminController@deletemcurrencies')->name('deletemcurrencies');
  Route::get('/editcurrenciesorders','AdminController@editcurrenciesorders')->name('editcurrenciesorders');
  Route::post('/updatecurrenciesorders','AdminController@updatecurrenciesorders')->name('updatecurrenciesorders');
  //Settings
  Route::get('/settings','AdminController@menusettings')->name('settings');
  Route::put('/store_settings','AdminController@storesettings')->name('store_settings');

  //Payment Methods
  Route::get('/paymentmethods','AdminController@paymentmethods')->name('paymentmethods');
  Route::get('/addpaymentmethod','AdminController@addpaymentmethod')->name('addpaymentmethod');
  Route::post('/storepaymentmethod','AdminController@storepaymentmethod')->name('storepaymentmethod');
  Route::get('/editpaymentmethod/{id}','AdminController@editpaymentmethod')->name('editpaymentmethod');
  Route::post('/updatepaymentmethod/{id}','AdminController@updatepaymentmethod')->name('updatepaymentmethod');
  Route::delete('/destroypaymentmethod/{id}','AdminController@destroypaymentmethod')->name('destroypaymentmethod');
  Route::post('/deletempaymentmethods','AdminController@deletempaymentmethods')->name('deletempaymentmethods');
  Route::get('/editpaymentmethodsorder','AdminController@editpaymentmethodsorder')->name('editpaymentmethodsorder');
  Route::post('/updatepaymentmethodsorder','AdminController@updatepaymentmethodsorder')->name('updatepaymentmethodsorder');
  //Order Statuses
  Route::get('/statuses','AdminController@statuses')->name('statuses');
  Route::get('/addstatus','AdminController@addstatus')->name('addstatus');
  Route::post('/storestatus','AdminController@storestatus')->name('storestatus');
  Route::get('/editstatus/{id}','AdminController@editstatus')->name('editstatus');
  Route::post('/updatestatus/{id}','AdminController@updatestatus')->name('updatestatus');
  Route::delete('/destroystatus/{id}','AdminController@destroystatus')->name('destroystatus');
  Route::post('/deletemstatuses','AdminController@deletemstatuses')->name('deletemstatuses');
  //Orders
  Route::get('/orders','AdminController@orders')->name('orders');
  Route::get('/orders/{ordernumber}','AdminController@orderdetails')->name('orderdetails');
  Route::post('/changestatus','AdminController@changestatus')->name('changestatus');
  Route::post('/submitdetails/{id}','AdminController@submitdetails')->name('submitdetails');
  Route::get('/deliveredorders','AdminController@deliveredorders')->name('deliveredorders');
  //Sellers Subscriptions Plans
  Route::resource('/plans','PlanController');
  Route::post('/plansdeletem','PlanController@deletem')->name('plans.deletem');
  Route::get('/editplansorder','PlanController@editorder')->name('plans.editorder');
  Route::post('/updateplansorder','PlanController@updateorder')->name('plans.updateorder');
  //Sellers Subscriptions Payment Methods
  Route::resource('/subpaymentmethods','SubpaymentmethodsController');
  Route::post('/subpaymentmethodsdeletem','SubpaymentmethodsController@deletem')->name('subpaymentmethods.deletem');
  //Subscriptions
  Route::get('/subscriptions','AdminController@subscriptions')->name('subscriptions');
  Route::get('/activatesubscription/{id}','AdminController@activatesubscription')->name('activatesubscription');
  Route::get('/deactivatesubscription/{id}','AdminController@deactivatesubscription')->name('deactivatesubscription');
  Route::get('/deletesubscription/{id}','AdminController@deletesubscription')->name('deletesubscription');
  Route::get('/editsubscription/{id}','AdminController@editsubscription')->name('editsubscription');
  Route::post('/updatesubscription/{id}','AdminController@updatesubscription')->name('updatesubscription');
  //Change Plan Requests
  Route::get('/approverequest/{userid}/{reqid}','AdminController@approverequest')->name('approverequest');

  //Stores
  Route::get('/stores','AdminController@stores')->name('stores');
  //Profits
  Route::get('/profits','AdminController@profits')->name('profits');
  Route::get('/storesprofits','AdminController@storesprofits')->name('storesprofits');
  Route::get('/getstoreprofits','AdminController@getstoreprofits')->name('getstoreprofits');
  Route::get('/storeprofits/{id}','AdminController@storeprofits')->name('getstoreprofits');
  //Rewards
  Route::get('/rewards','AdminController@rewards')->name('rewards');
  Route::post('/storerewards','AdminController@storerewards')->name('storerewards');
  //Manage Main Page
  //Banners
  Route::get('/banners','AdminController@banners')->name('banners');
  Route::get('/createbanner','AdminController@createbanner')->name('createbanner');
  Route::post('/storebanner','AdminController@storebanner')->name('storebanner');
  Route::get('/editbanner/{id}','AdminController@editbanner')->name('editbanner');
  Route::post('/updatebanner/{id}','AdminController@updatebanner')->name('updatebanner');
  Route::delete('/destroybanner/{id}','AdminController@destroybanner')->name('destroybanner');
  Route::post('/deletembanners','AdminController@deletembanners')->name('deletembanners');
  //Ads
  Route::get('/ads','AdminController@ads')->name('ads');
  Route::get('/createad','AdminController@createad')->name('createad');
  Route::post('/storead','AdminController@storead')->name('storead');
  Route::get('/editad/{id}','AdminController@editad')->name('editad');
  Route::post('/updatead/{id}','AdminController@updatead')->name('updatead');
  Route::delete('/destroyad/{id}','AdminController@destroyad')->name('destroyad');
  Route::post('/deletemads','AdminController@deletemads')->name('deletemads');
  //Special Categories
  Route::get('/scats','AdminController@scats')->name('scats');
  Route::get('/createscat','AdminController@createscat')->name('createscat');
  Route::post('/storescat','AdminController@storescat')->name('storescat');
  Route::get('/editscat/{id}','AdminController@editscat')->name('editscat');
  Route::post('/updatescat/{id}','AdminController@updatescat')->name('updatescat');
  Route::delete('/destroyscat/{id}','AdminController@destroyscat')->name('destroyscat');
  Route::post('/deletemscats','AdminController@deletemscats')->name('deletemscats');
  //Contact Us Messages
  Route::get('/contactusmessages','AdminController@contactusmessages')->name('contactus_messages');
  //Store Messages
  Route::get('/adminmessages','AdminController@adminmessages')->name('adminmessages');
  Route::get('/adminmessage/{id}','AdminController@adminmessage')->name('adminmessage');
  Route::post('/adminsend/{id}','AdminController@adminsend')->name('adminsend');

  Route::get('/var',function(){
    return view('admin.products.add_variation');
  });
});
