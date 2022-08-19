<li class="item col-xs-12 col-sm-4 col-md-4 col-lg-3">
  <div class="product-container" >
    <div class="left-block">
      <div class="product-image-container"> <a class="product_img_link" href="{{route('show.product',$product->getslug())}}"> <img class="replace-2x img-responsive" src="{{url('storage/images/products/'.$product->image)}}" /> </a> <a class="sale-box" href="#">
         <!-- <span class="sale-label"> خصم 5% </span>  -->
       </a> @if($product->isnew())<a class="new-box" href="#"> <span class="new-label">جديد</span> </a>@endif
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

                    <div class="star star_hover"><a title="0">0</a></div>
                    <div class="star star_hover"><a title="1">1</a></div>
                    <div class="star star_hover"><a title="2">2</a></div>
                    <div class="star star_hover"><a title="3">3</a></div>
                    <div class="star star_hover"><a title="3">4</a></div>

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
             @include('site.includes.producticons')
          </div>
        </div>
      </div>
    </div>
  </div>
</li>
