<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Country;
use App\City;
use App\Shippingmethod;
use App\Currency;
use App\Setting;
use App\Paymentmethod;
use App\Orderstatus;
use App\Ordergroup;
use App\Order;
use App\Store;
use App\Reward;
use App\Banner;
use App\User;
use App\Ad;
use App\Message;
use App\Contactus;
use App\Specialcat;
use App\Subscription;
use App\Changerequest;
use Carbon\Carbon;
use App\Notifications\OrderGroupStatus;
use Image;
use Storage;
use Artisan;
use DB;

class AdminController extends Controller
{

//////////////////////////////////////////ADMIN LOGIN////////////////////////////////////////////////////////////

public function adminlogin(){
  return view('admin.login');
}

//////////////////////////////////////////SETTINGS///////////////////////////////////////////////////////////////

public function menusettings(){
  return view('admin.settings.settings');
}

public function storesettings(Request $request){

  $setting=Setting::find(1);

  $rules = [
    'name'                      =>'required',
    'name_ar'                   =>'required',
    // 'icon'                      =>'required',
    // 'logo'                      =>'required',
    'terms'                     =>'required',
    'terms_ar'                  =>'required',
    'return_policy'             =>'required',
    'return_policy_ar'          =>'required',
    'privacy_policy'            =>'required',
    'privacy_policy_ar'         =>'required',
    'address'                   =>'required',
    'address_ar'                =>'required',
    'phone'                     =>'required|numeric',
    'email'                     =>'required|email',
    'default_lang'              =>'required',
    'default_currency'          =>'required',
    'tags'                      =>'required',
    'status'                    =>'required',
    'maintenance_msg'           =>'required',
    'maintenance_msg_ar'        =>'required',
    'points_value'              =>'required',

  ];

  $messages = [
    'name.required'                  =>trans('admindash.validator.settingname_required'),
    'name_ar.required'               =>trans('admindash.validator.settingname_ar_required'),
    // 'icon.required'                  =>trans('admindash.validator.settingicon_required'),
    // 'logo.required'                  =>trans('admindash.validator.settinglogo_required'),
    'terms.required'                 =>trans('admindash.validator.settingterms_required'),
    'terms_ar.required'              =>trans('admindash.validator.settingterms_ar_required'),
    'return_policy.required'         =>trans('admindash.validator.settingreturn_policy_required'),
    'return_policy_ar.required'      =>trans('admindash.validator.settingreturn_policy_ar_required'),
    'privacy_policy.required'        =>trans('admindash.validator.settingprivacy_policy_required'),
    'privacy_policy_ar.required'     =>trans('admindash.validator.settingprivacy_policy_ar_required'),
    'address.required'               =>trans('admindash.validator.settingaddress_required'),
    'address_ar.required'            =>trans('admindash.validator.settingaddress_ar_required'),
    'phone.required'                 =>trans('admindash.validator.settingphone_required'),
    'phone.numeric'                  =>trans('admindash.validator.settingphone_numeric'),
    'email.required'                 =>trans('admindash.validator.settingemail_required'),
    'email.email'                    =>trans('admindash.validator.settingemail_email'),
    'default_lang.required'          =>trans('admindash.validator.settingdefault_lang_required'),
    'default_currency.required'      =>trans('admindash.validator.settingdefault_currency_required'),
    'tags.required'                  =>trans('admindash.validator.settingtags_required'),
    'status.required'                =>trans('admindash.validator.settingstatus_required'),
    'maintenance_msg.required'       =>trans('admindash.validator.settingmaintenance_msg_required'),
    'maintenance_msg_ar.required'    =>trans('admindash.validator.settingmaintenance_msg_ar_required'),
    'points_value.required'          =>trans('admindash.validator.points_value_required'),
  ];
  $data=Validator::make(request()->all(),$rules,$messages)->validate();

  if($request->hasFile('icon')){
    $img = Image::make($request->icon);
    $image_name='icon_'.time().$request->file('icon')->getClientOriginalName();
    $path = public_path('storage/images/setting/'.$image_name);
    $img->save($path);
    Storage::delete('public/images/setting/'.$setting->icon);
    $setting->update(['icon'=>$image_name]);
  }

  if($request->hasFile('logo')){
    $img = Image::make($request->logo);
    $image_name='logo_'.time().$request->file('logo')->getClientOriginalName();
    $path = public_path('storage/images/setting/'.$image_name);
    $img->save($path);
    Storage::delete('public/images/setting/'.$setting->logo);
    $setting->update(['logo'=>$image_name]);
  }
  // return $request->status;
  if($setting->status != $request->status){
    if($request->status == 0){
      Artisan::call('down');
    }else {
      Artisan::call('up');
    }
  }

  $setting->update($request->except(['icon','logo']));


  session()->flash('success',trans('admindash.messages.settingsaved'));
  return back();
}
//////////////////////////////////////////COUNTRIES///////////////////////////////////////////////////////////////

    public function countries(){
      $countries=Country::all();
      return view('admin.countries.manage_countries',compact('countries'));
    }

    public function addcountry(){
      return view('admin.countries.add_country');
    }

    public function storecountry(Request $request){
      $rules = [
        'name'                      =>'required_without:name_ar',
        'name_ar'                   =>'required_without:name',
        'code'                      =>'required',
      ];

      $messages = [
        'name.required_without'           =>trans('admindash.validator.countryname_required'),
        'name_ar.required_without'        =>trans('admindash.validator.countryname_ar_required'),
      ];

      $data=Validator::make(request()->all(),$rules,$messages)->validate();
      Country::create([
          'name'=>$request->name?$request->name:$request->name_ar,
          'name_ar'=>$request->name_ar?$request->name_ar:$request->name,
          'code'=>$request->code
        ]);
      session()->flash('success',trans('admindash.messages.countryadded'));
      return redirect()->route('countries');
    }

    public function editcountry($id){
      $country=Country::find($id);
      return view('admin.countries.edit_country',compact('country'));
    }

    public function updatecountry(Request $request,$id){
      $country=Country::find($id);

      $rules = [
        'name'                      =>'required_without:name_ar',
        'name_ar'                   =>'required_without:name',
        'code'                      =>'required',
      ];

      $messages = [
        'name.required_without'           =>trans('admindash.validator.countryname_required'),
        'name_ar.required_without'        =>trans('admindash.validator.countryname_ar_required'),
      ];

      $data=Validator::make(request()->all(),$rules,$messages)->validate();
      $country->update([
          'name'=>$request->name?$request->name:$request->name_ar,
          'name_ar'=>$request->name_ar?$request->name_ar:$request->name,
          'code'=>$request->code
        ]);
      session()->flash('success',trans('admindash.messages.countryupdated'));
      return redirect()->route('countries');
    }

    public function destroycountry($id)
    {
          $country=Country::find($id);
          $name=$country->getName();
          $delete=$country->delete();
          if($delete){
            session()->flash('success',trans('admindash.messages.countrydeleted',['name'=>$name]));
          }
          return redirect()->route('countries');
    }

    public function deletemcountries(Request $request)
    {
        if(!empty($request->ids)){
          $ids=rtrim($request->ids,',');
          $idsArray=explode(',',$ids);
          $deleted='';
          foreach($idsArray as $id){
              $country=Country::find($id);
              $deleted.=trans('admindash.messages.countrydeleted',['name'=>$country->getName()]).'<br>';
              $country->delete();
          }
          session()->flash('success',$deleted);
          return redirect()->route('countries');
      }
    }

    public function editcountriesorder(){
      $countries=Country::orderBy('order','asc')->get();
      return view('admin.countries.editorder',compact('countries'));
    }

    public function updatecountriesorder(Request $request){
      $countries=Country::orderBy('order','asc')->get();
      $orders=$request->orders;
      $counter=0;
      foreach($countries as $country){
          $country->update([
            'order'=>$orders[$counter]
          ]);
        $counter++;
      }
      session()->flash('success','Countries order updated successfully');
      return back();
    }
//////////////////////////////////////////CITIES///////////////////////////////////////////////////////////////

    public function cities(){
        $cities=City::all();
        return view('admin.cities.manage_cities',compact('cities'));
    }

    public function addcity(){
      $countries=Country::all();
      return view('admin.cities.add_city',compact('countries'));
    }

    public function storecity(Request $request){
      $rules = [
        'name'                      =>'required_without:name_ar',
        'name_ar'                   =>'required_without:name',
        'country_id'                =>'required',
      ];

      $messages = [
        'name.required_without'           =>trans('admindash.validator.cityname_required'),
        'name_ar.required_without'        =>trans('admindash.validator.cityname_ar_required'),
        'country_id.required'     =>trans('admindash.validator.country_id_required'),
      ];

      $data=Validator::make(request()->all(),$rules,$messages)->validate();
      City::create([
          'name'=>$request->name?$request->name:$request->name_ar,
          'name_ar'=>$request->name_ar?$request->name_ar:$request->name,
          'country_id'=>$request->country_id
        ]);
      session()->flash('success',trans('admindash.messages.cityadded'));
      return redirect()->route('cities');
    }

    public function editcity($id){
      $city=City::find($id);
      $countries=Country::all();
      return view('admin.cities.edit_city',compact('city','countries'));
    }

    public function updatecity(Request $request,$id){
      $city=City::find($id);

      $rules = [
        'name'                      =>'required_without:name_ar',
        'name_ar'                   =>'required_without:name',
        'country_id'                =>'required',
      ];

      $messages = [
        'name.required_without'           =>trans('admindash.validator.cityname_required'),
        'name_ar.required_without'        =>trans('admindash.validator.cityname_ar_required'),
        'country_id.required'     =>trans('admindash.validator.country_id_required'),
      ];

      $data=Validator::make(request()->all(),$rules,$messages)->validate();
      $city->update([
          'name'=>$request->name?$request->name:$request->name_ar,
          'name_ar'=>$request->name_ar?$request->name_ar:$request->name,
          'country_id'=>$request->country_id
        ]);
      session()->flash('success',trans('admindash.messages.cityupdated'));
      return redirect()->route('cities');
    }

    public function destroycity($id)
    {
          $city=City::find($id);
          $name=$city->getName();
          $delete=$city->delete();
          if($delete){
            session()->flash('success',trans('admindash.messages.citydeleted',['name'=>$name]));
          }
          return redirect()->route('cities');
    }

    public function deletemcities(Request $request)
    {
        if(!empty($request->ids)){
          $ids=rtrim($request->ids,',');
          $idsArray=explode(',',$ids);
          $deleted='';
          foreach($idsArray as $id){
              $city=City::find($id);
              $deleted.=trans('admindash.messages.citydeleted',['name'=>$city->getName()]).'<br>';
              $city->delete();
          }
          session()->flash('success',$deleted);
          return redirect()->route('cities');
      }
    }

    public function editcitiesorder(){
      $countries=Country::orderBy('order','asc')->get();
      return view('admin.cities.editorder',compact('countries'));
    }

    public function updatecitiesorder(Request $request){
      $countries=Country::orderBy('order','asc')->get();
      $orders=$request->orders;
      $counter=0;
      foreach($countries as $country){
        foreach($country->cities as $city){
          $city->update([
            'order'=>$orders[$counter]
          ]);
          $counter++;
        }
      }
      session()->flash('success','Cities order updated successfully');
      return back();
    }
//////////////////////////////////SHIPPING METHODS//////////////////////////////////////////////

public function shippingmethods(){
  $shippingmethods=Shippingmethod::all();
  return view('admin.shippingmethods.manage_shippingmethod',compact('shippingmethods'));
}

public function addshippingmethod(){
  return view('admin.shippingmethods.add_shippingmethod');
}

public function storeshippingmethod(Request $request){
  $rules = [
    'name'                      =>'required',
    'name_ar'                   =>'required',
    'cost'                      =>'required',
    'deliverytime'              =>'required',
  ];

  $messages = [
    'name.required'           =>trans('admindash.validator.shippingmethodname_required'),
    'name_ar.required'        =>trans('admindash.validator.shippingmethodname_ar_required'),
    'cost.required'           =>trans('admindash.validator.cost_required'),
    'deliverytime.required'   =>trans('admindash.validator.deliverytime_required'),
  ];
  $data=Validator::make(request()->all(),$rules,$messages)->validate();
  Shippingmethod::create($data);
  session()->flash('success',trans('admindash.messages.shippingadded'));
  return redirect()->route('shippingmethods');
}

public function editshippingmethod($id){
  $shippingmethod=Shippingmethod::find($id);
  return view('admin.shippingmethods.edit_shippingmethod',compact('shippingmethod'));
}

public function updateshippingmethod(Request $request,$id){
  $rules = [
    'name'                      =>'required',
    'name_ar'                   =>'required',
    'cost'                      =>'required',
    'deliverytime'              =>'required',
  ];

  $messages = [
    'name.required'           =>trans('admindash.validator.shippingmethodname_required'),
    'name_ar.required'        =>trans('admindash.validator.shippingmethodname_ar_required'),
    'cost.required'           =>trans('admindash.validator.cost_required'),
    'deliverytime.required'   =>trans('admindash.validator.deliverytime_required'),
  ];
    $data=Validator::make(request()->all(),$rules,$messages)->validate();
    $shippingmethod=Shippingmethod::find($id);
    $shippingmethod->update($data);
    session()->flash('success',trans('admindash.messages.shippingupdated'));
    return redirect()->route('shippingmethods');
}

public function destroyshippingmethod($id)
{
      $shippingmethod=Shippingmethod::find($id);
      $name=$shippingmethod->getname();
      $delete=$shippingmethod->delete();
      if($delete){
        session()->flash('success',trans('admindash.messages.shippingmethoddeleted',['name'=>$name]));
      }
      return redirect()->route('shippingmethods');
}

public function deletemshippingmethods(Request $request)
{
    if(!empty($request->ids)){
      $ids=rtrim($request->ids,',');
      $idsArray=explode(',',$ids);
      $deleted='';
      foreach($idsArray as $id){
          $shippingmethod=Shippingmethod::find($id);
          $deleted.=trans('admindash.messages.shippingmethoddeleted',['name'=>$shippingmethod->getname()]).'<br>';
          $shippingmethod->delete();
      }
      session()->flash('success',$deleted);
      return redirect()->route('shippingmethods');
  }
}

////////////////////////////////////////ORDER STATUS///////////////////////////////////////////////////

public function statuses(){
  $statuses=Orderstatus::all();
  return view('admin.statuses.manage_statuses',compact('statuses'));
}

public function addstatus(){
  return view('admin.statuses.add_status');
}

public function storestatus(Request $request){
    $rules = [
      'name'                      =>'required_without:name_ar',
      'name_ar'                   =>'required_without:name',
      'cancancel'                 =>'required',
    ];

    $messages = [
      'name.required_without'                   =>trans('admindash.validator.statusname_required'),
      'name_ar.required_without'                =>trans('admindash.validator.statusname_ar_required'),
      'cancancel.required'                      =>trans('admindash.validator.cancancel_required'),
    ];

    $data=Validator::make(request()->all(),$rules,$messages)->validate();
    Orderstatus::create([
        'name'=>$request->name?$request->name:$request->name_ar,
        'name_ar'=>$request->name_ar?$request->name_ar:$request->name,
        'cancancel'=>$request->cancancel,
      ]);
    session()->flash('success',trans('admindash.messages.statusadded'));
    return redirect()->route('statuses');
}

public function editstatus($id){
  $status=Orderstatus::find($id);
  return view('admin.statuses.edit_status',compact('status'));
}

public function updatestatus(Request $request,$id){
  $rules = [
    'name'                      =>'required_without:name_ar',
    'name_ar'                   =>'required_without:name',
    'cancancel'                 =>'required',
  ];

  $messages = [
    'name.required_without'                   =>trans('admindash.validator.statusname_required'),
    'name_ar.required_without'                =>trans('admindash.validator.statusname_ar_required'),
    'cancancel.required'                      =>trans('admindash.validator.cancancel_required'),
  ];

  $data=Validator::make(request()->all(),$rules,$messages)->validate();
  $status=Orderstatus::find($id);
  $status->update([
      'name'=>$request->name?$request->name:$request->name_ar,
      'name_ar'=>$request->name_ar?$request->name_ar:$request->name,
      'cancancel'=>$request->cancancel,
    ]);
  session()->flash('success',trans('admindash.messages.statusupdated'));
  return redirect()->route('statuses');

}

public function destroystatus($id)
{
      $status=Orderstatus::find($id);
      $name=$status->getname();
      $delete=$status->delete();
      if($delete){
        session()->flash('success',trans('admindash.messages.statusdeleted',['name'=>$name]));
      }
      return redirect()->route('statuses');
}

public function deletemstatuses(Request $request)
{
    if(!empty($request->ids)){
      $ids=rtrim($request->ids,',');
      $idsArray=explode(',',$ids);
      $deleted='';
      foreach($idsArray as $id){
          $status=Orderstatus::find($id);
          $deleted.=trans('admindash.messages.statusdeleted',['name'=>$status->getname()]).'<br>';
          $status->delete();
      }
      session()->flash('success',$deleted);
      return redirect()->route('statuses');
  }
}

////////////////////////////////////////ORDERS///////////////////////////////////////////////////////

public function orders(){
  $orders=Ordergroup::where('delivered',0)->get();
  return view('admin.orders.manage_orders',compact('orders'));
}

public function orderdetails($ordernumber){
  $statuses=Orderstatus::all();
  $ordergroup=Ordergroup::where('order_number',$ordernumber)->get()->first();
  return view('admin.orders.orderdetails',compact('ordergroup','statuses'));
}

public function changestatus(Request $request){
  $order=Ordergroup::find($request->ordergroupid);
  $order->update([
    'status'=>$request->statusid
      ]);
  $details=[
    'type'=>'orderstatus',
    'ordergroup_id'=>$order->id,
    'status'=>$request->statusid,
  ];
  $order->user->notify(new OrderGroupStatus($details));

  return $order->getstatus->getname();
}

public function submitdetails(Request $request,$id){
  $order=Ordergroup::find($id);

  if($request->delivered==1){
    $order->update([
      'delivered'=>$request->delivered,
      'paid'=>1,
      'delivery_time'=>Carbon::now(),
        ]);

    //Send User Notification
    $details=[
      'type'=>'delivery',
      'ordergroup_id'=>$order->id,
      'status'=>'',
    ];
    $order->user->notify(new OrderGroupStatus($details));

  }else {
    $order->update([
      'delivered'=>0,
      'paid'=>0,
      'delivery_time'=>null,
        ]);
  }

  return redirect()->route('orders');
}

public function deliveredorders(){
  $orders=Ordergroup::where('delivered',1)->get();
  return view('admin.orders.manage_deliveredorders',compact('orders'));
}
////////////////////////////////////////CURRENCIES///////////////////////////////////////////////////

public function currencies(){
  $currencies=Currency::all();
  return view('admin.currencies.manage_currencies',compact('currencies'));
}

public function addcurrency(){
  return view('admin.currencies.add_currency');
}

public function storecurrency(Request $request){
    $rules = [
      'name'                      =>'required_without:name_ar',
      'name_ar'                   =>'required_without:name',
      'abbreviation'              =>'required_without:abbreviation_ar',
      'abbreviation_ar'           =>'required_without:abbreviation',
      'value'                     =>'required|numeric',
    ];

    $messages = [
      'name.required_without'                   =>trans('admindash.validator.currencyname_required'),
      'name_ar.required_without'                =>trans('admindash.validator.currencyname_ar_required'),
      'abbreviation.required_without'           =>trans('admindash.validator.currencyabbreviation_required'),
      'abbreviation_ar.required_without'        =>trans('admindash.validator.currencyabbreviation_ar_required'),
      'value.required'                  =>trans('admindash.validator.currencyvalue_required'),
      'value.numeric'                   =>trans('admindash.validator.currencyvalue_numeric'),
    ];

    $data=Validator::make(request()->all(),$rules,$messages)->validate();
    Currency::create([
        'name'=>$request->name?$request->name:$request->name_ar,
        'name_ar'=>$request->name_ar?$request->name_ar:$request->name,
        'abbreviation'=>$request->abbreviation?$request->abbreviation:$request->abbreviation_ar,
        'abbreviation_ar'=>$request->abbreviation_ar?$request->abbreviation_ar:$request->abbreviation,
      ]);
    session()->flash('success',trans('admindash.messages.currencyadded'));
    return redirect()->route('currencies');
}

public function editcurrency($id){
  $currency=Currency::find($id);
  return view('admin.currencies.edit_currency',compact('currency'));
}

public function updatecurrency(Request $request,$id){
  $rules = [
    'name'                      =>'required_without:name_ar',
    'name_ar'                   =>'required_without:name',
    'abbreviation'              =>'required_without:abbreviation_ar',
    'abbreviation_ar'           =>'required_without:abbreviation',
    'value'                     =>'required|numeric',
  ];

  $messages = [
    'name.required_without'                   =>trans('admindash.validator.currencyname_required'),
    'name_ar.required_without'                =>trans('admindash.validator.currencyname_ar_required'),
    'abbreviation.required_without'           =>trans('admindash.validator.currencyabbreviation_required'),
    'abbreviation_ar.required_without'        =>trans('admindash.validator.currencyabbreviation_ar_required'),
    'value.required'                  =>trans('admindash.validator.currencyvalue_required'),
    'value.numeric'                   =>trans('admindash.validator.currencyvalue_numeric'),
  ];

  $data=Validator::make(request()->all(),$rules,$messages)->validate();
  $currency=Currency::find($id);
  $currency->update([
      'name'=>$request->name?$request->name:$request->name_ar,
      'name_ar'=>$request->name_ar?$request->name_ar:$request->name,
      'abbreviation'=>$request->abbreviation?$request->abbreviation:$request->abbreviation_ar,
      'abbreviation_ar'=>$request->abbreviation_ar?$request->abbreviation_ar:$request->abbreviation,
    ]);
  session()->flash('success',trans('admindash.messages.currencyupdated'));
  return redirect()->route('currencies');

}

public function destroycurrency($id)
{
      $currency=Currency::find($id);
      $name=$currency->getname();
      $delete=$currency->delete();
      if($delete){
        session()->flash('success',trans('admindash.messages.currencydeleted',['name'=>$name]));
      }
      return redirect()->route('currencies');
}

public function deletemcurrencies(Request $request)
{
    if(!empty($request->ids)){
      $ids=rtrim($request->ids,',');
      $idsArray=explode(',',$ids);
      $deleted='';
      foreach($idsArray as $id){
          $currency=Currency::find($id);
          $deleted.=trans('admindash.messages.currencydeleted',['name'=>$currency->getname()]).'<br>';
          $currency->delete();
      }
      session()->flash('success',$deleted);
      return redirect()->route('currencies');
  }
}

public function editcurrenciesorders(){
  $currencies=Currency::orderBy('order','asc')->get();
  return view('admin.currencies.editorder',compact('currencies'));
}

public function updatecurrenciesorders(Request $request){
    $currencies=Currency::orderBy('order','asc')->get();
    $orders=$request->orders;
    $counter=0;
    foreach($currencies as $currency){
        $currency->update([
          'order'=>$orders[$counter]
        ]);
      $counter++;
    }
    session()->flash('success','Currencies order updated successfully');
    return back();
}

////////////////////////////PAYMENT METHODS///////////////////////////////////////////

public function paymentmethods(){

  $paymentmethods=Paymentmethod::all();
  return view('admin.paymentmethods.manage_paymentmethods',compact('paymentmethods'));

}
public function addpaymentmethod(){
  return view('admin.paymentmethods.add_paymentmethod');
}

public function storepaymentmethod(Request $request){
  $rules = [
    'name'                      =>'required_without:name_ar',
    'name_ar'                   =>'required_without:name',
  ];

  $messages = [
    'name.required_without'           =>trans('admindash.validator.name_required'),
    'name_ar.required_without'        =>trans('admindash.validator.name_ar_required'),
  ];

  $data=Validator::make(request()->all(),$rules,$messages)->validate();
  Paymentmethod::create([
      'name'=>$request->name?$request->name:$request->name_ar,
      'name_ar'=>$request->name_ar?$request->name_ar:$request->name,
    ]);
  session()->flash('success',trans('admindash.messages.paymentmethodadded'));
  return redirect()->route('paymentmethods');
}

public function editpaymentmethod($id){
  $paymentmethod=Paymentmethod::find($id);
  return view('admin.paymentmethods.edit_paymentmethod',compact('paymentmethod'));
}

public function updatepaymentmethod(Request $request,$id){
  $rules = [
    'name'                      =>'required_without:name_ar',
    'name_ar'                   =>'required_without:name',
  ];

  $messages = [
    'name.required_without'           =>trans('admindash.validator.name_required'),
    'name_ar.required_without'        =>trans('admindash.validator.name_ar_required'),
  ];

  $data=Validator::make(request()->all(),$rules,$messages)->validate();
  Paymentmethod::find($id)->update([
      'name'=>$request->name?$request->name:$request->name_ar,
      'name_ar'=>$request->name_ar?$request->name_ar:$request->name,
    ]);
  session()->flash('success',trans('admindash.messages.paymentmethodupdated'));
  return redirect()->route('paymentmethods');
}

public function destroypaymentmethod($id){
  $paymentmethod=Paymentmethod::find($id);
  $name=$paymentmethod->getname();
  $delete=$paymentmethod->delete();
  if($delete){
    session()->flash('success',trans('admindash.messages.paymentmethoddeleted',['name'=>$name]));
  }
  return redirect()->route('paymentmethods');
}

public function deletempaymentmethods(Request $request){
  if(!empty($request->ids)){
    $ids=rtrim($request->ids,',');
    $idsArray=explode(',',$ids);
    $deleted='';
    foreach($idsArray as $id){
        $paymentmethod=Paymentmethod::find($id);
        $deleted.=trans('admindash.messages.paymentmethoddeleted',['name'=>$paymentmethod->getname()]).'<br>';
        $paymentmethod->delete();
    }
    session()->flash('success',$deleted);
    return redirect()->route('paymentmethods');
}
}

public function editpaymentmethodsorder(){
  $paymentmethods=Paymentmethod::orderBy('order','asc')->get();
  return view('admin.paymentmethods.editorder',compact('paymentmethods'));
}

public function updatepaymentmethodsorder(Request $request){
    $paymentmethods=Paymentmethod::orderBy('order','asc')->get();
    $orders=$request->orders;
    $counter=0;
    foreach($paymentmethods as $paymentmethod){
        $paymentmethod->update([
          'order'=>$orders[$counter]
        ]);
      $counter++;
    }
    session()->flash('success','Payment Methods order updated successfully');
    return back();
}
////////////////////////////////////////SUBSCRIPTIONS///////////////////////////////////////////////////

public function subscriptions(){
  $subscriptions=Subscription::all();
  $requests=Changerequest::where('approved',0)->get();
  return view('admin.subscriptions.manage_subscriptions',compact('subscriptions','requests'));
}
public function activatesubscription($id){
  Subscription::find($id)->update([
    'active'=>1,
    'paid'=>1
  ]);
  session()->flash('success','Subscription Activated Successfully');
  return back();
}
public function deactivatesubscription($id){
  Subscription::find($id)->update([
    'active'=>0,
  ]);
  session()->flash('success','Subscription Dectivated Successfully');
  return back();
}

public function deletesubscription($id){
  $subscription=Subscription::find($id);

  if(count($subscription->store->products)>0){
    foreach ($subscription->store->products as $product) {
      $product->delete();
    }
  }

  $subscription->store->delete();
  $subscription->delete();

  session()->flash('success','Subscription Deleted Successfully');
  return back();
}

public function editsubscription($id){
  $subscription=Subscription::find($id);
  return view('admin.subscriptions.editsubscription',compact('subscription'));
}

public function updatesubscription($id,Request $request){
  $rules = [
    'start_date'                      =>'required',
    'end_date'                      =>'required',
    'lastamount'                     =>'required',
  ];

  $messages = [
    'start_date.required'                =>'من فضلك ادخل تاريخ اخر دفعة',
    'end_date.required'                  =>'من فضلك ادخل تاريخ انتهاء الاشتراك',
    'lastamount.required'                =>'من فضلك ادخل اخر دفعة',
  ];

  Validator::make(request()->all(),$rules,$messages)->validate();
  Subscription::find($id)->update([
    'start_date' =>$request->start_date,
    'end_date' =>$request->end_date,
    'lastamount' =>$request->lastamount,
  ]);
  session()->flash('success','Subscription Updated Successfully');
  return redirect()->route('subscriptions');
}
public function approverequest($userid,$requestid){
  $user=User::find($userid);
  $request=Changerequest::find($requestid);
  $user->subscription->update([
    'plan_id'=>$request->plan_id,
    'start_date'=>$request->start_date,
    'end_date'=>$request->end_date,
  ]);
  $request->update([
    'approved'=>1,
    'paid'=>1
  ]);
  session()->flash('success','Store Plan Changed Successfully');
  return back();
}

///////////////////////////////////STORES////////////////////////////////////////////////////

public function stores(){
  $stores=Store::all();
  return view('admin.stores.manage_stores',compact('stores'));
}

//////////////////////////////////////////PROFITS//////////////////////////////////////////////

public function profits(){
  return view('admin.profits.profits');
}

public function storesprofits(){
  $stores=Store::all();
  return view('admin.profits.storesprofits',compact('stores'));
}

public function getstoreprofits(Request $request){
  $storeid=$request->id;
  $view = view('admin.profits.ajax',compact('storeid'))->render();
  return response()->json(['html'=>$view]);
}

public function storeprofits($storeid){
  return view('admin.profits.profit',compact('storeid'));
}
//////////////////////////////////////////REWARD System//////////////////////////////////////////////

public function rewards(){
  $reward=Reward::find(1);
  return view('admin.rewards.rewards',compact('reward'));
}

public function storerewards(Request $request){
  $rules = [
    'emailactive'                      =>'required',
    'emailpoints'                      =>'required',
    'phoneactive'                      =>'required',
    'phonepoints'                      =>'required',
    'reviewactive'                     =>'required',
    'reviewpoints'                     =>'required',
    'productactive'                    =>'required',
  ];

  $messages = [
    // 'emailactive.required'                   =>trans('admindash.validator.paymentmethodname_required'),
    // 'emailpoints.required'                =>trans('admindash.validator.paymentmethodname_ar_required'),
  ];

  $data=Validator::make(request()->all(),$rules,$messages)->validate();

  $reward=Reward::find(1);
  $reward->update([
    'review'=>$request->reviewactive,
    'review_points'=>$request->reviewpoints,
    'email'=>$request->emailactive,
    'email_points'=>$request->emailpoints,
    'phone'=>$request->phoneactive,
    'phone_points'=>$request->phonepoints,
    'product'=>$request->productactive,
  ]);
  session()->flash('success','Reward System Updated Successfully');
  return view('admin.rewards.rewards',compact('reward'));
}

/////////////////////////////////////////MAIN PAGE///////////////////////////////////////////////////


////////////////////////////////////BANNERS
public function banners(){
  $banners=Banner::all();
  return view('admin.mainpage.manage_banners',compact('banners'));
}

public function createbanner(){
  return view('admin.mainpage.add_banner');
}

public function storebanner(Request $request){

  $rules = [
    'title'                      =>'required',
    'title_ar'                   =>'required',
    'image'                      =>'required',
    'url'                        =>'required',
  ];

  $messages = [
    // 'title.required'                   =>trans('admindash.validator.paymentmethodname_required'),
    // 'title_ar.required'                =>trans('admindash.validator.paymentmethodname_ar_required'),
  ];

  $data=Validator::make(request()->all(),$rules,$messages)->validate();

  if($request->hasFile('image')){
    $img = Image::make($request->image);
    $image_name='image_'.time().$request->file('image')->getClientOriginalName();
    $path = public_path('storage/images/banners/'.$image_name);
    $img->save($path);
  }

  Banner::create([
    'title'=>$request->title,
    'title_ar'=>$request->title_ar,
    'image'=>$image_name,
    'url'=>$request->url,
  ]);

  session()->flash('success','Banner Added Successfully');
  return redirect()->route('banners');

}

public function editbanner($id){
  $banner=Banner::find($id);
  return view('admin.mainpage.edit_banner',compact('banner'));
}

public function updatebanner($id,Request $request){
  $rules = [
    'title'                      =>'required',
    'title_ar'                   =>'required',
    'url'                        =>'required',
  ];

  $messages = [
    // 'title.required'                   =>trans('admindash.validator.paymentmethodname_required'),
    // 'title_ar.required'                =>trans('admindash.validator.paymentmethodname_ar_required'),
  ];

  $data=Validator::make(request()->all(),$rules,$messages)->validate();

  $banner=Banner::find($id);

  if($request->hasFile('image')){
    $img = Image::make($request->image);
    $image_name='image_'.time().$request->file('image')->getClientOriginalName();
    $path = public_path('storage/images/banners/'.$image_name);
    $img->save($path);
    Storage::delete('public/images/banners/'.$banner->image);
    $banner->update([
      'title'=>$request->title,
      'title_ar'=>$request->title_ar,
      'image'=>$image_name,
      'url'=>$request->url,
    ]);

  }else {
    $banner->update([
      'title'=>$request->title,
      'title_ar'=>$request->title_ar,
      'url'=>$request->url,
    ]);
  }



  session()->flash('success','Banner Updated Successfully');
  return redirect()->route('banners');
}

public function destroybanner($id)
{
      $banner=Banner::find($id);
      $delete=$banner->delete();
      if($delete){
        session()->flash('success','Banner Deleted Successfully');
      }
      return redirect()->route('banners');
}

public function deletembanners(Request $request)
{
    if(!empty($request->ids)){
      $ids=rtrim($request->ids,',');
      $idsArray=explode(',',$ids);
      $deleted='';
      foreach($idsArray as $id){
          $banner=Banner::find($id);
          $banner->delete();
      }
      session()->flash('success','Banner(s) Deleted Successfully');
      return redirect()->route('banners');
  }
}


////////////////////////////////////ADS
public function ads(){
  $ads=Ad::all();
  return view('admin.mainpage.manage_ads',compact('ads'));
}

public function createad(){
  return view('admin.mainpage.add_ad');
}

public function storead(Request $request){

  $rules = [
    'title'                      =>'required',
    'title_ar'                   =>'required',
    'image'                      =>'required',
    'url'                        =>'required',
  ];

  $messages = [
    // 'title.required'                   =>trans('admindash.validator.paymentmethodname_required'),
    // 'title_ar.required'                =>trans('admindash.validator.paymentmethodname_ar_required'),
  ];

  $data=Validator::make(request()->all(),$rules,$messages)->validate();

  if($request->hasFile('image')){
    $img = Image::make($request->image);
    $image_name='image_'.time().$request->file('image')->getClientOriginalName();
    $path = public_path('storage/images/ads/'.$image_name);
    $img->save($path);
  }

  Ad::create([
    'title'=>$request->title,
    'title_ar'=>$request->title_ar,
    'image'=>$image_name,
    'url'=>$request->url,
  ]);

  session()->flash('success','Ad Added Successfully');
  return redirect()->route('ads');

}

public function editad($id){
  $ad=Ad::find($id);
  return view('admin.mainpage.edit_ad',compact('ad'));
}

public function updatead($id,Request $request){
  $rules = [
    'title'                      =>'required',
    'title_ar'                   =>'required',
    'url'                        =>'required',
  ];

  $messages = [
    // 'title.required'                   =>trans('admindash.validator.paymentmethodname_required'),
    // 'title_ar.required'                =>trans('admindash.validator.paymentmethodname_ar_required'),
  ];

  $data=Validator::make(request()->all(),$rules,$messages)->validate();

  $ad=Ad::find($id);

  if($request->hasFile('image')){
    $img = Image::make($request->image);
    $image_name='image_'.time().$request->file('image')->getClientOriginalName();
    $path = public_path('storage/images/ads/'.$image_name);
    $img->save($path);
    Storage::delete('public/images/ads/'.$banner->image);
    $ad->update([
      'title'=>$request->title,
      'title_ar'=>$request->title_ar,
      'image'=>$image_name,
      'url'=>$request->url,
    ]);

  }else {
    $ad->update([
      'title'=>$request->title,
      'title_ar'=>$request->title_ar,
      'url'=>$request->url,
    ]);
  }



  session()->flash('success','Ad Updated Successfully');
  return redirect()->route('ads');
}

public function destroyad($id)
{
      $ad=Ad::find($id);
      $delete=$ad->delete();
      if($delete){
        session()->flash('success','Ad Deleted Successfully');
      }
      return redirect()->route('ads');
}

public function deletemads(Request $request)
{
    if(!empty($request->ids)){
      $ids=rtrim($request->ids,',');
      $idsArray=explode(',',$ids);
      $deleted='';
      foreach($idsArray as $id){
          $ad=Ad::find($id);
          $ad->delete();
      }
      session()->flash('success','Ad(s) Deleted Successfully');
      return redirect()->route('ads');
  }
}
////////////////////////////////////SPECIAL CATS
public function scats(){
  $scats=Specialcat::all();
  return view('admin.mainpage.manage_scats',compact('scats'));
}

public function createscat(){
  return view('admin.mainpage.add_scat');
}

public function storescat(Request $request){

  $rules = [
    'title'                      =>'required',
    'title_ar'                   =>'required',
    'image'                      =>'required',
    'url'                        =>'required',
  ];

  $messages = [
    // 'title.required'                   =>trans('admindash.validator.paymentmethodname_required'),
    // 'title_ar.required'                =>trans('admindash.validator.paymentmethodname_ar_required'),
  ];

  $data=Validator::make(request()->all(),$rules,$messages)->validate();

  if($request->hasFile('image')){
    $img = Image::make($request->image);
    $image_name='image_'.time().$request->file('image')->getClientOriginalName();
    $path = public_path('storage/images/scats/'.$image_name);
    $img->save($path);
  }

  Specialcat::create([
    'title'=>$request->title,
    'title_ar'=>$request->title_ar,
    'image'=>$image_name,
    'url'=>$request->url,
  ]);

  session()->flash('success','Special Category Added Successfully');
  return redirect()->route('scats');

}

public function editscat($id){
  $scat=Specialcat::find($id);
  return view('admin.mainpage.edit_scat',compact('scat'));
}

public function updatescat($id,Request $request){
  $rules = [
    'title'                      =>'required',
    'title_ar'                   =>'required',
    'url'                        =>'required',
  ];

  $messages = [
    // 'title.required'                   =>trans('admindash.validator.paymentmethodname_required'),
    // 'title_ar.required'                =>trans('admindash.validator.paymentmethodname_ar_required'),
  ];

  $data=Validator::make(request()->all(),$rules,$messages)->validate();

  $scat=Specialcat::find($id);

  if($request->hasFile('image')){
    $img = Image::make($request->image);
    $image_name='image_'.time().$request->file('image')->getClientOriginalName();
    $path = public_path('storage/images/ads/'.$image_name);
    $img->save($path);
    Storage::delete('public/images/ads/'.$scat->image);
    $scat->update([
      'title'=>$request->title,
      'title_ar'=>$request->title_ar,
      'image'=>$image_name,
      'url'=>$request->url,
    ]);

  }else {
    $scat->update([
      'title'=>$request->title,
      'title_ar'=>$request->title_ar,
      'url'=>$request->url,
    ]);
  }



  session()->flash('success','Special Category Updated Successfully');
  return redirect()->route('scats');
}

public function destroyscat($id)
{
      $scat=Specialcat::find($id);
      $delete=$scat->delete();
      if($delete){
        session()->flash('success','Special Category Deleted Successfully');
      }
      return redirect()->route('scats');
}

public function deletemscats(Request $request)
{
    if(!empty($request->ids)){
      $ids=rtrim($request->ids,',');
      $idsArray=explode(',',$ids);
      $deleted='';
      foreach($idsArray as $id){
          $scat=Specialcat::find($id);
          $scat->delete();
      }
      session()->flash('success','Special Category(s) Deleted Successfully');
      return redirect()->route('scats');
  }
}



/////////////////////////////////////////////Contact Us Messages//////////////////////////////////////////////

public function contactusmessages(){
  $messages=Contactus::all();

  //Mark All As Read
  foreach($messages as $message){
    $message->update([
      'read_at'=>Carbon::now()
    ]);
  }

  return view('admin.contactus.messages',compact('messages'));
}


/////////////////////////////////////////////Contact Us Messages//////////////////////////////////////////////

public function adminmessages(){
  $messages=Message::where([['to',0],['source','user']])->select('from','to','source','body','file','type','created_at',DB::raw('count(*) as total'))->groupBy('from')->get();
  return view('admin.messages.messages',compact('messages'));
}

public function adminmessage($user){
  $messages=Message::where([['from',$user],['to',0],['source','user']])
                                            ->orWhere([['from',0],['to',$user],['source','store']])->get();


  //Mark All As Read
  foreach ($messages as $message) {
    if(!$message->read_at && $message->source!='store'){
      $message->update([
        'read_at'=>Carbon::now()
      ]);
    }
  }

  return view('admin.messages.message',compact('messages','user'));
}

public function adminsend($user,Request $request){
  if(!$request->body){
    session()->flash('error','برجاء ادخال الرسالة');
    return back();
  }

  Message::create([
    'from'=>0,
    'to'=>$user,
    'source'=>'store',
    'body'=>$request->body,
  ]);

  session()->flash('success','تم ارسال الرسالة');
  return back();
}

}
