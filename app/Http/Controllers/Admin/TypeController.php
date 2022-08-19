<?php

namespace App\Http\Controllers\Admin;

use App\Type;
use App\MainCat;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types=Type::all();
        return view('admin.types.manage_types',compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $maincats=MainCat::all();
        return view('admin.types.add_type',compact('maincats'));
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
        'subcat_id'                 =>'required',
      ];

      $messages = [
        'name.required_without'           =>trans('admindash.validator.name_required'),
        'name_ar.required_without'        =>trans('admindash.validator.name_ar_required'),
        'subcat_id.required'              =>trans('admindash.validator.subcat_id_required'),
      ];

      $data=Validator::make(request()->all(),$rules,$messages)->validate();
      $type=Type::create([
        'name'=>$request->name?$request->name:$request->name_ar,
        'name_ar'=>$request->name_ar?$request->name_ar:$request->name,
        'subcat_id'=>$request->subcat_id
      ]);

      $type->generateUniqueSlug('slug',generateSlug($type->name));
      $type->generateUniqueSlug('slug_ar',generateSlug($type->name_ar));

      session()->flash('success',trans('admindash.messages.typeadded'));
      return redirect()->route('type.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        $maincats=MainCat::all();
        return view('admin.types.edit_type',compact('type','maincats'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
      $rules = [
        'name'                      =>'required_without:name_ar',
        'name_ar'                   =>'required_without:name',
        'subcat_id'                 =>'required',
      ];

      $messages = [
        'name.required_without'           =>trans('admindash.validator.name_required'),
        'name_ar.required_without'        =>trans('admindash.validator.name_ar_required'),
        'subcat_id.required'              =>trans('admindash.validator.subcat_id_required'),
      ];

      $data=Validator::make(request()->all(),$rules,$messages)->validate();
      $type->update([
        'name'=>$request->name?$request->name:$request->name_ar,
        'name_ar'=>$request->name_ar?$request->name_ar:$request->name,
        'subcat_id'=>$request->subcat_id
      ]);

      $type->generateUniqueSlug('slug',generateSlug($type->name));
      $type->generateUniqueSlug('slug_ar',generateSlug($type->name_ar));

      session()->flash('success',trans('admindash.messages.typeupdated'));
      return redirect()->route('type.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
      //types with brands can't be deleted
      if(count($type->brands)){
      session()->flash('error',trans('admindash.messages.typedeleteerror',['name'=>$type->getName()]));
      }else {
      session()->flash('success',trans('admindash.messages.typedeletesuccess',['name'=>$type->getName()]));
      $type->delete();
      }
      return back();
    }

    public function deletem(Request $request){

      if(!empty($request->ids)){
        $ids=rtrim($request->ids,',');
        $idsArray=explode(',',$ids);
        $errors='';
        $deleted='';
        foreach($idsArray as $id){
          $type=Type::find($id);
            //types with brands can't be deleted
          if(count($type->brands)){
            $errors.=trans('admindash.messages.typedeleteerror',['name'=>$type->getName()]).'<br>';
          }else {
            $deleted.=trans('admindash.messages.typedeletesuccess',['name'=>$type->getName()]).'<br>';
            $type->delete();
          }
        }

        if($errors==''){
          session()->flash('success',$deleted);
        }elseif($errors!='' && $deleted!='') {
          session()->flash('error',$errors);
          session()->flash('success',$deleted);
        }else {
          session()->flash('error',$errors);
        }
      }
      return redirect()->route('type.index');
    }
}
