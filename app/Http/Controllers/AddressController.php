<?php

namespace App\Http\Controllers;

use App\Address;
use Validator;
use Illuminate\Http\Request;

class AddressController extends Controller
{

    public function __construct(){
      $this->middleware('auth');
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        //
    }

    public function selectshipping(Request $request){

      /////////////////////////////////New user address///////////////////////////
      if($request->shipping=='new'){
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

        if(session()->has('addressid')){
          session()->forget('addressid');
        }
        session()->put('addressid',$address->id);
        return redirect()->route('shippingmethod');

      /////////////////////////////////Previous user address///////////////////////////
      }elseif ($request->shipping=='prev') {

        if(!empty($request->pre_address)){
          if(session()->has('addressid')){
            session()->forget('addressid');
          }
          session()->put('addressid',$request->pre_address);
          return redirect()->route('shippingmethod');
        }else {
          session()->flash('error','Please Choose One Of Your Previous Addresses');
          return back();
        }


      }else {
        session()->flash('error','Something Went Wrong!');
          return back();
      }
    }
}
