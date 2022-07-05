<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Plan;
use Image;
use Storage;
use Validator;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans=Plan::all();
        return view('admin.plans.manage_plans',compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          return view('admin.plans.add_plan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $rules = [
        'name'                      =>'required_without:name_ar',
        'name_ar'                   =>'required_without:name',
        'des'                       =>'required_without:des_ar',
        'des_ar'                    =>'required_without:des',
        'price'                     =>'required',
        'salefee'                   =>'required',
        'minfee'                    =>'required',
        'maxfee'                    =>'required',
        'product_priority'          =>'required',
        'product_limit'             =>'numeric|sometimes|nullable',
        'trans_limit'               =>'numeric|sometimes|nullable',
        'deleted_counter'           =>'numeric|sometimes|nullable',
        'photo_limit'               =>'required',
        'variations'                =>'required',
        'staff_accounts'            =>'numeric|required',
      ];

      $messages = [
        // 'name.required'           =>trans('admindash.validator.countryname_required'),
        // 'name_ar.required'        =>trans('admindash.validator.countryname_ar_required'),
      ];

      $data=Validator::make(request()->all(),$rules,$messages)->validate();
      $plan=Plan::create([
        'name'=>$request->name?$request->name:$request->name_ar,
        'name_ar'=>$request->name_ar?$request->name_ar:$request->name,
        'des'=>$request->des?$request->des:$request->des_ar,
        'des_ar'=>$request->des_ar?$request->des_ar:$request->des,
        'price'=>$request->price,
        'fee'=>$request->salefee,
        'min_fee'=>$request->minfee,
        'max_fee'=>$request->maxfee,
        'product_priority'=>$request->product_priority,
        'product_limit'=>$request->product_limit,
        'trans_limit'=>$request->trans_limit,
        'deleted_counter'=>$request->deleted_counter,
        'photo_limit'=>$request->photo_limit,
        'variations'=>$request->variations,
        'staff_accounts'=>$request->staff_accounts,
        'can_see_views'=>$request->can_see_views,
        'analytics'=>$request->analytics
      ]);

      if($request->hasFile('badge')){
        $img = Image::make($request->badge);
        $image_name='badge_'.time().$request->file('badge')->getClientOriginalName();
        $path = public_path('storage/images/plans/'.$image_name);
        $img->save($path);
        $plan->update(['badge'=>$image_name]);
      }

      session()->flash('success','Plan Added Successfully');
      return redirect()->route('plans.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $plan=Plan::find($id);
        return view('admin.plans.plan_details',compact('plan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $plan=Plan::find($id);
        return view('admin.plans.edit_plan',compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $rules = [
        'name'                      =>'required_without:name_ar',
        'name_ar'                   =>'required_without:name',
        'des'                       =>'required_without:des_ar',
        'des_ar'                    =>'required_without:des',
        'price'                     =>'required',
        'salefee'                   =>'required',
        'minfee'                    =>'required',
        'maxfee'                    =>'required',
        'product_priority'          =>'required',
        'product_limit'             =>'numeric|sometimes|nullable',
        'trans_limit'               =>'numeric|sometimes|nullable',
        'deleted_counter'           =>'numeric|sometimes|nullable',
        'photo_limit'               =>'required',
        'variations'                =>'required',
        'staff_accounts'            =>'numeric|required',
      ];

      $messages = [
        // 'name.required'           =>trans('admindash.validator.countryname_required'),
        // 'name_ar.required'        =>trans('admindash.validator.countryname_ar_required'),
      ];

      $data=Validator::make(request()->all(),$rules,$messages)->validate();
      $plan=Plan::find($id);
      $plan->update([
        'name'=>$request->name?$request->name:$request->name_ar,
        'name_ar'=>$request->name_ar?$request->name_ar:$request->name,
        'des'=>$request->des?$request->des:$request->des_ar,
        'des_ar'=>$request->des_ar?$request->des_ar:$request->des,
        'price'=>$request->price,
        'fee'=>$request->salefee,
        'min_fee'=>$request->minfee,
        'max_fee'=>$request->maxfee,
        'product_priority'=>$request->product_priority,
        'product_limit'=>$request->product_limit,
        'trans_limit'=>$request->trans_limit,
        'deleted_counter'=>$request->deleted_counter,
        'photo_limit'=>$request->photo_limit,
        'variations'=>$request->variations,
        'staff_accounts'=>$request->staff_accounts,
        'can_see_views'=>$request->can_see_views,
        'analytics'=>$request->analytics
      ]);

      if($request->hasFile('badge')){
        $img = Image::make($request->badge);
        $image_name='badge_'.time().$request->file('badge')->getClientOriginalName();
        $path = public_path('storage/images/plans/'.$image_name);
        $img->save($path);
        Storage::delete('public/images/plans/'.$plan->badge);
        $plan->update(['badge'=>$image_name]);
      }

      session()->flash('success','Plan Updated Successfully');
      return redirect()->route('plans.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plan=Plan::find($id);
        if(count($plan->subscriptions)>0){
          session()->flash('error','Plan Can\'t Be Deleted Because It Has Subscriptions, Please Delete Subscriptions First');
          return back();
        }
        $name=$plan->getName();
        $delete=$plan->delete();
        if($delete){
          session()->flash('success',trans('admindash.messages.plandeleted',['name'=>$name]));
        }
        return redirect()->route('plans.index');
    }

    public function deletem(Request $request)
    {
        if(!empty($request->ids)){
          $ids=rtrim($request->ids,',');
          $idsArray=explode(',',$ids);
          $deleted='';
          foreach($idsArray as $id){
              $plan=Plan::find($id);
              if(count($plan->subscriptions)>0){
                session()->flash('error','Plan '.$plan->getname().' Be Deleted Because It Has Subscriptions, Please Delete Subscriptions First');
              }else {
                $deleted.=trans('admindash.messages.plandeleted',['name'=>$plan->getname()]).'<br>';
                $plan->delete();
              }
          }
          session()->flash('success',$deleted);
          return redirect()->route('plans.index');
      }
    }

    public function editorder(){
      $plans=Plan::orderBy('order','asc')->get();
      if(count($plans)==0){
        session()->flash('error','No Plans');
        return back();
      }
      return view('admin.plans.editorder',compact('plans'));
    }

    public function updateorder(Request $request){
        $plans=Plan::orderBy('order','asc')->get();
        $orders=$request->orders;
        $counter=0;
        foreach($plans as $plan){
            $plan->update([
              'order'=>$orders[$counter]
            ]);
          $counter++;
        }
        session()->flash('success','Plans order updated successfully');
        return back();
    }
}
