<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\MainCat;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $brands=Brand::all();
      return view('admin.brands.manage_brands',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $maincats=MainCat::all();
      return view('admin.brands.add_brand',compact('maincats'));
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
        'type_id'                 =>'required',
      ];

      $messages = [
        'name.required_without'           =>trans('admindash.validator.name_required'),
        'name_ar.required_without'        =>trans('admindash.validator.name_ar_required'),
        'type_id.required'      =>trans('admindash.validator.type_id_required'),
      ];

      $data=Validator::make(request()->all(),$rules,$messages)->validate();
      $brand=Brand::create([
        'name'=>$request->name?$request->name:$request->name_ar,
        'name_ar'=>$request->name_ar?$request->name_ar:$request->name,
        'type_id'=>$request->type_id
      ]);

      $brand->generateUniqueSlug('slug',generateSlug($brand->name));
      $brand->generateUniqueSlug('slug_ar',generateSlug($brand->name_ar));

      session()->flash('success',trans('admindash.messages.brandadded'));
      return redirect()->route('brand.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        $maincats=MainCat::all();
        return view('admin.brands.edit_brand',compact('brand','maincats'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
      $rules = [
        'name'                      =>'required_without:name_ar',
        'name_ar'                   =>'required_without:name',
        'type_id'                 =>'required',
      ];

      $messages = [
        'name.required_without'           =>trans('admindash.validator.name_required'),
        'name_ar.required_without'        =>trans('admindash.validator.name_ar_required'),
        'type_id.required'      =>trans('admindash.validator.type_id_required'),
      ];

      $data=Validator::make(request()->all(),$rules,$messages)->validate();
      $brand->update([
        'name'=>$request->name?$request->name:$request->name_ar,
        'name_ar'=>$request->name_ar?$request->name_ar:$request->name,
        'type_id'=>$request->type_id
      ]);

      $brand->generateUniqueSlug('slug',generateSlug($brand->name));
      $brand->generateUniqueSlug('slug_ar',generateSlug($brand->name_ar));

      session()->flash('success',trans('admindash.messages.brandupdated'));
      return redirect()->route('brand.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
          $name=$brand->getName();
          $delete=$brand->delete();
          if($delete){
            session()->flash('success',trans('admindash.messages.branddeletesuccess',['name'=>$name]));
          }
          return redirect()->route('brand.index');
    }

    public function deletem(Request $request)
    {
        if(!empty($request->ids)){
          $ids=rtrim($request->ids,',');
          $idsArray=explode(',',$ids);
          $deleted='';
          foreach($idsArray as $id){
              $brand=Brand::find($id);
              $deleted.=trans('admindash.messages.branddeletesuccess',['name'=>$brand->getName()]).'<br>';
              $brand->delete();
          }
          session()->flash('success',$deleted);
          return redirect()->route('brand.index');
      }
    }
}
