<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Country;
use Carbon\Carbon;
use Validator;

class UserController extends Controller
{
    public function index(){
      $users=User::where('role','user')->get();
      return view('admin.accounts.manage_users',compact('users'));
    }

    public function create(){
      $countries=Country::all();
      return view('admin.accounts.add_user',compact('countries'));
    }
    public function store(Request $request){

      $rules = [
          'name' => ['required', 'string', 'max:255'],
          'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
          'gender' => ['required'],
          'birthday' => ['required'],
          'phone' => ['required','digits:10','unique:users'],
          'country_code' => ['required'],
          'password' => ['required','min:8','confirmed'],
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
      User::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'password' => \Hash::make($request->password),
        'country_code' => $request->country_code,
        'gender' => $request->gender,
        'country' => $request->country,
        'city' => $request->city,
        'currency' => setting()->default_currency,
        'birthday' => $request->birthday,
        'default_lang' => $request->default_lang,
      ]);
      session()->flash('success','User Has Been Added Successfully');
      return redirect()->route('user.index');
    }

    public function setadmin($id){
      $user=User::find($id);
      $user->update([
        'role'=>'admin'
      ]);
      session()->flash('success','Admin Role Has Been Added To The User');
      return redirect()->route('user.index');
    }

    public function edit($id){
      $user=User::find($id);
      $countries=Country::all();
      return view('admin.accounts.edit_user',compact('user','countries'));
    }

    public function update($id,Request $request){

      $user=User::find($id);
      $rules = [
          'name' => ['required', 'string', 'max:255'],
          'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
          'gender' => ['required'],
          'birthday' => ['required'],
          'phone' => ['required','digits:10','unique:users,phone,'.$user->id],
          'country_code' => ['required'],
          'password' => ['sometimes','nullable','min:8','confirmed'],
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

      if($request->password){
        $user->update([
          'name' => $request->name,
          'email' => $request->email,
          'phone' => $request->phone,
          'password' => \Hash::make($request->password),
          'country_code' => $request->country_code,
          'gender' => $request->gender,
          'country' => $request->country,
          'city' => $request->city,
          'birthday' => $request->birthday,
          'default_lang' => $request->default_lang,
        ]);
      }else {
        $user->update([
          'name' => $request->name,
          'username' => $request->username,
          'email' => $request->email,
          'phone' => $request->phone,
          'country_code' => $request->country_code,
          'gender' => $request->gender,
          'country' => $request->country,
          'city' => $request->city,
          'birthday' => $request->birthday,
          'default_lang' => $request->default_lang,
        ]);
      }


      session()->flash('success','User Has Been Updated Successfully');
      return redirect()->route('user.index');
    }

    public function destroy($id)
    {
          $user=User::find($id);
          //Delete User Subscription And Store If Any
          if($user->subscription){
            if($user->subscription->store){
              if($user->subscription->store->products){
                foreach($user->subscription->store->products as $product){
                  $product->delete();
                }
              }
              $user->subscription->store->delete();
            }
            $user->subscription->delete();
          }
          $delete=$user->delete();
          if($delete){
            session()->flash('success','User Deleted Successfully');
          }
          return redirect()->route('user.index');
    }

    public function deletemusers(Request $request)
    {
        if(!empty($request->ids)){
          $ids=rtrim($request->ids,',');
          $idsArray=explode(',',$ids);
          $deleted='';
          foreach($idsArray as $id){
              $user=User::find($id);
              //Delete User Subscription And Store If Any
              if($user->subscription){
                if($user->subscription->store){
                  if($user->subscription->store->products){
                    foreach($user->subscription->store->products as $product){
                      $product->delete();
                    }
                  }
                  $user->subscription->store->delete();
                }
                $user->subscription->delete();
              }
              $user->delete();
          }
          session()->flash('success','User(s) Deleted Successfully');
          return redirect()->route('user.index');
      }
    }
//////////////////////////////////////////////ADMINS///////////////////////////////////////////

public function admins(){
  $users=User::where('role','admin')->get();
  return view('admin.accounts.manage_admins',compact('users'));
}

public function destroyadmin($id)
{
      $user=User::find($id);
      $delete=$user->delete();
      if($delete){
        session()->flash('success','Admin Deleted Successfully');
      }
      return redirect()->route('admin.index');
}

public function deletemadmins(Request $request)
{
    if(!empty($request->ids)){
      $ids=rtrim($request->ids,',');
      $idsArray=explode(',',$ids);
      $deleted='';
      foreach($idsArray as $id){
          $user=User::find($id);
          $user->delete();
      }
      session()->flash('success','Admin(s) Deleted Successfully');
      return redirect()->route('admin.index');
  }
}

public function revokeadmin($id){
  $user=User::find($id);
  $user->update([
    'role'=>'user'
  ]);
  session()->flash('success','Admin Role Has Been Revoked From The User');
  return redirect()->route('admin.index');
}

}
