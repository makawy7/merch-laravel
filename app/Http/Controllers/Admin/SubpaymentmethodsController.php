<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Planspaymentmethod;
use Validator;

class SubpaymentmethodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paymentmethods=Planspaymentmethod::all();
        return view('admin.subpaymentmethods.manage_subpaymentmethods',compact('paymentmethods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subpaymentmethods.add_subpaymentmethod');
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
        ];

        $messages = [
          'name.required_without'           =>trans('admindash.validator.name_required'),
          'name_ar.required_without'        =>trans('admindash.validator.name_ar_required'),
        ];

        $data=Validator::make(request()->all(),$rules,$messages)->validate();
        Planspaymentmethod::create([
            'name'=>$request->name?$request->name:$request->name_ar,
            'name_ar'=>$request->name_ar?$request->name_ar:$request->name,
          ]);
        session()->flash('success',trans('admindash.messages.paymentmethodadded'));
        return redirect()->route('subpaymentmethods.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $paymentmethod=Planspaymentmethod::find($id);
       return view('admin.subpaymentmethods.edit_subpaymentmethod',compact('paymentmethod'));
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
        ];

        $messages = [
          'name.required_without'           =>trans('admindash.validator.name_required'),
          'name_ar.required_without'        =>trans('admindash.validator.name_ar_required'),
        ];

        $data=Validator::make(request()->all(),$rules,$messages)->validate();
        Planspaymentmethod::find($id)->update([
            'name'=>$request->name?$request->name:$request->name_ar,
            'name_ar'=>$request->name_ar?$request->name_ar:$request->name,
          ]);
        session()->flash('success',trans('admindash.messages.paymentmethodupdated'));
        return redirect()->route('subpaymentmethods.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paymentmethod=Planspaymentmethod::find($id);
        $name=$paymentmethod->getname();
        $delete=$paymentmethod->delete();
        if($delete){
          session()->flash('success',trans('admindash.messages.paymentmethoddeleted',['name'=>$name]));
        }
        return redirect()->route('subpaymentmethods.index');
    }

    public function deletem(Request $request){
      if(!empty($request->ids)){
        $ids=rtrim($request->ids,',');
        $idsArray=explode(',',$ids);
        $deleted='';
        foreach($idsArray as $id){
            $paymentmethod=Planspaymentmethod::find($id);
            $deleted.=trans('admindash.messages.paymentmethoddeleted',['name'=>$paymentmethod->getname()]).'<br>';
            $paymentmethod->delete();
        }
        session()->flash('success',$deleted);
        return redirect()->route('subpaymentmethods.index');
    }
    }
}
