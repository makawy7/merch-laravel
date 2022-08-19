<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Notification;
use Carbon\Carbon;
use App\MainCat;
use App\SubCat;
use App\Type;
use App\Product;
use App\Comment;
use App\Rating;
use App\Plan;
use App\Store;
use App\Contactus;
use App\Subscription;
use App\Planspaymentmethod;
use App\Notifications\PointsEarned;
use Storage;
use Image;

class HomeController extends Controller
{
    public function __construct(){
      $this->middleware('guest')->only(['login']);
      $this->middleware('auth')->only(['addcomment','deletecomment']);
    }

    public function login(){
      return view('site.pages.signin');
    }

    public function index()
    {
        $newestproducts=Product::where('active',1)->orderBy('created_at')->skip(0)->take(10)->get();
        $topsoldproducts=Product::where('active',1)->orderBy('sales')->skip(0)->take(10)->get();
        return view('site.index',compact('newestproducts','topsoldproducts'));
    }


    public function showproduct($slug){
      $product=Product::findbyslug($slug);

      if($product){
        //Increment views count
        if(!session()->has('product_'.$product->id)){
          session()->put('product_'.$product->id,'');
          $product->update([
            'views'=>$product->views+1
          ]);
        }
        //Add To User Watch Histoy
        if(auth()->user()){
          auth()->user()->watches()->syncWithoutDetaching($product->id);
        }

        return view('site.pages.product',compact('product'));
      }else {
        return 'الصفحة غير موجوده';
      }
    }



public function showsubcat(Request $request,$slug){

      $subcat=SubCat::findbyslug($slug);

      if(!$subcat){
        if($request->subcat){
          $subcat=SubCat::find($request->subcat);
        }
      }
      //filter
      if($request->ajax()){
        //Sort By Type
        if($request->sort){
            $typeids=[];
          if($request->cat){
            $typeids[]=$request->cat;
          }else{
            foreach($subcat->types as $type){
              $typeids[]=$type->id;
            }
          }
          if($request->sort=='price:asc'){
            $products=$subcat->products()->where(function ($query) {
                                        $query->where('active',1);
                                            })->orderBy('lowest_price','asc')->whereIn('type_id',$typeids)->paginate(12);
          }elseif($request->sort=='price:dec'){
            $products=$subcat->products()->where(function ($query) {
                                        $query->where('active',1);
                                            })->orderBy('hightest_price','desc')->whereIn('type_id',$typeids)->paginate(12);
          }elseif ($request->sort=='name:asc') {
            $title='created_at';
            $products=$subcat->products()->where(function ($query) {
                                          $query->where('active',1);
                                              })->orderBy($title,'asc')->whereIn('type_id',$typeids)->paginate(12);
          }elseif ($request->sort=='name:desc') {
            $title='created_at';
            $products=$subcat->products()->where(function ($query) {
                                          $query->where('active',1);
                                              })->orderBy($title,'desc')->whereIn('type_id',$typeids)->paginate(12);
          }
        }elseif(!$request->sort && $request->cat){
          $typeid=$request->cat;
          $products=$subcat->products()->where(function ($query) {
                                                $query->where('active',1);
                                                    })->where('type_id',$typeid)->paginate(12);
        }else {
            $products=$subcat->products()->where('active',1)->paginate(12);
        }

        $view = view('site.pages.filter.data',compact('products'))->render();
        return response()->json(['html'=>$view]);

      }else {
        $products=$subcat->products()->where('active',1)->paginate(12);
      }

      return view('site.pages.products',compact('products','subcat'));
}




public function showtype($slug,Request $request){
      $type=Type::findbyslug($slug);

      if(!$type){
        if($request->type){
          $type=Type::find($request->type);
        }
      }

      //filter
      if($request->ajax()){
        //Sort By Brand
        if($request->sort){
            $brandids=[];
          if($request->cat){
              $brandids[]=$request->cat;
          }else{
            foreach($type->brands as $brand){
              $brandids[]=$brand->id;
            }
          }

          //if there are no brands
          if(count($brandids)==0){
            if($request->sort=='price:asc'){
              $products=$type->products()->where(function ($query) {
                                          $query->where('active',1);
                                        })->orderBy('lowest_price','asc')->paginate(12);
            }elseif($request->sort=='price:dec'){
              $products=$type->products()->where(function ($query) {
                                          $query->where('active',1);
                                        })->orderBy('hightest_price','desc')->paginate(12);
            }elseif ($request->sort=='name:asc') {
              $title='created_at';
              $products=$type->products()->where(function ($query) {
                                            $query->where('active',1);
                                          })->orderBy($title,'asc')->paginate(12);
            }elseif ($request->sort=='name:desc') {
              $title='created_at';
              $products=$type->products()->where(function ($query) {
                                            $query->where('active',1);
                                          })->orderBy($title,'desc')->paginate(12);
            }
          }else {
            if($request->sort=='price:asc'){
              $products=$type->products()->where(function ($query) {
                                          $query->where('active',1);
                                        })->orderBy('lowest_price','asc')->whereIn('brand_id',$brandids)->paginate(12);
            }elseif($request->sort=='price:dec'){
              $products=$type->products()->where(function ($query) {
                                          $query->where('active',1);
                                        })->orderBy('hightest_price','desc')->whereIn('brand_id',$brandids)->paginate(12);
            }elseif ($request->sort=='name:asc') {
              $title='created_at';
              $products=$type->products()->where(function ($query) {
                                            $query->where('active',1);
                                          })->orderBy($title,'asc')->whereIn('brand_id',$brandids)->paginate(12);
            }elseif ($request->sort=='name:desc') {
              $title='created_at';
              $products=$type->products()->where(function ($query) {
                                            $query->where('active',1);
                                          })->orderBy($title,'desc')->whereIn('brand_id',$brandids)->paginate(12);
            }
          }

        }elseif(!$request->sort && $request->cat){
          $brandid=$request->cat;
          $products=$type->products()->where(function ($query) {
                                                $query->where('active',1);
                                              })->where('brand_id',$brandid)->paginate(12);
        }else {
            $products=$type->products()->where('active',1)->paginate(12);
        }

        $view = view('site.pages.filter.data',compact('products'))->render();
        return response()->json(['html'=>$view]);
      }else {
        $products=$type->products()->where('active',1)->paginate(12);
      }
      $products=$type->products()->where('active',1)->paginate(12);
      return view('site.pages.products',compact('products','type'));
}



public function bestselling(Request $request){
      //Filter
      if($request->ajax()){
        if($request->cat){
            $subcat=SubCat::find($request->cat);
            $typeids=[];
            foreach($subcat->types as $type){
              $typeids[]=$type->id;
            }
        $products=Product::where(function ($query) {
                                            $query->where('active',1);
                                            })->whereIn('type_id',$typeids)->orderBy('sales')->paginate(12);

        }else {
          $products=Product::where('active',1)->orderBy('sales')->paginate(12);
        }

        $view = view('site.pages.filter.data',compact('products'))->render();
        return response()->json(['html'=>$view]);

      }else {
        $products=Product::where('active',1)->orderBy('sales')->paginate(12);
      }


      return view('site.pages.bestsellingproducts',compact('products'));
}



public function newlylisted(Request $request){
      //Filter
      if($request->ajax()){
        if($request->cat){
            $subcat=SubCat::find($request->cat);
            $typeids=[];
            foreach($subcat->types as $type){
              $typeids[]=$type->id;
            }
        $products=Product::where(function ($query) {
                                            $query->where('active',1);
                                            })->whereIn('type_id',$typeids)->orderBy('created_at')->paginate(12);

        }else {
          $products=Product::where('active',1)->orderBy('created_at')->paginate(12);
        }

        $view = view('site.pages.filter.data',compact('products'))->render();
        return response()->json(['html'=>$view]);

      }else {
        $products=Product::where('active',1)->orderBy('created_at')->paginate(12);
      }

      return view('site.pages.newlylistedproducts',compact('products'));
}



public function store($id,Request $request){

      if($request->storeid){
        $id=$request->storeid;
      }

      //filter
      if($request->ajax()){
        //Sort By Type
        if($request->sort){
            $typeids=[];
          if($request->cat){
            $subcat=SubCat::find($request->cat);
            foreach($subcat->types as $type){
              $typeids[]=$type->id;
            }
          }else{
            $types=Type::all();
            foreach($types as $type){
              $typeids[]=$type->id;
            }
          }

          //Search word
          if($request->word){

            $searchword=$request->word;
            if($request->sort=='price:asc'){
              $products=Product::where(function ($query) use($searchword) {
                                          $query->where('title', 'LIKE', '%' . $searchword . '%')
                                                ->orWhere('title_ar','LIKE', '%' . $searchword . '%')
                                                ->orWhere('des','LIKE', '%' . $searchword . '%')
                                                ->orWhere('des_ar','LIKE', '%' . $searchword . '%');
                                              })->where('active',1)->where('store_id',$id)->whereIn('type_id',$typeids)->orderBy('lowest_price','asc')->paginate(12);
            }elseif($request->sort=='price:dec'){
              $products=Product::where(function ($query) use($searchword) {
                                          $query->where('title', 'LIKE', '%' . $searchword . '%')
                                                ->orWhere('title_ar','LIKE', '%' . $searchword . '%')
                                                ->orWhere('des','LIKE', '%' . $searchword . '%')
                                                ->orWhere('des_ar','LIKE', '%' . $searchword . '%');
                                              })->where('active',1)->where('store_id',$id)->whereIn('type_id',$typeids)->orderBy('hightest_price','desc')->paginate(12);
            }elseif ($request->sort=='name:asc') {
              $title='created_at';
              $products=Product::where(function ($query) use($searchword) {
                                          $query->where('title', 'LIKE', '%' . $searchword . '%')
                                                ->orWhere('title_ar','LIKE', '%' . $searchword . '%')
                                                ->orWhere('des','LIKE', '%' . $searchword . '%')
                                                ->orWhere('des_ar','LIKE', '%' . $searchword . '%');
                                                })->where('active',1)->where('store_id',$id)->whereIn('type_id',$typeids)->orderBy($title,'asc')->paginate(12);
            }elseif ($request->sort=='name:desc') {
              $title='created_at';
              $products=Product::where(function ($query) use($searchword) {
                                              $query->where('title', 'LIKE', '%' . $searchword . '%')
                                                    ->orWhere('title_ar','LIKE', '%' . $searchword . '%')
                                                    ->orWhere('des','LIKE', '%' . $searchword . '%')
                                                    ->orWhere('des_ar','LIKE', '%' . $searchword . '%');
                                                })->where('active',1)->where('store_id',$id)->whereIn('type_id',$typeids)->orderBy($title,'desc')->paginate(12);
            }
          //No Search Word
          }else{

            if($request->sort=='price:asc'){
              $products=Product::where(function ($query) use($id) {
                                          $query->where('active',1)
                                                ->where('store_id',$id);
                                              })->whereIn('type_id',$typeids)->orderBy('lowest_price','asc')->paginate(12);
            }elseif($request->sort=='price:dec'){
              $products=Product::where(function ($query) use($id) {
                                          $query->where('active',1)
                                                ->where('store_id',$id);
                                              })->whereIn('type_id',$typeids)->orderBy('hightest_price','desc')->paginate(12);
            }elseif ($request->sort=='name:asc') {
              $title='created_at';
              $products=Product::where(function ($query) use($id) {
                                          $query->where('active',1)
                                                ->where('store_id',$id);
                                                })->whereIn('type_id',$typeids)->orderBy($title,'asc')->paginate(12);
            }elseif ($request->sort=='name:desc') {
              $title='created_at';
              $products=Product::where(function ($query) use($id) {
                                              $query->where('active',1)
                                                    ->where('store_id',$id);
                                                })->whereIn('type_id',$typeids)->orderBy($title,'desc')->paginate(12);
            }

          }

        }elseif(!$request->sort && $request->cat && !$request->word){
          $subcat=SubCat::find($request->cat);
          foreach($subcat->types as $type){
            $typeids[]=$type->id;
          }
          $products=Product::where(function ($query) use($id) {
                                            $query->where('active',1)
                                                  ->where('store_id',$id);
                                                    })->whereIn('type_id',$typeids)->paginate(12);
        }elseif(!$request->sort && $request->cat && $request->word){
          $subcat=SubCat::find($request->cat);
          foreach($subcat->types as $type){
            $typeids[]=$type->id;
          }
          $searchword=$request->word;
          $products=Product::where(function ($query) use($searchword) {
                                            $query->where('title', 'LIKE', '%' . $searchword . '%')
                                                  ->orWhere('title_ar','LIKE', '%' . $searchword . '%')
                                                  ->orWhere('des','LIKE', '%' . $searchword . '%')
                                                  ->orWhere('des_ar','LIKE', '%' . $searchword . '%');
                                                    })->where('active',1)->where('store_id',$id)->whereIn('type_id',$typeids)->paginate(12);
        }elseif(!$request->sort && !$request->cat && $request->word){
          $searchword=$request->word;
          $products=Product::where(function ($query) use($searchword) {
                                            $query->where('title', 'LIKE', '%' . $searchword . '%')
                                                  ->orWhere('title_ar','LIKE', '%' . $searchword . '%')
                                                  ->orWhere('des','LIKE', '%' . $searchword . '%')
                                                  ->orWhere('des_ar','LIKE', '%' . $searchword . '%');
                                                    })->where('active',1)->where('store_id',$id)->paginate(12);
        }else {
          $products=Product::where('active',1)->where('store_id',$id)->orderBy('created_at')->paginate(12);
        }

        $view = view('site.pages.filter.data',compact('products'))->render();
        return response()->json(['html'=>$view]);

      }else {
        $products=Product::where('active',1)->where('store_id',$id)->orderBy('created_at')->paginate(12);
      }

      $store_name=$id==0?setting()->getname():Store::find($id)->getname();
      $storeid=$id;
      return view('site.pages.store',compact('products','store_name','storeid'));
}

///////////////////////////////Get Product Variation Price & Quantity With AJAX///////////////////////////////

public function getextoptions(Request $request){
  $product=Product::find($request->product_id);
  $product=$product->getextoptions($request->ids);
  if(isset($product)){
    $data=[
      'price'=>$product->getprice(),
      'quantity'=>$product->quantity,
      'image'=>$product->image,
      'id'=>$product->id,
    ];
    return response()->Json($data);
  }


}

/////////////////////////////////CHANGE CURRNECY/////////////////////////////////////

  public function currencychange($id){

    if(auth()->user()){
      auth()->user()->update([
        'currency'=>$id
      ]);
    }else {
      if(session()->has('currency')){
        session()->forget('currency');
      }
      session()->put('currency',$id);
    }
    return back();

  }

//////////////////////////STATIC PAGES////////////////////////////////////////////////////////

public function privacypolicy(){
  return view('site.pages.privacy_policy');
}

public function returnpolicy(){
  return view('site.pages.return_policy');
}

public function terms(){
  return view('site.pages.terms');
}


/////////////////////////////////////////////Contact Us///////////////////////////////////////

public function contactus(){
  return view('site.pages.contact_us');
}

public function contact_us(Request $request){

  $rules = [
      'title' => ['required'],
      'body' => ['required'],
  ];

  $messages = [
    // 'name.required'          =>trans('site.validator.recipientname_required'),
    // 'name_ar.required'      =>trans('site.validator.add_1_required'),
  ];

  $data=Validator::make(request()->all(),$rules,$messages)->validate();

  if(auth()->user()){
    Contactus::create([
      'user_id'=>auth()->user()->id,
      'name'=>$request->name,
      'email'=>$request->email,
      'phone'=>$request->phone,
      'title'=>$request->title,
      'body'=>$request->body,
    ]);
  }else {
    Contactus::create([
      'name'=>$request->name,
      'email'=>$request->email,
      'phone'=>$request->phone,
      'title'=>$request->title,
      'body'=>$request->body,
    ]);
  }

  session()->flash('success','Messages Sent Successfully');
  return redirect()->route('index');
}

///////////////////////Comments & Ratings/////////////////////////////////////////////////////

public function addcomment(Request $request){

  if($request->image){
    $img = Image::make($request->image);
    $image_name="untitled".time().'.png';
    $path = public_path('storage/images/comments/'.$image_name);
    $img->save($path);
    $comment=Comment::create([
      'title'=>$request->title,
      'body'=>$request->body,
      'user_id'=>auth()->user()->id,
      'product_id'=>$request->product,
      'image'=>$image_name,
    ]);
  }else{
    $comment=Comment::create([
      'title'=>$request->title,
      'body'=>$request->body,
      'user_id'=>auth()->user()->id,
      'product_id'=>$request->product,
    ]);
  }


  //if the user has Previous rating for the product, update it, otherwise create new one.
  $rating=Rating::where('user_id',auth()->user()->id)->where('product_id',$request->product)->get()->first();
  if(!empty($rating)){
    $rating->update([
      'score'=>$request->score
    ]);
  }else {
    $rating=Rating::create([
        'score'=>$request->score,
        'user_id'=>auth()->user()->id,
        'product_id'=>$request->product,
    ]);
  }

  $user_comments=Comment::where('product_id',$request->product)->where('user_id',auth()->user()->id)->get();
  //Add Reward Points If Enabled
  if(count($user_comments)==1){
    if(reward()->review==1){
      auth()->user()->update([
        'points'=>auth()->user()->points+reward()->review_points
      ]);
      $details=[
        'type'=>'reward',
        'for'=>'review',
        'product_id'=>$request->product,
        'points'=>reward()->review_points,
      ];
      auth()->user()->notify(new PointsEarned($details));
    }
  }

  $data=[
    'comment'=>[
          'name'=>$comment->user->name,
          'title'=>$comment->title,
          'body'=>$comment->body,
          'image'=>$comment->image
              ],
    'rating'=>$rating->score
  ];

  return response()->Json($data);
}

public function deletecomment($id){
  $comment=Comment::find($id);
  if(auth()->user()->id==$comment->user->id || auth()->user()->admin()){
    //Delete comment image (if any)
    Storage::delete('public/images/comments/'.$comment->image);
    $comment->delete();
    session()->flash('success','Comment has been deleted successfully');
  }else {
    session()->flash('error','You\'re not authorized');
  }
  return back();
}

///////////////////////////////////////////SEARCH PRODUCTS///////////////////////////////

public function search(Request $request){
  $searchword=$request->search;

  if($request->maincatid!=0){
    $maincat=MainCat::find($request->maincatid);
    $typeids=[];
    foreach($maincat->types as $type){$typeids[]=$type->id;}

    //search filter
    if($request->ajax()){
      //Sort By Type
      if($request->sort){
        if($request->subcat){
          $subcat=SubCat::find($request->subcat);
          $typeids=[];
          foreach($subcat->types as $type){
            $typeids[]=$type->id;
          }
        }
        if($request->sort=='price:asc'){
          $products=Product::where(function ($query) use ($searchword) {
                                      $query->where('title', 'LIKE', '%' . $searchword . '%')
                                            ->orWhere('title_ar','LIKE', '%' . $searchword . '%')
                                            ->orWhere('des','LIKE', '%' . $searchword . '%')
                                            ->orWhere('des_ar','LIKE', '%' . $searchword . '%');
                                          })->orderBy('lowest_price','asc')->whereIn('type_id',$typeids)->paginate(12);
        }elseif($request->sort=='price:dec'){
          $products=Product::where(function ($query) use ($searchword) {
                                      $query->where('title', 'LIKE', '%' . $searchword . '%')
                                            ->orWhere('title_ar','LIKE', '%' . $searchword . '%')
                                            ->orWhere('des','LIKE', '%' . $searchword . '%')
                                            ->orWhere('des_ar','LIKE', '%' . $searchword . '%');
                                          })->orderBy('hightest_price','desc')->whereIn('type_id',$typeids)->paginate(12);
        }elseif ($request->sort=='name:asc') {
          $title='created_at';
          $products=Product::where(function ($query) use ($searchword) {
                                        $query->where('title', 'LIKE', '%' . $searchword . '%')
                                              ->orWhere('title_ar','LIKE', '%' . $searchword . '%')
                                              ->orWhere('des','LIKE', '%' . $searchword . '%')
                                              ->orWhere('des_ar','LIKE', '%' . $searchword . '%');
                                            })->orderBy($title,'asc')->whereIn('type_id',$typeids)->paginate(12);
        }elseif ($request->sort=='name:desc') {
          $title='created_at';
          $products=Product::where(function ($query) use ($searchword) {
                                        $query->where('title', 'LIKE', '%' . $searchword . '%')
                                              ->orWhere('title_ar','LIKE', '%' . $searchword . '%')
                                              ->orWhere('des','LIKE', '%' . $searchword . '%')
                                              ->orWhere('des_ar','LIKE', '%' . $searchword . '%');
                                            })->orderBy($title,'desc')->whereIn('type_id',$typeids)->paginate(12);
        }
      }elseif(!$request->sort && $request->subcat){
        $subcat=SubCat::find($request->subcat);
        $typeids=[];
        foreach($subcat->types as $type){$typeids[]=$type->id;}
        $products=Product::where(function ($query) use ($searchword) {
                                              $query->where('title', 'LIKE', '%' . $searchword . '%')
                                                    ->orWhere('title_ar','LIKE', '%' . $searchword . '%')
                                                    ->orWhere('des','LIKE', '%' . $searchword . '%')
                                                    ->orWhere('des_ar','LIKE', '%' . $searchword . '%');
                                                  })->whereIn('type_id',$typeids)->paginate(12);
      }else {
        $products=Product::where('title', 'LIKE', '%' . $request->search . '%')
                                                  ->orWhere('title_ar','LIKE', '%' . $request->search . '%')
                                                  ->orWhere('des','LIKE', '%' . $request->search . '%')
                                                  ->orWhere('des_ar','LIKE', '%' . $request->search . '%')
                                                  ->whereIn('type_id',$typeids)
                                                  ->paginate(12);

      }

      $view = view('site.pages.filter.data',compact('products'))->render();
      return response()->json(['html'=>$view]);

    //No Ajax
    }else {
    $products=Product::where(function ($query) use ($searchword) {
                                          $query->where('title', 'LIKE', '%' . $searchword . '%')
                                                ->orWhere('title_ar','LIKE', '%' . $searchword . '%')
                                                ->orWhere('des','LIKE', '%' . $searchword . '%')
                                                ->orWhere('des_ar','LIKE', '%' . $searchword . '%');
                                              })->whereIn('type_id',$typeids)->paginate(12);
    }


  }else {
    //Main Cat ==0

    //search filter
    if($request->ajax()){
      //Sort By Type
      if($request->sort){
        if($request->subcat){
          $subcat=SubCat::find($request->subcat);
          $typeids=[];
          foreach($subcat->types as $type){
            $typeids[]=$type->id;
          }
        }else {
          $types=Type::all();
          $typeids=[];
          foreach($types as $type){
            $typeids[]=$type->id;
          }
        }

        if($request->sort=='price:asc'){
          $products=Product::where(function ($query) use ($searchword) {
                                      $query->where('title', 'LIKE', '%' . $searchword . '%')
                                            ->orWhere('title_ar','LIKE', '%' . $searchword . '%')
                                            ->orWhere('des','LIKE', '%' . $searchword . '%')
                                            ->orWhere('des_ar','LIKE', '%' . $searchword . '%');
                                          })->orderBy('lowest_price','asc')->whereIn('type_id',$typeids)->paginate(12);
        }elseif($request->sort=='price:dec'){
          $products=Product::where(function ($query) use ($searchword) {
                                      $query->where('title', 'LIKE', '%' . $searchword . '%')
                                            ->orWhere('title_ar','LIKE', '%' . $searchword . '%')
                                            ->orWhere('des','LIKE', '%' . $searchword . '%')
                                            ->orWhere('des_ar','LIKE', '%' . $searchword . '%');
                                          })->orderBy('hightest_price','desc')->whereIn('type_id',$typeids)->paginate(12);
        }elseif ($request->sort=='name:asc') {
          $title='created_at';
          $products=Product::where(function ($query) use ($searchword) {
                                        $query->where('title', 'LIKE', '%' . $searchword . '%')
                                              ->orWhere('title_ar','LIKE', '%' . $searchword . '%')
                                              ->orWhere('des','LIKE', '%' . $searchword . '%')
                                              ->orWhere('des_ar','LIKE', '%' . $searchword . '%');
                                            })->orderBy($title,'asc')->whereIn('type_id',$typeids)->paginate(12);
        }elseif ($request->sort=='name:desc') {
          $title='created_at';
          $products=Product::where(function ($query) use ($searchword) {
                                        $query->where('title', 'LIKE', '%' . $searchword . '%')
                                              ->orWhere('title_ar','LIKE', '%' . $searchword . '%')
                                              ->orWhere('des','LIKE', '%' . $searchword . '%')
                                              ->orWhere('des_ar','LIKE', '%' . $searchword . '%');
                                            })->orderBy($title,'desc')->whereIn('type_id',$typeids)->paginate(12);
        }
      }elseif(!$request->sort && $request->subcat){
        $subcat=SubCat::find($request->subcat);
        $typeids=[];
        foreach($subcat->types as $type){$typeids[]=$type->id;}
        $products=Product::where(function ($query) use ($searchword) {
                                              $query->where('title', 'LIKE', '%' . $searchword . '%')
                                                    ->orWhere('title_ar','LIKE', '%' . $searchword . '%')
                                                    ->orWhere('des','LIKE', '%' . $searchword . '%')
                                                    ->orWhere('des_ar','LIKE', '%' . $searchword . '%');
                                                  })->whereIn('type_id',$typeids)->paginate(12);
      }else {
        $products=Product::where('title', 'LIKE', '%' . $request->search . '%')
                                                  ->orWhere('title_ar','LIKE', '%' . $request->search . '%')
                                                  ->orWhere('des','LIKE', '%' . $request->search . '%')
                                                  ->orWhere('des_ar','LIKE', '%' . $request->search . '%')
                                                  ->paginate(12);

      }

      $view = view('site.pages.filter.data',compact('products'))->render();
      return response()->json(['html'=>$view]);

    //No Ajax
    }else {
    $products=Product::where(function ($query) use ($searchword) {
                                          $query->where('title', 'LIKE', '%' . $searchword . '%')
                                                ->orWhere('title_ar','LIKE', '%' . $searchword . '%')
                                                ->orWhere('des','LIKE', '%' . $searchword . '%')
                                                ->orWhere('des_ar','LIKE', '%' . $searchword . '%');
                                              })->paginate(12);
    }

  }

  $search=$request->search;
  return view('site.pages.searchresults',compact('products'));

}


//////////////////////////////////////////SELLERS SUBSCRIBTIONS///////////////////////////////////////////

public function subscribe(){

  if(!auth()->user()->country || !auth()->user()->country){
    session()->flash('error','Please Choose Your Profile Country And City First');
    return redirect()->route('myaccount');
  }

  if(auth()->user()->subscription){
    session()->flash('error','You\'re Already Subscribed To a Sellers Plan');
    return redirect()->route('myaccount');
  }
  $plans=Plan::orderBy('order','asc')->get();
  return view('site.pages.seller.subscribe',compact('plans'));
}

public function submitplan(Request $request){
  if(session()->has('plan')){
    session()->forget('plan');
  }
  session()->put('plan',$request->plan);

  $paymentmethods=Planspaymentmethod::all();
  return view('site.pages.seller.paymentmethod',compact('paymentmethods'));
}

public function submitpayment(Request $request){

  if(session()->has('paymentmethod')){
    session()->forget('paymentmethod');
  }
  session()->put('paymentmethod',$request->paymentmethod);
  return view('site.pages.seller.chooseperiod');
}
public function submitsub(Request $request){

  if(session()->has('period')){
    session()->forget('period');
  }
  session()->put('period',$request->period);

  return redirect()->route('reviewsubrequest');
}
public function reviewsubrequest(Request $request){
  $period=session('period');
  $paymentmethod=Planspaymentmethod::find(session('paymentmethod'));
  $plan=Plan::find(session('plan'));
  return view('site.pages.seller.reviewrequest',compact('period','paymentmethod','plan'));
}

public function confirmsubscribe(){
  if(auth()->user()->store){
    session()->flash('error','You Already Have A Store');
    return redirect()->route('myaccount');
  }

  if(!auth()->user()->subscription){
    if(empty(session('period')) || empty(session('plan')) || empty(session('paymentmethod'))){
      session()->flash('error','Something went wrong!');
      return redirect()->route('subscribe');
    }else {
      $subscription=Subscription::create([
        'plan_id'=>session('plan'),
        'start_date'=>Carbon::now()->toDateString(),
        'end_date'=>Carbon::now()->addDays(30*session('period'))->toDateString(),
        'paymentmethod'=>session('paymentmethod'),
        'user_id'=>auth()->user()->id,
      ]);
      if(session()->has('subscription')){
        session()->forget('subscription');
      }
      session()->put('subscription',$subscription->id);
  }
  }
  return view('site.pages.seller.createstore');
}

public function createstore(Request $request){

  if(!auth()->user()->subscription){
    session()->flash('error','You\'re Not Subscribed To Any Sellers Plan');
    return redirect()->route('myaccount');
  }
  if(auth()->user()->store){
    session()->flash('error','You Already Have A Store');
    return redirect()->route('myaccount');
  }


  $rules = [
      'name' => ['required'],
      'name_ar' => ['required'],
      'address' => ['required'],
  ];

  $messages = [
    // 'name.required'          =>trans('site.validator.recipientname_required'),
    // 'name_ar.required'      =>trans('site.validator.add_1_required'),
    // 'address.required'      =>trans('site.validator.add_1_required'),
  ];

  $data=Validator::make(request()->all(),$rules,$messages)->validate();
  $store=Store::create([
    'name'=>$request->name,
    'name_ar'=>$request->name_ar,
    'subscription_id'=>auth()->user()->subscription->id,
    'owner_id'=>auth()->user()->id,
    'trans_left'=>auth()->user()->subscription->plan->trans_limit,
    'trans_limit'=>auth()->user()->subscription->plan->trans_limit,
    'address'=>$request->address,
  ]);

  auth()->user()->update([
    'store_id'=>$store->id
  ]);

  session()->flash('success','Subscription Request is under review, it will be activated after you pay subscription value');
  return redirect()->route('myaccount');
}

public function create_store(){
  if(!auth()->user()->subscription){
      session()->flash('success','You\'re Not Subscribe To Any Plan, Please Subscribe First');
      return redirect()->route('subscribe');
  }
  return view('site.pages.seller.createstore');
}

//////////////////////////////////////////////Notification/////////////////////////////////////////////////////////

public function notifications($id){
  $notification=auth()->user()->notifications()->where('id',$id)->first();
  $notification->markAsRead();

  if($notification->data['type']=='orderstatus'){
    $ordernumber=getordergroup($notification->data['ordergroup_id'])->order_number;
    return redirect()->route('order_details',$ordernumber);
  }elseif($notification->data['type']=='delivery'){
    $ordernumber=getordergroup($notification->data['ordergroup_id'])->order_number;
    return redirect()->route('order_details',$ordernumber);
  }elseif($notification->data['type']=='reward' && ($notification->data['for']=='email' || $notification->data['for']=='phone')) {
    return redirect()->route('myaccount');
  }elseif($notification->data['type']=='reward' && $notification->data['for']=='review') {
    $product=Product::find($notification->data['product_id']);
    return redirect()->route('show.product',$product->getslug());
  }elseif($notification->data['type']=='reward' && $notification->data['for']=='purchase') {
    $product=Product::find($notification->data['product_id']);
    return redirect()->route('show.product',$product->getslug());
  }
}

}
