
@extends('site.layouts.layout2')

@section('content')

<!-- === بداية محتوى الصفحة العمود الايمن والايسر ... ملحوظة ترتيب محتوى الصفحات مختلفة عن محتوى الصفحة الرئيسية ====== -->
<div id="columns" class="container">
  <div class="row" id="columns_inner">
    <!-- ================ بداية يمين الصفحة ============= -->
    <div id="left_column" class="col-xs-12 col-sm-3 col-md-3 col-lg-3">

      @include('site.includes.menu')
      @include('site.includes.myaccount')
    </div>
    <!-- ================ نهاية يمين الصفحة ============= -->

    <!-- ================ بداية اليسار الصفحة ============= -->
    <div id="center_column" class="center_column col-xs-12 col-sm-9 col-md-9 col-lg-9">

      <div >
        <ul class="product_list grid row">
          <div class="block_content row">
            <h3>قائمه الاماني</h3>
            @if(count(auth()->user()->likes)>0)
              @foreach(auth()->user()->likes as $product)
                <li class="item col-xs-12 col-sm-4 col-md-4 col-lg-3">
                  <div class="product-container" >
                    <div class="left-block">
                      <div class="product-image-container"> <a class="product_img_link" href="{{route('show.product',$product->getslug())}}"> <img class="replace-2x img-responsive" src="{{url('storage/images/products/'.$product->image)}}" /> </a> <a class="sale-box" href="#">
                         <!-- <span class="sale-label"> خصم 5% </span>  -->
                       </a> <a class="new-box" href="#"> <span class="new-label">جديد</span> </a>
                        <div class="right-block">
                          <h5 itemprop="name"> <a class="product-name" href="cart-data.html" >{{$product->gettitle()}}</a> </h5>
                          <div class="hook-reviews">
                            <div class="comments_note">
                              <div class="star_content clearfix">
                                @if($product->getratings()>0)
                                  @for($i=0;$i<$product->getratings();$i++)
                                    <div class="star"><a title="{{$i}}">{{$i}}</a></div>
                                  @endfor
                                @else
                                  no ratings
                                @endif
                                <meta itemprop="worstRating" content = "0" />
                                <meta itemprop="ratingValue" content = "0" />
                                <meta itemprop="bestRating" content = "5" />
                                <span class="nb-comments"><span>( {{count($product->comments)}} )</span> تعليق</span>
                              </div>
                            </div>
                            <div class="content_price"> <span class="button-price price product-price"> {{$product->price?$product->getprice():$product->getpricerange()}}
                               <!-- <span class="old-price product-price"> ل.س 2.000 </span>  -->
                             </span> </div>
                            <div class="button-container"> <a class="button ajax_add_to_cart_button btn btn-default" href="#" rel="nofollow"> <span>أضف الى السلة</span> </a> <a class="button lnk_view btn btn-default" href="#"> <span>المزيد</span> </a>
                              <div class="wishlist"> <a class="addToWishlist wishlistProd_5" href="#"> الأمانى </a> </div>
                              <a class="quick-view" href="cart-data.html"> <span>نظرة سريعة</span> </a> </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
              @endforeach
            @else
              <h3 class="text-center">قائمه الاماني فارغة</h3>
            @endif

          </div>
        </ul>
</div>
      <div class="clear"></div>
    </div>
    <!-- ================ نهاية اليسار الصفحة ============= -->
     </div>
</div>
<!-- === نهاية محتوى الصفحة العمود الايمن والايسر ... ملحوظة ترتيب محتوى الصفحات مختلفة عن محتوى الصفحة الرئيسية ====== -->


@endsection


@push('scripts')
<script type="text/javascript">

$(document).ready(function(){
  $('#ordernow').on('click',function(e){
    e.preventDefault();
    $('#postorder').submit();
  });
});

</script>

@endpush
