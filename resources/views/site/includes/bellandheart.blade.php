@if(auth()->user())

<ul class="top-right-list">
    <li class="cart-header dropdown head-cart-content">
            <a href="#" id="dropdownMenuButton" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="fa-stack fa-lg"><i class="fa fa-bell-o fa-stack-2x"></i></span>
              <span class="block"><span class="items">{{count(auth()->user()->unreadNotifications)}}</span></span>
            </a>
            <div class="shopping-cart shopping-cart-empty dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                <ul class="shopping-cart-items">
                    @foreach(auth()->user()->notifications()->limit(7)->get() as $notification)
                      <li class="{{$notification->unread()?'alert alert-warning':''}}">
                        @if($notification->data['type']=='orderstatus')
                        <a href="{{route('notifications',$notification->id)}}">
                          تم تغيير حالة الشحنه رقم {{getordergroup($notification->data['ordergroup_id'])->order_number}} الي "{{getstatus($notification->data['status'])->getname()}}"
                        </a>
                        @elseif($notification->data['type']=='delivery')
                        <a href="{{route('notifications',$notification->id)}}">
                          تم توصيل الطلب {{getordergroup($notification->data['ordergroup_id'])->order_number}}
                        </a>
                        @elseif($notification->data['type']=='reward')
                        <a href="{{route('notifications',$notification->id)}}">
                            مبروك ربحت {{$notification->data['points']}} نقطة مكافأة @if($notification->data['for']=='phone')
                                                        لتأكيد رقم الهاتف
                                                        @elseif($notification->data['for']=='email')
                                                        لتأكيد البريد الالكتروني
                                                        @elseif($notification->data['for']=='review')
                                                        لمراجعة المنتج "{{product($notification->data['product_id'])->gettitle()}}"
                                                        @elseif($notification->data['for']=='purchase')
                                                        لشراء المنتج "{{product($notification->data['product_id'])->gettitle()}}"
                                                        @endif

                        </a>
                        @endif
                      </li>
                    @endforeach
                </ul>
            </div>
    </li>
    <li class="wishlist-header">
        <a href="{{route('wishlist')}}">
         <span class="block"><span class="items">{{count(auth()->user()->likes)}}</span></span>
          <span class="fa-stack fa-lg"><i class="fa fa-heart-o fa-stack-2x"></i></span>
        </a>
    </li>
</ul>

@endif
