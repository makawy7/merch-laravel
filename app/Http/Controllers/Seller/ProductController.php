<?php

namespace App\Http\Controllers\Seller;

use App\Product;
use App\MainCat;
use App\Variation;
use App\Option;
use App\Extoption;
use Validator;
use Storage;
use Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::where('store_id',auth()->user()->store->id)->get();
        return view('seller.products.manage_products',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $maincats=MainCat::all();
        return view('seller.products.add_product',compact('maincats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //Products Limit If Any
      $productlimit=auth()->user()->store->subscription->plan->product_limit;
      if($productlimit){
        if(count(auth()->user()->store->products) >= $productlimit){
          session()->flash('error','Maximum Number Of Products Exceeded, You Can Only Have '.$productlimit.' Live Products');
          return back();
        }
      }

      $rules = [
          'title'                      =>'required',
          'title_ar'                   =>'required',
          'type_id'                    =>'required',
          'brand_id'                   =>'sometimes|nullable',
          'head_des'                   =>'required',
          'head_des_ar'                =>'required',
          'des'                        =>'required',
          'des_ar'                     =>'required',
          'images'                     =>'required',
          'tags'                       =>'required',
        ];

        // without variation, price and quantity are required
        if($request->variation==0){
          $addRules=['price'=>'required',
                     'quantity'=>'required'];
          $rules=array_merge($rules,$addRules);
        }

        $messages = [
          'title.required'           =>trans('admindash.validator.title_required'),
          'title_ar.required'        =>trans('admindash.validator.title_ar_required'),
          'type_id.required'         =>trans('admindash.validator.type_id_required'),
          'head_des.required'        =>trans('admindash.validator.head_des_required'),
          'head_des_ar.required'     =>trans('admindash.validator.head_des_ar_required'),
          'des.required'             =>trans('admindash.validator.des_required'),
          'des_ar.required'          =>trans('admindash.validator.des_ar_required'),
          'images.required'          =>trans('admindash.validator.images_required'),
          'price.required'           =>trans('admindash.validator.price_required'),
          'quantity.required'        =>trans('admindash.validator.quantity_required'),
          'tags.required'            =>trans('admindash.validator.tags_required'),
        ];

        $data=Validator::make(request()->all(),$rules,$messages)->validate();

        //Photos Limit
        $photolimit=auth()->user()->store->subscription->plan->photo_limit;
        if(count($request->images) > $photolimit){
          session()->flash('error','Maximum Number Of Product Photos Exceeded, You Can Only Have '.$photolimit.' Photos');
          return back();
        }

        $product=Product::create([
          'title'=>$request->title,
          'title_ar'=>$request->title_ar,
          'type_id'=>$request->type_id,
          'brand_id'=>$request->brand_id,
          'seller_id'=>auth()->user()->id,
          'head_des'=>json_encode($request->head_des),
          'head_des_ar'=>json_encode($request->head_des_ar),
          'des'=>json_encode($request->des),
          'des_ar'=>json_encode($request->des_ar),
          'price'=>$request->price,
          'quantity'=>$request->quantity,
          'tags'=>$request->tags,
          'store_id'=>auth()->user()->store->id,
          'product_priority'=>auth()->user()->store->subscription->plan->product_priority
        ]);

        $product->generateUniqueSlug('slug',generateSlug($request->title));
        $product->generateUniqueSlug('slug_ar',generateSlug($request->title_ar));

        if($request->images){
          $images=$request->images;
          $counter=0;
          $imgs=[];
          foreach($images as $image){
            $img = Image::make($image);
            $image_name="untitled".$counter.time().'.png';
            $path = public_path('storage/images/products/'.$image_name);
            $img->save($path);
            $imgs[]=$image_name;
            $counter++;
          }
          $product->update([
            'image'=>$imgs[0],
            'images'=>json_encode($imgs)
          ]);
        }

        if($request->variation==0){
          //update min and max price for the product
          $product->update([
            'lowest_price'=>$request->price,
            'hightest_price'=>$request->price
          ]);
          session()->flash('success',trans('admindash.messages.productadded'));
          return redirect()->route('seller.product.index');
        }else {
          return redirect()->route('seller.add.variation',$product->id);
        }

      }


        public function show(Product $product)
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  \App\Product  $product
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            $maincats=MainCat::all();
            $product=Product::find($id);
            return view('seller.products.edit_product',compact('product','maincats'));
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \App\Product  $product
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, $id)
        {

          $rules = [
              'title'                      =>'required',
              'title_ar'                   =>'required',
              'type_id'                    =>'required',
              'brand_id'                   =>'sometimes|nullable',
              'head_des'                   =>'required',
              'head_des_ar'                =>'required',
              'des'                        =>'required',
              'des_ar'                     =>'required',
              'images'                     =>'required',
              'tags'                       =>'required',
            ];

            // without variation, price and quantity are required
            if($request->variation==0){
              $addRules=['price'=>'required',
                         'quantity'=>'required'];
              $rules=array_merge($rules,$addRules);
            }

            $messages = [
              'title.required'           =>trans('admindash.validator.title_required'),
              'title_ar.required'        =>trans('admindash.validator.title_ar_required'),
              'type_id.required'         =>trans('admindash.validator.type_id_required'),
              'head_des.required'        =>trans('admindash.validator.head_des_required'),
              'head_des_ar.required'     =>trans('admindash.validator.head_des_ar_required'),
              'des.required'             =>trans('admindash.validator.des_required'),
              'des_ar.required'          =>trans('admindash.validator.des_ar_required'),
              'images.required'          =>trans('admindash.validator.images_required'),
              'price.required'           =>trans('admindash.validator.price_required'),
              'quantity.required'        =>trans('admindash.validator.quantity_required'),
              'tags.required'            =>trans('admindash.validator.tags_required'),
            ];

            $data=Validator::make(request()->all(),$rules,$messages)->validate();
            $product=Product::find($id);
            $product->update([
              'title'=>$request->title,
              'title_ar'=>$request->title_ar,
              'type_id'=>$request->type_id,
              'brand_id'=>$request->brand_id,
              'head_des'=>json_encode($request->head_des),
              'head_des_ar'=>json_encode($request->head_des_ar),
              'des'=>json_encode($request->des),
              'des_ar'=>json_encode($request->des_ar),
              'price'=>$request->price,
              'quantity'=>$request->quantity,
              'tags'=>$request->tags,
              'store_id'=>auth()->user()->store->id,
            ]);

            $product->generateUniqueSlug('slug',generateSlug($request->title));
            $product->generateUniqueSlug('slug_ar',generateSlug($request->title_ar));

            if($request->images){
              $images=$request->images;
              $counter=0;
              $imgs=[];
              foreach($images as $image){
                $img = Image::make($image);
                $image_name="untitled".$counter.time().'.png';
                $path = public_path('storage/images/products/'.$image_name);
                $img->save($path);
                $imgs[]=$image_name;
                $counter++;
              }
              //deleteing old pictures
              foreach(json_decode($product->images) as $image){
                Storage::delete('public/images/products/'.$image);
              }
              //updating images names after deleting old pictures
              $product->update([
                'image'=>$imgs[0],
                'images'=>json_encode($imgs)
              ]);

            }

            if($request->variation==0){
              //if the product editited from with variation to no variations, all its variations, options and extoptions will be deleted
              foreach($product->variations as $variation){
                //deleting them one by one, to make advantage of "deleting" event in model
                foreach($variation->options as $option){
                  $option->delete();
                }
                $variation->delete();
              }
              $product->extoptions()->delete();

              //update min and max price for the product
              $product->update([
                'lowest_price'=>$request->price,
                'hightest_price'=>$request->price
              ]);

              session()->flash('success',trans('admindash.messages.productupdated'));
              return redirect()->route('seller.product.index');
            }else {

              //if the product editited from no variation to with variations, price and qunatity fields will be NULL
              $product->update([
                'price'=>null,
                'quantity'=>null
              ]);

              return redirect()->route('seller.add.variation',$product->id);
            }
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  \App\Product  $product
         * @return \Illuminate\Http\Response
         */
        public function destroy(Product $product)
        {
              //deleteing product variations, options and extended options
              if(count($product->variations)>0){
                foreach ($product->variations as $variation) {
                  if(count($variation->options)>0){
                    foreach ($variation->options as $option) {
                      if(count($option->extoptions)>0){
                        foreach ($option->extoptions as $extoption) {
                          $extoption->delete();}
                        }
                      $option->delete();
                    }
                  }
                  $variation->delete();
                }
              }
              $productname=$product->gettitle();
              $product->delete();
              session()->flash('success',trans('admindash.messages.productdeletesuccess',['name'=>$productname]));
              return redirect()->route('seller.product.index');
        }

      public function deletem(Request $request){
        if(!empty($request->ids)){
          $ids=rtrim($request->ids,',');
          $idsArray=explode(',',$ids);
          $deleted='';
          foreach($idsArray as $id){
              $product=Product::find($id);
              //deleteing product variations, options and extended options
                if(count($product->variations)>0){
                  foreach ($product->variations as $variation) {
                    if(count($variation->options)>0){
                      foreach ($variation->options as $option) {
                        if(count($option->extoptions)>0){
                          foreach ($option->extoptions as $extoption) {
                            $extoption->delete();}
                          }
                        $option->delete();
                      }
                    }
                    $variation->delete();
                  }
                }
              $deleted.=trans('admindash.messages.branddeletesuccess',['name'=>$product->gettitle()]).'<br>';
              $product->delete();
          }
          session()->flash('success',$deleted);
          return redirect()->route('seller.product.index');
      }
      }

////////////////////////////////////Product Variations/////////////////////////////////////

  function addvariationshow($id){
    $product=Product::find($id);
    return view('seller.products.add_variation',compact('product'));
  }

  // function addvariation(Request $request){
  //
  //         if(isset($request->variation1)){
  //           Variation::create([
  //               'name'=>$request->variation1[0],
  //               'name_ar'=>$request->variation1[1],
  //               'product_id'=>$request->product
  //             ]);
  //         }
  //         if(isset($request->variation2)){
  //           Variation::create([
  //               'name'=>$request->variation2[0],
  //               'name_ar'=>$request->variation2[1],
  //               'product_id'=>$request->product
  //             ]);
  //         }
  //         if(isset($request->variation3)){
  //           Variation::create([
  //               'name'=>$request->variation3[0],
  //               'name_ar'=>$request->variation3[1],
  //               'product_id'=>$request->product
  //             ]);
  //         }
  //
  //       return redirect()->route('add.options',$request->product);
  //   }

    public function storevariation(Request $request){
      $product=Product::find($request->product_id);

      if(count($product->variations)<4){
        $variation=Variation::create([
                'name'=>$request->name,
                'name_ar'=>$request->name_ar,
                'product_id'=>$request->product_id
              ]);
        return response()->Json($variation);
      }
    }

    public function updatevariation(Request $request){
      $variation=Variation::find($request->id);
      $variation->update([
        'name'=>$request->name,
        'name_ar'=>$request->name_ar
      ]);
      return response()->Json($variation);
    }

    public function deletevariation(Request $request){
      $variation=Variation::find($request->id);
      if(count($variation->options)>0){
        foreach ($variation->options as $option) {
          if(count($option->extoptions)>0){
            foreach ($option->extoptions as $extoption) {
              $extoption->delete();}
            }
          $option->delete();
        }
      }
      $variation->delete();
    }

////////////////////////////////////Variation Options/////////////////////////////////////

    public function addoptionsshow($id){
      $product=Product::find($id);
      return view('seller.products.add_options',compact('product'));
    }

    public function addoptions(Request $request){
      $option=Option::create([
                        'name'=>$request->name,
                        'name_ar'=>$request->name_ar,
                        'variation_id'=>$request->id
                      ]);
        return response()->Json($option);
    }

    public function removeoptions(Request $request){
      $option=Option::find($request->id);
      if(count($option->extoptions)>0){
        foreach ($option->extoptions as $extoption) {
          $extoption->delete();}
        }
      $option->delete();
    }

    public function updateoptions(Request $request){
      $option=Option::find($request->id);
      $option->update([
        'name'=>$request->name,
        'name_ar'=>$request->name_ar,
      ]);
      return response()->Json($option);
    }

//////////////////////////////////////Product Extended Options///////////////////////////////////////////////

    public function addextoption($id){
      $product=Product::find($id);
      return view('seller.products.add_extoptions',compact('product'));
    }

    public function storeextoption(Request $request){
      $ids=explode(',',$request->ids);
      $extoption=Extoption::create([
        'price'=>$request->price,
        'quantity'=>$request->quantity,
        'product_id'=>$request->product_id,
      ]);

      $extoption->options()->attach($ids);

      return response()->Json($extoption);
    }


    public function updateextoption(Request $request){
      $extoption=Extoption::find($request->id)->update([
        'price'=>$request->price,
        'quantity'=>$request->quantity,
      ]);
      return response()->Json($extoption);
    }

//////////////////////////////////////SET MIN AND MAX PRICE///////////////////////////////////////////////

public function productminmax($id){

  //update min and max price for the product
  $product=Product::find($id);
  $product->update([
      'lowest_price'=>$product->getminprice(),
      'hightest_price'=>$product->getmaxprice()
  ]);
  return redirect()->route('seller.product.index');

}

}
