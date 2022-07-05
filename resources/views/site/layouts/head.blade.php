<!-- ================ بداية header ============= -->
  <div class="header-container">
 <header id="header">
	  <!-- ================ بداية nav ============= -->
		<div class="nav">
        <div class="container">
          <div class="row">
            <nav>
              @if(auth()->user())
                @include('site.includes.dropdown_profile')
              @else
              <div class="header_user_info">
                <ul>
                  <li class="style md-trigger" data-modal="modal-2"><a href="#"><i class="fa fa-user"></i>&nbsp;إنشاء حساب</a></li>
                  <li class="style md-trigger" data-modal="modal-1"><a href="#"><i class="fa fa-user"></i>&nbsp;تسجيل دخول</a></li>
                </ul>
              </div>
              @endif
              <div id="currencies-block-top">
                <form id="setCurrency" action="#" method="post">
                  <div class="current">
                    <input type="hidden" name="id_currency" id="id_currency" value=""/>
                    <input type="hidden" name="SubmitCurrency" value="" />
                    <span class="cur-label">العمله :</span> <strong>{{getcurrency()->getabbreviation()}}</strong> <i class="fa fa-caret-down"></i></div>
                    <ul id="first-currencies" class="currencies_ul toogle_content">
                      @if(function_exists('currencies') && count(currencies())>0)
                        @foreach(currencies() as $currency)
                          <li > <a href="{{route('currencychange',$currency->id)}}"> {{$currency->getname()}} ({{$currency->getabbreviation()}}) </a> </li>
                        @endforeach
                      @endif
                    </ul>
                </form>
              </div>
              <div id="languages-block-top" class="languages-block">
									@if(app()->getLocale()=='ar')
											<div class="current"> <span><img src="{{url('des/site')}}/images/ar.png"></span>
											<span class="cur-label">&nbsp; العربية</span>&nbsp; <i class="fa fa-caret-down"></i>  </div>
											<ul id="first-languages" class="languages-block_ul toogle_content">
											<li class="selected"> <span><img src="{{url('des/site')}}/images/ar.png"> العربية</span></li>
											<li><a href="{{route('lang','en')}}">  <span> <img src="{{url('des/site')}}/images/en.jpg"> English</span>  </a> </li>
									@else
											<div class="current"> <span><img src="{{url('des/site')}}/images/en.jpg"></span>
											<span class="cur-label">&nbsp; English</span>&nbsp; <i class="fa fa-caret-down"></i>  </div>
											<ul id="first-languages" class="languages-block_ul toogle_content">
											<li class="selected"> <span><img src="{{url('des/site')}}/images/en.jpg"> English</span></li>
											<li><a href="{{route('lang','ar')}}">  <span> <img src="{{url('des/site')}}/images/ar.png"> العربية</span>  </a> </li>
									@endif

                </ul>
              </div>
            </nav>
          </div>
        </div>
      </div>
      <!-- ================  نهاية nav  ============= -->
		<div class="headerdiv">
						<div class="container">
							<div class="row">
								<div id="header_logo"> <a href="{{route('index')}}"> <img class="logo img-responsive" src="{{url('storage/images/setting/'.setting()->logo)}}" alt="Logo" title="Logo"/> </a> </div>
								<div id="tmcmsheaderblock">

					<div class="col-xs-12">
            @include('site.includes.bellandheart')
				</div>
					</div>
          @include('site.includes.searchbar')
            <div class="header_cart col-sm-4 clearfix padding-left  {{url()->current()==route('cart.index')?'hide':''}}">
                          <div class="shopping_cart">
                          <a href="#">
                          <span class="ajax_cart_quantity style">@if(auth()->user())
            							{{count(auth()->user()->carts)}}
            							@endif</span>
                          <span class="cart_block_total ajax_block_cart_total hidden-xs">الإجمالى : <span class="totalprice">{{auth()->user()?auth()->user()->totalcartprice()*getcurrency()->value.' '.getcurrency()->getabbreviation():0}}</span> </span>
                          </a>

                            <div class="cart_block block exclusive">
                              <div class="block_content">
                                <div class="cart_block_list">
                                  <dl class="products">
            												@if(auth()->user())
            													@foreach(auth()->user()->carts as $cart)
            														<dt data-id="cart_block_product_3_13_0" class="last_item"> <a class="cart-images" href="#"><img src="{{url('')}}/storage/images/products/{{$cart->product->image}}"/></a>
            															 <div class="cart-info">
            																 <div class="product-name"> <span class="quantity-formated">
            																 </span> <a class="cart_block_product_name" href="{{url('')}}/products/{{$cart->product->getslug()}}">{{$cart->product->gettitle()}}</a> </div>
            																 <small>{{$cart->getoptions()}}</small>
            																 <div class="quantity"> الكمية : <span class="cartquantity">{{$cart->quantity}}</span></div>
            																 <span>{{$cart->qprice()*getcurrency()->value.' '.getcurrency()->getabbreviation()}}</span>
            																</div>
            															<span class="remove_link" data-cartid={{$cart->id}}><a  href="#"> </a></span>
            														</dt>
            													@endforeach
            												@endif
                                  </dl>
                                  <div class="cart-prices">
                                    <div class="cart-prices-line last-line"> <span class="cart_block_total ajax_block_cart_total totalprice2">{{auth()->user()?auth()->user()->totalcartprice()*getcurrency()->value.' '.getcurrency()->getabbreviation():0}}</span> <span>الأجمالى</span> </div>
                                  </div>
                                  <p class="cart-buttons"> <a class="btn btn-info" href="{{route('cart.index')}}"><span><i class="fa fa-shopping-cart"></i> عرض السلة</span></a> </p>
                                  <p class="cart-buttons"> <a class="btn btn-info" href="{{route('shippingaddress')}}"><span>اتمام الطلب</span></a> </p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
@include('site.includes.topmenu')
								<div id="tm_vertical_menu" class="tmvm-contener clearfix block">
               <div class="cat-title title_block">الأقسام والمناسبات</div>
              <div class="block_content">
                <ul class="tmvm-menu clearfix tmvmmenu-content">
                  <li  class="tm-haschild"><a href="#" title="القسم الأول">القسم الأول</a>
                <div class="tmvm_menu_container">
                  <div class="tmvm_menu_inner" style="width:388px;">
                    <div class="tmvm_menu_col col2">
                      <ul>
                        <li  class="tm-hassubchild"><a href="#" title="متفرع من القسم الأول واحد">متفرع من القسم الأول</a>
                          <ul>
                            <li  class=""><a href="#" title="متفرع 1">متفرع 1</a></li>
                            <li  class=""><a href="#" title="متفرع 2">متفرع 2</a></li>
                            <li  class=""><a href="#" title="متفرع 3">متفرع 3</a></li>
                            <li  class=""><a href="#" title="متفرع 4">متفرع 4</a></li>
                            <li  class=""><a href="#" title="متفرع 5">متفرع 5</a></li>
                          </ul>
                        </li>
                        <li  class="tm-hassubchild"><a href="#" title="متفرع من القسم الأول ثانى">متفرع من القسم الأول</a>
                          <ul>
                            <li  class=""><a href="#" title="متفرع 1">متفرع 1</a></li>
                            <li  class=""><a href="#" title="متفرع 2">متفرع 2</a></li>
                            <li  class=""><a href="#" title="متفرع 3">متفرع 3</a></li>
                            <li  class=""><a href="#" title="متفرع 4">متفرع 4</a></li>
                            <li  class=""><a href="#" title="متفرع 5">متفرع 5</a></li>
                          </ul>
                        </li>
                        <li class="category-thumbnail">
                          <div><img src="{{url('des/site')}}/images/banner.jpg" alt="اعلان" title="اعلان" class="imgm" /></div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </li>
              <li  class="tm-haschild"><a href="#" title="القسم الثانى">القسم الثانى</a>
                <div class="tmvm_menu_container">
                  <div class="tmvm_menu_inner" style="width:194px;">
                    <div class="tmvm_menu_col col1">
                      <ul>
                            <li  class=""><a href="#" title="متفرع من القسم الثانى">متفرع من القسم الثانى</a></li>
                            <li  class=""><a href="#" title="متفرع من القسم الثانى">متفرع من القسم الثانى</a></li>
                            <li  class=""><a href="#" title="متفرع من القسم الثانى">متفرع من القسم الثانى</a></li>
                            <li  class=""><a href="#" title="متفرع من القسم الثانى">متفرع من القسم الثانى</a></li>
                            <li  class=""><a href="#" title="متفرع من القسم الثانى">متفرع من القسم الثانى</a></li>
                          </ul>
                    </div>
                  </div>
                </div>
              </li>
              <li  class=""><a href="#" title="القسم الثالث">القسم الثالث</a></li>
              <li  class=""><a href="#" title="القسم الرابع">القسم الرابع</a></li>
              <li  class=""><a href="#" title="القسم الخامس">القسم الخامس</a></li>
                </ul>
              </div>
            </div>
							</div>

						</div>
					</div>
		</header>
    <div class="fullbg"></div>
  </div>
  <!-- ================ نهاية header ============= -->
