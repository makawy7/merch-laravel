<?php

namespace App\Http\Controllers\Admin;

use App\MainCat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
class MainCatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $maincats=MainCat::all();
      return view('admin.maincats.manage_maincats',compact('maincats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.maincats.add_maincat');
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
      $maincat=MainCat::create([
          'name'=>$request->name?$request->name:$request->name_ar,
          'name_ar'=>$request->name_ar?$request->name_ar:$request->name,
      ]);

      $maincat->generateUniqueSlug('slug',generateSlug($maincat->name));
      $maincat->generateUniqueSlug('slug_ar',generateSlug($maincat->name_ar));

      session()->flash('success',trans('admindash.messages.maincatadded'));
      return redirect()->route('maincat.index');

  }

    /**
     * Display the specified resource.
     *
     * @param  \App\MainCat  $maincat
     * @return \Illuminate\Http\Response
     */
    public function show(MainCat $maincat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MainCat  $maincat
     * @return \Illuminate\Http\Response
     */
    public function edit(MainCat $maincat)
    {
        return view('admin.maincats.edit_maincat',compact('maincat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MainCat  $maincat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MainCat $maincat)
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
      $maincat->update([
          'name'=>$request->name?$request->name:$request->name_ar,
          'name_ar'=>$request->name_ar?$request->name_ar:$request->name,
        ]);

      $maincat->generateUniqueSlug('slug',generateSlug($maincat->name));
      $maincat->generateUniqueSlug('slug_ar',generateSlug($maincat->name_ar));

      session()->flash('success',trans('admindash.messages.maincatupdated'));
      return redirect()->route('maincat.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MainCat  $maincat
     * @return \Illuminate\Http\Response
     */
    public function destroy(MainCat $maincat)
    {
      //maincats with subcats can't be deleted
      if(count($maincat->subcats)){
      session()->flash('error',trans('admindash.messages.maincatdeleteerror',['name'=>$maincat->getName()]));
      }else {
      session()->flash('success',trans('admindash.messages.maincatdeletesuccess',['name'=>$maincat->getName()]));
      $maincat->delete();
      }
      return back();
    }

    function deletem(Request $request){
      if(!empty($request->ids)){
        $ids=rtrim($request->ids,',');
        $idsArray=explode(',',$ids);
        $errors='';
        $deleted='';
        foreach($idsArray as $id){
          $maincat=MainCat::find($id);
          //maincats with subcats can't be deleted
          if(count($maincat->subcats)){
            $errors.=trans('admindash.messages.maincatdeleteerror',['name'=>$maincat->getName()]).'<br>';
          }else {
            $deleted.=trans('admindash.messages.maincatdeletesuccess',['name'=>$maincat->getName()]).'<br>';
            $maincat->delete();
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
      return redirect()->route('maincat.index');
    }
}
