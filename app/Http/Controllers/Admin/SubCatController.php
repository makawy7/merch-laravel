<?php

namespace App\Http\Controllers\Admin;

use App\SubCat;
use App\MainCat;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubCatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcats=SubCat::all();
        return view('admin.subcats.manage_subcats',compact('subcats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $maincats=MainCat::all();
        return view('admin.subcats.add_subcat',compact('maincats'));
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
        'maincat_id'                =>'required',
      ];

      $messages = [
        'name.required_without'               =>trans('admindash.validator.name_required'),
        'name_ar.required_without'            =>trans('admindash.validator.name_ar_required'),
        'maincat_id.required'                 =>trans('admindash.validator.maincat_id_required'),
      ];

      $data=Validator::make(request()->all(),$rules,$messages)->validate();
      $subcat=SubCat::create([
        'name'=>$request->name?$request->name:$request->name_ar,
        'name_ar'=>$request->name_ar?$request->name_ar:$request->name,
        'maincat_id'=>$request->maincat_id
      ]);

      $subcat->generateUniqueSlug('slug',generateSlug($subcat->name));
      $subcat->generateUniqueSlug('slug_ar',generateSlug($subcat->name_ar));

      session()->flash('success',trans('admindash.messages.subcatadded'));
      return redirect()->route('subcat.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubCat  $subcat
     * @return \Illuminate\Http\Response
     */
    public function show(SubCat $subcat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubCat  $subcat
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCat $subcat)
    {
      $maincats=MainCat::all();
      return view('admin.subcats.edit_subcat',compact('subcat','maincats'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubCat  $subcat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCat $subcat)
    {
      $rules = [
        'name'                      =>'required_without:name_ar',
        'name_ar'                   =>'required_without:name',
        'maincat_id'                =>'required',
      ];

      $messages = [
        'name.required_without'           =>trans('admindash.validator.name_required'),
        'name_ar.required_without'        =>trans('admindash.validator.name_ar_required'),
        'maincat_id.required'             =>trans('admindash.validator.maincat_id_required'),
      ];

      $data=Validator::make(request()->all(),$rules,$messages)->validate();
      $subcat->update([
        'name'=>$request->name?$request->name:$request->name_ar,
        'name_ar'=>$request->name_ar?$request->name_ar:$request->name,
        'maincat_id'=>$request->maincat_id
      ]);

      $subcat->generateUniqueSlug('slug',generateSlug($request->name));
      $subcat->generateUniqueSlug('slug_ar',generateSlug($request->name_ar));

      session()->flash('success',trans('admindash.messages.subcatupdated'));
      return redirect()->route('subcat.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubCat  $subcat
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCat $subcat)
    {
      //subcats with types can't be deleted
      if(count($subcat->types)){
      session()->flash('error',trans('admindash.messages.subcatdeleteerror',['name'=>$subcat->getName()]));
      }else {
      session()->flash('success',trans('admindash.messages.subcatdeletesuccess',['name'=>$subcat->getName()]));
      $subcat->delete();
      }
      return back();
    }

    public function deletem(Request $request)
    {
      if(!empty($request->ids)){
        $ids=rtrim($request->ids,',');
        $idsArray=explode(',',$ids);
        $errors='';
        $deleted='';
        foreach($idsArray as $id){
          $subcat=SubCat::find($id);
          //subcats with types can't be deleted
          if(count($subcat->types)){
            $errors.=trans('admindash.messages.subcatdeleteerror',['name'=>$subcat->getName()]).'<br>';
          }else {
            $deleted.=trans('admindash.messages.subcatdeletesuccess',['name'=>$subcat->getName()]).'<br>';
            $subcat->delete();
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
      return redirect()->route('subcat.index');
    }
}
