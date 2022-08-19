<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use App\Extoption;
use App\MainCat;
use App\Country;
use App\City;
use App\Shippingmethod;
use App\Ordergroup;
use App\Order;
use App\Notifications\PointsEarned;
use Illuminate\Http\Request;

class CartController extends Controller
{

public function __construct()
{
   $this->middleware('auth')->only(['shippingaddress','shippingmethod','paymentmethod','submitorder']);
   $this->middleware('notemptycart')->only(['shippingmethod','paymentmethod','submitorder']);
}

public function index()
{
    return view('site.pages.cart');
}


///////////////////////////////ORDERS/////////////////////////////////////////////////////////////

public function submitorder(Request $request){

  $shippingmethodid=session('shippingmethodid');
  $addressid=session('addressid');
  $paymentmethodid=$request->paymentmethod;
  $currencyid=getcurrency()->id;

  $ordergroup=Ordergroup::create([
      'user_id'=>auth()->user()->id,
      'order_number'=>auth()->user()->id+rand(1,10000),
      'shippingmethod'=>$shippingmethodid,
      'paymentmethod'=>$paymentmethodid,
      'currency'=>$currencyid,
      'address'=>$addressid,
  ]);

foreach(auth()->user()->carts as $cart){
    Order::create([
      'user_id'=>auth()->user()->id,
      'product_id'=>$cart->product_id,
      'extoption_id'=>$cart->extoption_id,
      'quantity'=>$cart->quantity,
      'price'=>$cart->extoption?$cart->extoption->price:$cart->product->price,
      'qprice'=>$cart->qprice(),
      'store_id'=>$cart->product->store_id,
      'currency'=>$currencyid,
      'paymentmethod'=>$paymentmethodid,
      'address'=>$addressid,
      'status'=>1,
      'ordergroup'=>$ordergroup->id,
    ]);
    
  //Add Reward Points If Enabled
    $product=Product::find($cart->product_id);
    if(reward()->product==1){
      auth()->user()->update([
        'points'=>auth()->user()->points+$product->reward_points
      ]);
      $details=[
        'type'=>'reward',
        'for'=>'purchase',
        'product_id'=>$product->id,
        'points'=>$product->reward_points,
      ];
      auth()->user()->notify(new PointsEarned($details));
    }

  //updating product qunatity and sales count
    if($cart->extoption){
      $cart->extoption->update([
      'quantity'=>$cart->extoption->quantity-1,
      'sales'=>$cart->extoption->sales+1,
        ]);
      $cart->product->update([
        'sales'=>$cart->product->sales+1,
      ]);
    }else {
      $cart->product->update([
        'quantity'=>$cart->product->quantity-1,
        'sales'=>$cart->product->sales+1,
      ]);
    }
  }

  auth()->user()->carts()->delete();
  return redirect()->route('orderplaced',$ordergroup->order_number);

}


public function orderplaced($ordernumber){
  session()->flash('success','Your Order Has Been Placed Succesfully');
  $ordergroup=Ordergroup::where('order_number',$ordernumber)->first();
  if(empty($ordergroup)){
    session()->flash('error','Order Doesn\'t Exist');
    return redirect()->route('index');
  }
  return view('site.pages.orderplaced',compact('ordergroup'));
}

///////////////////////////////PAYMENT METHOD//////////////////////////////////////////////////////

public function paymentmethod(){
  return view('site.pages.payment');
}

///////////////////////////////SHIPPING METHOD//////////////////////////////////////////////////////

public function shippingmethod(Request $request){
  if(empty(session('addressid'))){
    session()->flash('error','Please Choose Shipping Address');
    return redirect()->route('shippingaddress');
  }
  $shippingmethods=Shippingmethod::all();
  return view('site.pages.shippingmethod',compact('shippingmethods'));
}

public function shippingselected(Request $request){

  if(session()->has('shippingmethodid')){
    session()->forget('shippingmethodid');
  }
  session()->put('shippingmethodid',$request->shippingmethod);
  return redirect()->route('paymentmethod');
}
///////////////////////////////SHIPPING ADDRESS////////////////////////////////////////////////////////

public function shippingaddress(){

if(count(auth()->user()->carts)==0){
  session()->flash('error','Your Shopping Cart Is Empty');
  return redirect()->route('cart.index');
}

$countries=Country::all();
return view('site.pages.shippingaddress',compact('countries'));

}

///////////////////////////////ADD TO CART WITH AJAX///////////////////////////////////////////////////

public function addtocart(Request $request){

  $cart=Cart::where([
                ['product_id',$request->productid],
                ['extoption_id',$request->extoptionid],
                ['user_id',auth()->user()->id],
                          ])->get()->first();

  if($cart){
    //prevent user from adding quantity more than what's available
    $newquantity=$cart->quantity+$request->quantity;
    if($newquantity<=$cart->getmaxquantity()){
      $cart->update([
        'quantity'=>$newquantity,
      ]);
    }else {
      return response()->Json(['quantityerror'=>1]);
    }

  //creating new cart
  }else {
    $cart=Cart::create([
      'product_id'=>$request->productid,
      'extoption_id'=>$request->extoptionid,
      'quantity'=>$request->quantity,
      'user_id'=>auth()->user()->id,
    ]);
  }

  $all=[];

  //cart count
  $count=count(auth()->user()->carts);
  //total price
  $totalprice=auth()->user()->totalcartprice();

  foreach (auth()->user()->carts as $cart) {
    //quantity price
    if($cart->extoption){
        $qprice=$cart->extoption->price*$cart->quantity;
    }else{
        $qprice=$cart->product->price*$cart->quantity;
    }
    //options names
    $options_names='';
    if($cart->extoption){
      foreach ($cart->extoption->options as $option) {
        $options_names.=$option->getname().'-';
      }
      $options_names=rtrim($options_names,'-');
    }

    $all[]=[
      'name'=>$cart->product->gettitle(),
      'slug'=>$cart->product->getslug(),
      'productid'=>$cart->product->id,
      'extoptionid'=>$cart->extoption?$cart->extoption->id:'',
      'image'=>$cart->product->image,
      'qprice'=>$qprice*getcurrency()->value.' '.getcurrency()->getabbreviation(),
      'quantity'=>$cart->quantity,
      'options'=>$options_names,
      'cartid'=>$cart->id,
    ];
  }

  $data=[
    'totalprice'=>$totalprice*getcurrency()->value.' '.getcurrency()->getabbreviation(),
    'count'=>$count,
    'data'=>$all,
    'quantityerror'=>0
  ];

  return response()->Json($data);
}

///////////////////////////////UPDATING USER CART QUANTITY WITH AJAX/////////////////////////////////////////

    public function updatecartquantity(Request $request){


      $cart=Cart::find($request->cartid);

      if($cart->extoption){
        //the desired quantity by user can not excceed the quantity avaiable in stock
        if($request->newquantity<=$cart->extoption->quantity && $request->newquantity>=1){
          $cart->update([
            'quantity'=>$request->newquantity
          ]);
          $qprice=$cart->extoption->price*$request->newquantity;
        }
      }else{
        //the desired quantity by user can not excceed the quantity avaiable in stock
        if($request->newquantity<=$cart->product->quantity && $request->newquantity>=1){
          $cart->update([
            'quantity'=>$request->newquantity
          ]);
          $qprice=$cart->product->price*$request->newquantity;
        }
      }

      $totalprice=0;
      foreach (auth()->user()->carts as $cart) {
        $totalprice+=$cart->extoption?$cart->extoption->price*$cart->quantity:$cart->product->price*$cart->quantity;
      }

      $data=[
        'qprice'=>$qprice*getcurrency()->value.' '.getcurrency()->getabbreviation(),
        'totalprice'=>$totalprice*getcurrency()->value.' '.getcurrency()->getabbreviation(),
      ];

      return response()->Json($data);
    }

//////////////////////////////DELETING FROM USER CART WITH AJAX//////////////////////////////////////////////

public function deletefromcart(Request $request){
  $cart=Cart::find($request->cartid);
  $cart->delete();
  $totalprice=0;
  foreach (auth()->user()->carts as $cart) {
    $totalprice+=$cart->extoption?$cart->extoption->price*$cart->quantity:$cart->product->price*$cart->quantity;
  }
  $data=[
    'totalprice'=>$totalprice*getcurrency()->value.' '.getcurrency()->getabbreviation(),
    'count'=>count(auth()->user()->carts)
  ];
  return response()->Json($data);
}

///////////////////////////////GRABING GUEST CART WITH AJAX/////////////////////////////////////////


    public function guestcart(Request $request)
    {
      $product=Product::find($request->product_id);
      $quantity=$request->quantity;

      if(!empty($request->extoption)){
        $extoption=Extoption::find($request->extoption);
        $qprice=$quantity*$extoption->price;
      }else {
        $qprice=$quantity*$product->price;
      }
      $image=$product->image;
      $name=$product->gettitle();
      $data=[
        'productid'=>$product->id,
        'extoptionid'=>(isset($extoption->id)?$extoption->id:''),
        'price'=>(isset($extoption->price)?$extoption->price*getcurrency()->value.' '.getcurrency()->getabbreviation():$product->price*getcurrency()->value.' '.getcurrency()->getabbreviation()),
        'name'=>$name,
        'quantity'=>$quantity,
        'maxquantity'=>$product->quantity?$product->quantity:$extoption->quantity,
        'qprice'=>$qprice*getcurrency()->value.' '.getcurrency()->getabbreviation(),
        'image'=>$image,
        'slug'=>$product->getslug(),
        'options'=>(isset($extoption->options)?$extoption->options:'')];
      return response()->Json($data);
    }
}
