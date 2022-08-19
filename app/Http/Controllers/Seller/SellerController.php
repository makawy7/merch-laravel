<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Store;
use App\User;
use App\Message;
use App\Plan;
use App\Planspaymentmethod;
use App\Changerequest;
use Carbon\Carbon;
use DB;
use Validator;

class SellerController extends Controller
{

    public function index()
    {
        return view('seller.index');
    }

    public function storesettings(){
      if(auth()->user()->id!=auth()->user()->store->owner_id){
        session()->flash('error','Unauthorized');
        return redirect()->route('sellerindex');
      }
      $plans=Plan::orderBy('order')->get();
      $methods=Planspaymentmethod::all();
      return view('seller.storesettings',compact('plans','methods'));
    }

    public function changeplan(Request $request){
      $rules = [
          'plan'                      =>'required',
          'period'                    =>'required',
          'method'                    =>'required',
        ];
      $messages = [
        'plan.required'           =>'من فضلك اختر الخطة',
        'period.required'         =>'من فضلك اختر مدة الاشتراك',
        'method.required'         =>'من فضلك اختر طريقة الدفع',
      ];

      $data=Validator::make(request()->all(),$rules,$messages)->validate();

      Changerequest::create([
        'plan_id'=>$request->plan,
        'start_date'=>Carbon::now()->toDateString(),
        'end_date'=>Carbon::now()->addDays(30*($request->period))->toDateString(),
        'paid'=>0,
        'approved'=>0,
        'paymentmethod'=>$request->method,
        'user_id'=>auth()->user()->store->owner_id,
        'store_id'=>auth()->user()->store->id,
      ]);

      session()->flash('success','تم ارسال طلب تغيير خطة الاشتراك بنجاح');
      return back();
    }

    public function updatestore(Request $request,$id){

      $rules = [
          'name'                      =>'required',
          'name_ar'                   =>'required',
          'address'                   =>'required',
        ];
      $messages = [
        'name.required'           =>trans('sellerdash.validator.storename_required'),
        'name_ar.required'        =>trans('sellerdash.validator.storename_ar_required'),
      ];

      $data=Validator::make(request()->all(),$rules,$messages)->validate();

      $store=Store::find($id)->update([
        'name'=>$request->name,
        'name_ar'=>$request->name_ar,
        'address'=>$request->address,
      ]);
      session()->flash('success','Store Updated Successfully');
      return view('seller.storesettings');
    }

    public function deletestaff($id){
      $user=User::find($id);
      $user->update([
        'store_id'=>null
      ]);

      session()->flash('success','تم حذف عضو الادارة بنجاح');
      return back();
    }

    public function addstaff(Request $request,$id){
      if(empty($request->email)){
        session()->flash('error','Please Enter User Email');
        return redirect()->route('storesettings');
      }

      $store=Store::find($id);
      if($store->subscription->plan->staff_accounts>0){
        if(count($store->staff)-1 >= $store->subscription->plan->staff_accounts){
          session()->flash('error','Maximum Store Members Exceeded');
        }else {
          $user=User::where('email',$request->email)->first();
          if(!$user){
            session()->flash('error','A User With That Email Is Not Found');
            return back();
          }
          if(!empty($user->store_id)){
            session()->flash('error','You Can\'t Add This User Because The User Is Already A Manager Of A Store');
          }else {
            $user->update([
              'store_id'=>$store->id
            ]);
            session()->flash('success','Staff Member Has Been Added Successfully');
          }
        }
        return redirect()->route('storesettings');
      }else {
        session()->flash('error','Store Staff Are Not Allowed For This Store');
        return redirect()->route('storesettings');
      }
    }

/////////////////////////////////////////////Contact Us Messages//////////////////////////////////////////////

public function sellermessages(){
  $messages=Message::where([['to',auth()->user()->store->id],['source','user']])->select('from','to','source','body','file','type','created_at',DB::raw('count(*) as total'))->groupBy('from')->get();
  return view('seller.messages.messages',compact('messages'));
}

public function sellermessage($user){
  $messages=Message::where([['from',$user],['to',auth()->user()->store->id],['source','user']])
                                            ->orWhere([['from',auth()->user()->store->id],['to',$user],['source','store']])->get();


  //Mark All As Read
  foreach ($messages as $message) {
    if(!$message->read_at && $message->source!='store'){
      $message->update([
        'read_at'=>Carbon::now()
      ]);
    }
  }

  return view('seller.messages.message',compact('messages','user'));
}

public function sellersend($user,Request $request){
  if(!$request->body){
    session()->flash('error','برجاء ادخال الرسالة');
    return back();
  }

  Message::create([
    'from'=>auth()->user()->store->id,
    'to'=>$user,
    'source'=>'store',
    'body'=>$request->body,
  ]);

  session()->flash('success','تم ارسال الرسالة');
  return back();
}


/////////////////////////////////////////////////PROFITS/////////////////////////////////////////

public function profits(){
  $storeid=auth()->user()->store->id;
  return view('seller.profits.profits',compact('storeid'));
}
}
