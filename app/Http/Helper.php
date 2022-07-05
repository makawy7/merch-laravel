<?php


if(!function_exists('styledir')){
  function styledir(){
    return app()->getLocale()=='ar'?'rtl':'ltr';
  }
}

if(!function_exists('generateSlug')){
  function generateSlug($string){
    $string=trim($string," ");
    $string= preg_replace('/[^أ-يA-Za-z0-9 ]/u', '', $string);
    return preg_replace('/\s+/', '-', $string);
  }
}

if(!function_exists('unreadcontactus')){
  function unreadcontactus(){
    return \App\Contactus::where('read_at',null)->get();
  }
}

if(!function_exists('countries')){
  function countries(){
    return \App\Country::orderBy('order','asc')->get();
  }
}

if(!function_exists('ordersinq')){
  function ordersinq(){
    return \App\Ordergroup::where('delivered',0)->get();
  }
}

if(!function_exists('maincats')){
  function maincats(){
    return \App\MainCat::all();
  }
}

if(!function_exists('banners')){
  function banners(){
    return \App\Banner::all();
  }
}

if(!function_exists('scats')){
  function scats(){
    return \App\Specialcat::all();
  }
}
if(!function_exists('ads')){
  function ads($number){
    return \App\Ad::inRandomOrder()->take($number)->get();
  }
}

if(!function_exists('mostviewed')){
  function mostviewed(){
    return \App\Product::where('active',1)->orderBy('views')->skip(0)->take(10)->get();
  }
}

if(!function_exists('product')){
  function product($id){
    return \App\Product::find($id);
  }
}


if(!function_exists('currencies')){
  function currencies(){
    return \App\Currency::orderBy('order','asc')->get();
  }
}

if(!function_exists('setting')){
  function setting(){
    return App\Setting::find(1);
  }
}

if(!function_exists('reward')){
  function reward(){
    return App\Reward::find(1);
  }
}

if(!function_exists('getpaymentmethods')){
  function getpaymentmethods(){
    return App\Paymentmethod::orderBy('order','asc')->get();
  }
}

if(!function_exists('getcurrency')){
  function getcurrency(){
    if(auth()->user()){
      return App\Currency::find(auth()->user()->currency);
    }elseif(session()->has('currency')){
      return App\Currency::find(session('currency'));
    }else {
      return App\Currency::find(setting()->default_currency);
    }
  }
}

if(!function_exists('products')){
  function products(){
      return App\Product::all();
  }
}

if(!function_exists('users')){
  function users(){
      return App\User::all();
  }
}

if(!function_exists('user')){
  function user($id){
      return App\User::find($id);
  }
}
if(!function_exists('store')){
  function store($id){
      return App\Store::find($id);
  }
}

if(!function_exists('since')){
  function since($created_at){
    $created = new \Carbon\Carbon($created_at);
    $now = \Carbon\Carbon::now();

    if ($created->diffInMinutes($now) < 1) {
        $since = "منذ اقل من دقيقة";
    } elseif ( $created->diffInMinutes($now) <= 60) {
        $since = $created->diffInMinutes($now) > 1 ? sprintf("منذ %d دقائق", $created->diffInMinutes($now)) : sprintf("منذ %d دقيقة", $created->diffInMinutes($now));
    } elseif ($created->diffInHours($now) <= 24) {
        $since = $created->diffInHours($now) > 1 ? sprintf("منذ %d ساعات", $created->diffInHours($now)) : sprintf("منذ %d ساعة", $created->diffInHours($now));
    } else {
        $since = $created->diffInDays($now) > 1 ? sprintf("منذ %d ايام", $created->diffInDays($now)) : sprintf("منذ %d يوم", $created->diffInDays($now));
    }
    return $since;
  }
}


if(!function_exists('unreadcount')){
  function unreadcount($from=null,$to,$source){
      if($from!=null){
        if($source=='store'){
            $count= App\Message::select(DB::raw('count("read_at") as read_at'))->where([['from',$from],['to',$to],['source',$source],['read_at',null]])->first();
        }else {
            $count= App\Message::select(DB::raw('count("read_at") as read_at'))->where([['from',$from],['to',$to],['source',$source],['read_at',null]])->first();
        }
      }else {
        if($source=='user'){
            $count= App\Message::select(DB::raw('count("read_at") as read_at'))->where([['to',$to],['source',$source],['read_at',null]])->first();
        }else {
            $count= App\Message::select(DB::raw('count("read_at") as read_at'))->where([['to',$to],['source',$source],['read_at',null]])->first();
        }
      }
      return   $count->read_at;
  }
}


if(!function_exists('getordergroup')){
  function getordergroup($id){
      return App\Ordergroup::find($id);
  }
}

if(!function_exists('getstatus')){
  function getstatus($id){
      return App\Orderstatus::find($id);
  }
}

if(!function_exists('currentyear')){
  function currentyear(){
      return \Carbon\Carbon::now()->year;
  }
}
if(!function_exists('previousyear')){
  function previousyear(){
      return \Carbon\Carbon::now()->year-1;
  }
}

if(!function_exists('currentmonth')){
  function currentmonth(){
      return \Carbon\Carbon::now()->month;
  }
}

if(!function_exists('profits')){

  function profits($year,$month=null){
      $sales=0;
      $websales=0;
      $storesales=0;
      $webprofits=0;
      $storesprofits=0;

      if($month==null){
        $ordergroups=App\Ordergroup::where('paid',1)->whereYear('created_at', '=', $year)
                                                    ->get();
      }else {
        $ordergroups=App\Ordergroup::where('paid',1)->whereYear('created_at', '=', $year)
                                                    ->whereMonth('created_at', '=', $month)
                                                    ->get();
      }

      foreach($ordergroups as $ordergroup){

        foreach ($ordergroup->orders as $order) {
          $sales+=$order->quantity;
        }

        foreach ($ordergroup->orders()->where('store_id',0)->get() as $order) {
          $websales+=$order->quantity;
        }

        foreach ($ordergroup->orders()->where('store_id','!=',0)->get() as $order) {
          $storesales+=$order->quantity;
        }

        foreach ($ordergroup->orders()->where('store_id',0)->get() as $order) {
          $webprofits+=$order->qprice;
        }

        foreach ($ordergroup->orders()->where('store_id','!=',0)->get() as $order) {
            if($order->store){
              $commission=($order->store->subscription->plan->fee/100)*$order->qprice;
              if($commission<$order->store->subscription->plan->min_fee){
                $commission=$order->store->subscription->plan->min_fee;
              }elseif ($commission>$order->store->subscription->plan->max_fee) {
                $commission=$order->store->subscription->plan->max_fee;
              }
              $storesprofits+=$commission;
            }
        }

      }

      $data=[
        'sales'=>$sales,
        'websales'=>$websales,
        'storesales'=>$storesales,
        'webprofits'=>$webprofits,
        'storesprofits'=>$storesprofits,
      ];

      return $data;
  }
}



if(!function_exists('storeprofit')){

  function storeprofit($year,$storeid,$month=null){

      $sales=0;
      $storeprofit=0;
      $webcommission=0;

      if($month==null){
        $ordergroups=App\Ordergroup::where('paid',1)->whereYear('created_at', '=', $year)
                                                    ->get();
      }else {
        $ordergroups=App\Ordergroup::where('paid',1)->whereYear('created_at', '=', $year)
                                                    ->whereMonth('created_at', '=', $month)
                                                    ->get();
      }

      foreach($ordergroups as $ordergroup){

        foreach ($ordergroup->orders()->where('store_id',$storeid)->get() as $order) {
          $sales+=$order->quantity;
        }

        foreach ($ordergroup->orders()->where('store_id',$storeid)->get() as $order) {
          $storeprofit+=$order->qprice;
        }

        foreach ($ordergroup->orders()->where('store_id',$storeid)->get() as $order) {
            if($order->store){
              $commission=($order->store->subscription->plan->fee/100)*$order->qprice;
              if($commission<$order->store->subscription->plan->min_fee){
                $commission=$order->store->subscription->plan->min_fee;
              }elseif ($commission>$order->store->subscription->plan->max_fee) {
                $commission=$order->store->subscription->plan->max_fee;
              }
              $webcommission+=$commission;
            }
        }

      }

      $data=[
        'sales'=>$sales,
        'storeprofit'=>$storeprofit,
        'webcommission'=>$webcommission,
      ];

      return $data;
  }
}


if(!function_exists('cansell')){
  function cansell(){

    if(!auth()->user()){
      return false;
    }

    if(!auth()->user()->store){
      return false;
    }

    if(!auth()->user()->store->subscription){
      return false;
    }

    $active=auth()->user()->store->subscription->active;
    $paid=auth()->user()->store->subscription->paid;
    $expdate=\Carbon\Carbon::parse(auth()->user()->store->subscription->end_date);
    $today= \Carbon\Carbon::now();
    if($active==1 && $paid==1 && $today->diffInDays($expdate, false) >= 0){
      return true;
    }else {
      return false;
    }
  }
}
