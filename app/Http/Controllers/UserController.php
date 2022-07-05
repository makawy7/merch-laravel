<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ordergroup;
use App\MainCat;
use App\Product;
use App\Country;
use App\Address;
use App\Notifications\PointsEarned;
use Validator;
use Carbon\Carbon;
use Hash;

class UserController extends Controller
{
    public function __construct(){
      $this->middleware('auth');
    }

    public function myorders(){
      return view('site.pages.user.myorders');
    }

    public function orderdetails($ordernumber){
      $ordergroup=Ordergroup::where('order_number',$ordernumber)->get()->first();
      return view('site.pages.orderdetails',compact('ordergroup'));
    }

    public function order_details($ordernumber){
      $ordergroup=Ordergroup::where('order_number',$ordernumber)->get()->first();
      return view('site.pages.user.orderdetails',compact('ordergroup'));
    }

    public function cancelorder($id){

    }

    public function addtowishlist(Request $request){
      auth()->user()->likes()->syncWithoutDetaching($request->product);
    }

    public function addtowatchlist($id){
      $product=Product::find($id);
      //Add To User Watch Histoy
      if(auth()->user()){
        auth()->user()->watches()->syncWithoutDetaching($product->id);
      }
      session()->flash('success','Added To Watch Lish');
      return back();
    }

    public function wishlist(){
      return view('site.pages.user.wishlist');
    }

    public function myaccount(){
      $countries=Country::all();
      return view('site.pages.user.myaccount',compact('countries'));
    }

    public function account(){
      $countries=Country::orderBy('order','asc')->get();
      return view('site.pages.user.accountsettings',compact('countries'));
    }

    public function updateaccount(Request $request){
      $rules = [
          'name' => ['required', 'string', 'max:255'],
          'username' => ['required', 'unique:users,username,'.auth()->user()->id],
          'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.auth()->user()->id],
          'gender' => ['required'],
          'birthday' => ['required'],
          'phone' => ['required','unique:users,phone,'.auth()->user()->id],
          'code' => ['required'],
      ];

      $messages = [
        // 'name.required'          =>trans('site.validator.recipientname_required'),
        // 'username.required'      =>trans('site.validator.add_1_required'),
        // 'country.required'       =>trans('site.validator.country_required'),
        // 'city.required'          =>trans('site.validator.city_required'),
        // 'phone.required'         =>trans('site.validator.phone_required'),
        // 'phone.numeric'          =>trans('site.validator.phone_numeric'),
      ];

      $data=Validator::make(request()->all(),$rules,$messages)->validate();

      //if user changed phone number, it's no loger verified
      if($request->phone!=auth()->user()->phone){
        auth()->user()->update([
          'phone_verified_at'=>null
        ]);
      }
      auth()->user()->update([
        'name' => $request->name,
        'username' => $request->username,
        'email' => $request->email,
        'phone' => $request->phone,
        'country_code' => $request->code,
        'gender' => $request->gender,
        'country' => $request->country,
        'city' => $request->city,
        'birthday' => $request->birthday,
        'currency' => $request->currency,
        'default_lang' => $request->default_lang,
      ]);
      session()->flash('success','Your Account Has Been Updated Successfully');
      return back();
    }

    public function changepassword(Request $request){

      $rules = [
          'oldpassword'=>'required',
          'password' => 'required|confirmed|min:8',
      ];
      $messages = [
        // 'oldpassword.required'          =>trans('site.validator.recipientname_required'),
        // 'password.required'          =>trans('site.validator.recipientname_required'),
        // 'password.confirmed'      =>trans('site.validator.add_1_required'),
        // 'password.min'      =>trans('site.validator.add_1_required'),
      ];

      $data=Validator::make(request()->all(),$rules,$messages)->validate();

      if(Hash::check($request->oldpassword, auth()->user()->password)){
        auth()->user()->update([
          'password'=>Hash::make($request->oldpassword)
        ]);
        session()->flash('success','Password Has Been Updated Successfully');
      }else {
        session()->flash('error','The Entered Password Is Incorrect');
      }
      return back();

    }


////////////////////////////////////////////////PHONE NUMBER VERIFICATION/////////////////////////////////////

public function verifyphone(){
  if(auth()->user()->phone_verified_at){
    session()->flash('error','Phone number is already verified');
    return back();
  }
  return view('site.pages.user.verifyphone');
}

public function sendcode(){

  $code = rand(11111, 99999);
  $nexmo = app('Nexmo\Client');
  $nexmo->message()->send([
      'to'   => auth()->user()->country_code.auth()->user()->phone,
      'from' => setting()->name,
      'text' => 'Your Merch Verification Code Is '.$code
  ]);

  auth()->user()->update([
    'code'=>$code
  ]);

  $data=[
    'status'=>'success'
  ];

  return response()->Json($data);
}

public function confirmcode(Request $request){

  if(auth()->user()->code==$request->code){
    $current_date_time = Carbon::now()->toDateTimeString();
    auth()->user()->update([
      'phone_verified_at'=>$current_date_time
    ]);
    $data=[
      'status'=>'success'
    ];

    //Add Reward Points If Enabled
    if(reward()->phone==1){
      auth()->user()->update([
        'points'=>auth()->user()->points+reward()->phone_points
      ]);
      $details=[
        'type'=>'reward',
        'for'=>'phone',
        'product_id'=>'',
        'points'=>reward()->phone_points,
      ];
      auth()->user()->notify(new PointsEarned($details));
    }

  }else {
    $data=[
      'status'=>'error'
    ];
  }

  return response()->Json($data);
}

/////////////////////////////////////////////////ADDRESSES//////////////////////////////////////////////////////


    public function addresses(){
      $countries=Country::all();
      return view('site.pages.user.shippingaddresses',compact('countries'));
    }

    public function addnewaddress(Request $request){
      $rules = [
        'name'                  =>'required',
        'add_1'                 =>'required',
        'country'               =>'required',
        'city'                  =>'required',
        'phone'                 =>'required|numeric',
      ];

      $messages = [
        'name.required'          =>trans('site.validator.recipientname_required'),
        'add_1.required'         =>trans('site.validator.add_1_required'),
        'country.required'       =>trans('site.validator.country_required'),
        'city.required'          =>trans('site.validator.city_required'),
        'phone.required'         =>trans('site.validator.phone_required'),
        'phone.numeric'          =>trans('site.validator.phone_numeric'),
      ];

      $data=Validator::make(request()->all(),$rules,$messages)->validate();
      $address=Address::create([
          'name'=>$request->name,
          'add_1'=>$request->add_1,
          'add_2'=>$request->add_2,
          'phone'=>$request->phone,
          'city'=>$request->city,
          'country'=>$request->country,
          'postcode'=>$request->postcode,
          'info'=>$request->info,
          'user_id'=>auth()->user()->id,
      ]);

      session()->flash('success','Address Has Been Added Successfully');
      return back();
    }

    public function editaddress($id){
      $address=Address::find($id);
      $countries=Country::all();
      return view('site.pages.user.edit_address',compact('address','countries'));
    }

    public function updateaddress(Request $request,$id){
      $rules = [
        'name'                  =>'required',
        'add_1'                 =>'required',
        'country'               =>'required',
        'city'                  =>'required',
        'phone'                 =>'required|numeric',
      ];

      $messages = [
        'name.required'          =>trans('site.validator.recipientname_required'),
        'add_1.required'         =>trans('site.validator.add_1_required'),
        'country.required'       =>trans('site.validator.country_required'),
        'city.required'          =>trans('site.validator.city_required'),
        'phone.required'         =>trans('site.validator.phone_required'),
        'phone.numeric'          =>trans('site.validator.phone_numeric'),
      ];

      $data=Validator::make(request()->all(),$rules,$messages)->validate();
      $address=Address::find($id)->update([
          'name'=>$request->name,
          'add_1'=>$request->add_1,
          'add_2'=>$request->add_2,
          'phone'=>$request->phone,
          'city'=>$request->city,
          'country'=>$request->country,
          'postcode'=>$request->postcode,
          'info'=>$request->info,
          'user_id'=>auth()->user()->id,
      ]);

      session()->flash('success','Address Has Been Updated Successfully');
      return redirect()->route('addresses');
    }

    public function destroyaddress($id){
      $address=Address::find($id)->delete();
      session()->flash('success','Address Has Been Deleted Successfully');
      return redirect()->route('addresses');
    }



}
