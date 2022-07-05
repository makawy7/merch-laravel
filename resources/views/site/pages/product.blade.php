
@extends('site.layouts.layout2')

@section('content')

  <!-- <div id="loading" class="hide"><img src='{{url("des/site/animated_spinner.gif")}}' width="50" height="50" /></div> -->
  <!-- === بداية محتوى الصفحة العمود الايمن والايسر ... ملحوظة ترتيب محتوى الصفحات مختلفة عن محتوى الصفحة الرئيسية ====== -->
    <div id="columns" class="container">
      <div class="row" id="columns_inner">
      <!-- ================ بداية يمين الصفحة ============= -->
        <div id="left_column" class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
          @include('site.includes.menu')
          @include('site.includes.myaccount')
        </div>
        <!-- ================ نهاية يمين الصفحة ============= -->
        <!-- ================ بداية يسار الصفحة ============= -->
        <div id="center_column" class="center_column col-xs-12 col-sm-9 col-md-9 col-lg-9">
        <div class="breadcrumbdiv">
		<div class="breadcrumb container clearfix">
		<div class="breadcrumbs">
			<a class="home" href="{{route('index')}}"><i class="icon-home"></i></a>
							<span class="navigation-pipe">&gt;</span>
									<span class="navigation_page">
                                    <span itemscope itemtype="#">
                                    <a><span>{{$product->type->subcat->maincat->getName()}}</span></a>
                                    </span>
                                    <span class="navigation-pipe">></span>
                                    <span>
                                    <a ><span>{{$product->type->subcat->getName()}}</span></a>
                                    </span>
                                    <span class="navigation-pipe">></span>
                                    <span><a ><span>{{$product->type->getName()}}</span></a></span>
                                    </span>
									</div>
			</div>
			</div>
          <div class="primary_block row">
            <div class="pb-left-column col-xs-12 col-sm-6 col-md-6">

              <!--هنا يوضع صوره رئيسية مش موجوده فى الصور الصغيره بمعنى انك ممكن تحط اعلان فى الأول منفصل عن الصور خالص-->
              <div id="image-block" class="clearfix"> <span id="view_full_size"> <a class="jqzoom" rel="gal1" href="{{url('storage/images/products/'.$product->image)}}"> <img itemprop="image" src="{{url('storage/images/products/'.$product->image)}}" /> </a> </span> </div>
              <div id="views_block" class="clearfix "> <a id="view_scroll_left" class="" href="javascript:{}"> </a>
                <!--اخره هنا-->
                <div id="thumbs_list">
                  <ul id="thumbs_list_frame">
                    @php $counter=207; @endphp
                    @foreach($product->getimages() as $image)
                    <!--تغيير اول صوره-->
                    <li id="thumbnail_{{$counter}}"> <a href="javascript:void(0);" rel="{gallery: 'gal1', smallimage: '{{url('storage/images/products/'.$image)}}',largeimage: '{{url('storage/images/products/'.$image)}}'}"> <img class="img-responsive" id="thumb_207" src="{{url('storage/images/products/'.$image)}}"  /> </a> </li>
                    <!--اخره هنا-->
                    @php $counter++; @endphp
                    @endforeach

                  </ul>
                </div>
                <a id="view_scroll_right" title="Other views" href="javascript:{}"> </a> </div>
            </div>
            <div class="pb-center-column col-xs-12 col-sm-6 col-md-6">

              <h1><div class="star_content float-left">
                                  @if($product->getratings()>0)
                                    @for($i=0;$i<$product->getratings();$i++)
                                      <div class="star"><a title="{{$i}}">{{$i}}</a></div>
                                    @endfor
                                  @else
                                  <div class="star_content clearfix">
                                      <div class="star star_hover"><a title="0">0</a></div>
                                      <div class="star star_hover"><a title="1">1</a></div>
                                      <div class="star star_hover"><a title="2">2</a></div>
                                      <div class="star star_hover"><a title="3">3</a></div>
                                      <div class="star star_hover"><a title="3">4</a></div>

                                  </div>
                                  @endif
                                  </div>{{$product->gettitle()}}</h1>
              <div id="short_description_block">
                <div id="short_description_content">
                {!! $product->getshortdes() !!}
                </div>
              </div>
              <p>
              <span id="availability_date_label">إسم التاجر :</span>
              <b>{{$product->isadminstore()?setting()->name:$product->store->user->name}}</b>
              </p>
              <span id="availability_date_label">المتجر :</span>
              <b><a href="{{route('store',$product->store_id)}}">{{$product->isadminstore()?setting()->name:$product->store->getname()}}</a></b>
              </p>
              @if(reward()->product)
              <p>
              <span id="availability_date_label">نقاط المكافآت :</span>
              <b>{{$product->reward_points}}</b>
              </p>
              @endif

              <p id="availability_statut">
                  <span id="availability_value" class="label label-success">فى المخزن</span>
              </p>


              @if($product->quantity)
              <p id="pQuantityAvailable">
                  <span id="quantityAvailable">{{$product->quantity}}</span>
                  <span id="quantityAvailableTxtMultiple">عنصر</span>
              </p>
              @else
                <p id="pQuantityAvailable">
                  <span id="quantityAvailable">Unavaliable</span>
                  <span id="quantityAvailableTxtMultiple"></span>
                </p>
              @endif

            </div>

            <div class="pb-right-column col-xs-12 col-sm-6 col-md-6">
              <form id="buy_block" action="#" method="post">
                  <div class="box-info-product">
                    <div class="product_attributes clearfix">
                    <p id="quantity_wanted_p">
                        <label for="quantity_wanted">الكمية :</label>
                        <input type="text" min="1" name="qty" id="quantity_wanted" class="text" value="1" />
                        <a href="#" data-field-qty="qty" class="btn btn-default button-minus product_quantity_down">
                         <span><i class="icon-minus"></i> </span>
                         </a>
                          <a href="#" data-field-qty="qty" class="btn btn-default button-plus product_quantity_up">
                           <span><i class="icon-plus"></i></span>
                           </a>

                           <span class="clearfix"></span>
                            </p>

                    <div id="attributes">
                        <div class="clearfix"></div>
                        @if(count($product->variations)>0)
                          @foreach($product->variations as $variation)
                              <fieldset class="attribute_fieldset col-xs-12 col-sm-6 col-md-6 padding-right">
                                    <label class="attribute_label" >{{$variation->getName()}} &nbsp;</label>
                                    <div class="attribute_list  form-group col-xs-12 col-sm-8 col-md-8">
                                      <select name="group_1" id="group_2" class="form-control variation">
                                        @if(count($variation->options)>0)
                                          @foreach($variation->options as $option)
                                            <option value="{{$option->id}}" title="{{$option->getName()}}">{{$option->getName()}}</option>
                                          @endforeach
                                        @else
                                            <option value="0" title=""></option>
                                        @endif
                                      </select>
                                    </div>
                              </fieldset>
                          @endforeach
                        @endif
                    </div>
                <div class="content_prices clearfix">
  							<div>
  								<p class="our_price_display">
                                  <label for="quantity_wanted">السعر :</label>
                                  <span id="our_price_display" class="price">{{$product->price?$product->getprice():'Unavaliable'}}</span>
                                  </p>
  								<!-- <p id="reduction_percent" style="display: block;">
                                  <span id="reduction_percent_display">-5%</span>
                                  </p>
  								<p id="old_price" style="display: block;">
                                  <span id="old_price_display" style="display: inline;">
                                  <span class="price">70.00 ل.س</span>
                                  </span>
                                  </p> -->
  															</div>
  						<div class="clear"></div>
  					</div>



                    </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                      <div class="text-center">
                        <div>
                          <p>
                          <div  class="btn-info btn-lg"> <span><a href="checkout.html" data-hasvariation={{!isset($product->price) && !isset($product->quantity)?1:0}} data-extoptionid="" data-maxquantity="{{$product->quantity?$product->quantity:''}}" class="addtocart">اضف الى السلة <i class="fa fa-shopping-cart"></i> </a></span> </div>
                          </p>
                        </div>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                      <div class="text-center">
                        <div>
                          <p>
                          <div  class="btn-info btn-lg">
                            <span>
                              <a href="#" id="addtowish" onclick="WishlistCart('wishlist_block_list', 'add', '5', $('#idCombination').val(), document.getElementById('quantity_wanted').value); return false;" rel="nofollow">أعجبنى <i class="fa fa-heart-o"></i>
                              </a>
                           </span> </div>
                          </p>
                        </div>
                      </div>
                    </div>
                    </form>
            </div>
          </div>
          <section id="tm-tabcontent" class="tm-tabcontent">
            <ul id="productpage_tab" class="nav nav-tabs clearfix">
              <li class="active"><a data-toggle="tab" href="#tmmoreinfo" class="tmmoreinfo">معلومات</a></li>
              <li><a data-toggle="tab" href="#idTab5" class="tmreview">التعليقات</a></li>
            </ul>
            <div class="tab-content">
              <ul id="tmmoreinfo" class="tm_productinner tab-pane active">
                <li>
                  <p><strong>هنا يوضع عنوان المنتج</strong></p>
                  <p>{!!$product->getdes()!!}</p>
                </li>
              </ul>

              <!--HOOK_PRODUCT_TAB -->
              <ul id="idTab5" class="tm_productinner tab-pane">
                <li>
                  <div>
                    <div id="new_comment_form">
                      <form id="id_new_comment_form" action="#">
                        <h2 class="page-subheading"> أكتب تعليقك</h2>
                        <div class="row">
                          <div class="product clearfix  col-xs-12 col-sm-6"> <img src="{{url('des/site')}}/images/cartdata2-2.jpg" />
                            <div class="product_desc">
                              <p class="product_name"> <strong>{{$product->gettitle()}}</strong> </p>
                              <p><span>{!!$product->getdes()!!}</span></p>
                            </div>
                          </div>
                          <div class="new_comment_form_content col-xs-12 col-sm-6" id="commentsection">
                            @foreach($product->comments as $comment)
                              @if($comment->user)
                              <div class="new_comment_form_content">
                                <!-- <label for="">اسم العضو:</label> -->
                                <ul id="criterions_list">
                                  <li>
                                    <label>{{$comment->user->name}} <span style="color:red">{{$comment->user->verifiedpurchase($product->id)?'Verified Purchase':''}}</span> </label>
                                    <div class="star_content">
                                      @for($i=0;$i<$comment->user->getrating($product->id);$i++)
                                        <input class="star not_uniform" type="radio" name="criterion[1]" value="{{$i}}" />
                                      @endfor
                                    </div>
                                    <div class="clearfix"></div>
                                  </li>
                                </ul>

                                <div class="block thumbnail">
                                  {{$comment->title}}
                                </div>
                                <div class="block">
                                    {{$comment->body}}
                                    <br>
                                    @if($comment->image)
                                      <img style="width:130px" src="{{url('storage/images/comments/'.$comment->image)}}">
                                    @endif
                                </div>
                                @if(auth()->user() && (auth()->user()->id==$comment->user->id || auth()->user()->admin()))
                                  <a type="button" href="{{route('deletecomment',$comment->id)}}" class="btn-info btn button button-small" name="button">حذف</a>
                                @endif
                              </div>
                              @endif
                            @endforeach

                            @if(auth()->user())

                            <span id="ratinglabel">التقييم</span>
                            <span class="rating">
                              <label>
                                <input type="radio" class="rating" name="stars" value="1" />
                                <span class="icon">★</span>
                              </label>
                              <label>
                                <input type="radio" class="rating" name="stars" value="2" />
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                              </label>
                              <label>
                                <input type="radio" class="rating" name="stars" value="3" />
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                              </label>
                              <label>
                                <input type="radio" class="rating" name="stars" value="4" />
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                              </label>
                              <label>
                                <input type="radio" class="rating" name="stars" value="5" />
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                              </label>
                            </span>
                            <label for="comment_title"> عنوان : <sup class="required">*</sup> </label>
                            <input id="comment_title" name="title" type="text" value=""/>
                            <label for="content"> تعليق : <sup class="required">*</sup> </label>
                            <textarea id="content" class="comment_body" name="content"></textarea>
                            <div id="new_comment_form_footer">
                              <input id="id_product_comment_send" name="id_product" type="hidden" value='5' />

                              <p class="fr">
                                <button id="submitNewMessage" name="submitMessage" type="submit" class="btn-info btn button button-small"> <span>إرسال</span> </button>
                                &nbsp;
                                <input type="hidden" class="hiddenimage" name="" value="">
                                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 padding-right padding-left">
                                  <div class="uploader" id="uniform-fileUpload"><input name="fileUpload" accept="image/x-png,image/gif,image/jpeg" id="fileUpload" class="form-control uploadimage" type="file">
                                    <span class=" btn btn-sm btn-default"><i class="fa fa-paperclip"></i> أرفق ملفات</span>
                                  </div>
                                </div>
                               <!-- <button id="submitNewMessage" name="submitMessage" type="reset" class="btn-info btn button button-small"> <span>حذف</span> </button> -->
                              <div class="clearfix"></div>
                            </div>
                            @endif
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </section>
           </div>
           <!-- ================ نهاية يسار الصفحة ============= -->
      </div>
    </div>

   <!-- ==== نهاية محتوى الصفحة العمود الايمن والايسر ... ملحوظة ترتيب محتوى الصفحات مختلفة عن محتوى الصفحة الرئيسية === -->

@endsection
@push('scripts')

<script type="text/javascript">



$(document).ready(function(){


//////////////////////////////////////////ADD TO WISHLIST///////////////////////////////

$('#addtowish').on('click',function(e){
  e.preventDefault();
  @if(auth()->user())
    $.ajax({
      url:`{{route('addtowishlist')}}`,
      method:'post',
      data:{product:`{{$product->id}}`,_token:`{{csrf_token()}}`},
      success:function(data){
        alert('added to wishlist');
      },
      error:function(){
        alert('something went wrong!');
      }
    });
  @else
    window.location.href=`{{route('login')}}`;
  @endif
});

////////////////////////////////////////////////////BASE64 IMAGES//////////////////////////////////////////

function getBase64(file) {
  return new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => resolve(reader.result);
    reader.onerror = error => reject(error);
  });
}

$('.uploadimage').on('change',function(){
  var image=$(this).get(0).files[0];
  getBase64(image).then(
      data=>$('.hiddenimage').val(data)
    );
});

//////////////////////////////////////////ADD NEW COMMENT///////////////////////////////

@if(auth()->user())

$('body').on('click','#submitNewMessage',function(e){
  e.preventDefault();
  var title=$('#comment_title').val();
  var body=$('.comment_body').val();
  var score=$('.rating:checked').val();
  var image=$('.hiddenimage').val();
  var titleError=false;
  var bodyError=false;
  var scoreError=false;
  if(title==''){
    titleError=true;
    alert('please enter comment title');
  }
  if(body==''){
    bodyError=true;
    alert('please enter the comment');
  }
  if($('.rating:checked').length==0){
    scoreError=true;
    alert('please rate the product');
  }

  if(titleError==false && bodyError==false && scoreError==false){
    $.ajax({
      url:`{{route('addcomment')}}`,
      method:'post',
      data:{product:`{{$product->id}}`,title:title,body:body,score:score,image:image,_token:`{{csrf_token()}}`},
      success:function(data){
        console.log(data);
        var stars='';
        for(var i=0;i<parseInt(data.rating);i++){
            stars+=`<div class="star"><a title="${i}">${i}</a></div>`;
        }

        var imageprev='';
        if(data.comment.image!=null){
          imageprev=`<img style="width:130px" src="{{url('storage/images/comments')}}/${data.comment.image}">`;
        }
        $('#commentsection').prepend(`
          <div class="new_comment_form_content">
            <!-- <label for="">اسم العضو:</label> -->
            <ul id="criterions_list">
              <li>
                <label>${data.comment.name}</label>
                <div class="star_content">
                  ${stars}
                </div>
                <div class="clearfix"></div>
              </li>
            </ul>

            <div class="block thumbnail">
              ${data.comment.title}
            </div>
            <div class="block">
              ${data.comment.body}
              <br>
              ${imageprev}
            </div>
          </div>`);
      },
      error:function(){
        alert('something went wrong');
      }
    });
  }

});

@endif
//////////////////////////////////////////GETTING VARIATIONS DATA//////////////////////
var ids='';
@if(count($product->variations)>0)
//on page load
getData();
@endif

//on variation change
$('body').on('change','.variation',function(){
  getData();
});

function getData(){
  $('.variation option:selected').each(function(){
    ids+=$(this).val()+',';
  });
  $.ajax({
    url:`{{route('get.extoptions')}}`,
    method:'get',
    data:{product_id:`{{$product->id}}`,ids:ids},
    success:function(data){
      $('#pQuantityAvailable').html('');
      if(!$.isEmptyObject(data)){
        $('#pQuantityAvailable').html(`
          <p id="pQuantityAvailable">
            <span id="quantityAvailable">${data.quantity}</span>
            <span id="quantityAvailableTxtMultiple">عنصر</span>
          </p>`);
          $('#our_price_display').html('');
          $('#our_price_display').html(data.price);
          if(data.image!=null){
            $('#image-block').find('img').attr('src',`{{url('storage/images/products')}}/${data.image}`);
            $('#image-block').find('a').attr('href',`{{url('storage/images/products')}}/${data.image}`);
          }
          $('.addtocart').data('extoptionid',data.id);
          $('.addtocart').data('maxquantity',data.quantity);
      }else {
        $('#pQuantityAvailable').html(`
          <p id="pQuantityAvailable">
            <span id="quantityAvailable">Unavaliable</span>
            <span id="quantityAvailableTxtMultiple"></span>
          </p>`);
        $('#our_price_display').html('Unavaliable');
        $('.addtocart').data('extoptionid','');
        $('.addtocart').data('maxquantity','');
      }
    },
    error:function(){
      alert('something went wrong');
    }
  });
  ids='';
}



//////////////////////////////ADD TO CART (USER)//////////////////////////////////////////////////


@if(auth()->user())


$('.addtocart').on('click',function(e){

e.preventDefault();
var quantity=parseInt($('#quantity_wanted').val());
var extoptionid=$(this).data('extoptionid');
var maxquantity=$(this).data('maxquantity');
var hasvariation=$(this).data('hasvariation');
var productid=`{{$product->id}}`;
var unavaliableError=false;
var quantityError=false;

if(extoptionid=='' && hasvariation==1){
    alert('Unavaliable');
    unavaliableError=true;
}else {
  if(quantity>maxquantity){
    alert('Insufficient quantity avaiable in store!');
    quantityError=true;
  }
}

if(unavaliableError==false && quantityError==false){
    $.ajax({
      url:`{{route('addtocart')}}`,
      method:'post',
      data:{productid:productid,extoptionid:extoptionid,quantity:quantity,_token:`{{csrf_token()}}`},
      success:function(data){
        //if the user clicked addtocart many times and he already have some quantity of the same product, if he excceed the max quantity this happen:
        if(data.quantityerror==1){
          alert('Insufficient qauntity avaiable!');
        }else {
          $('.products').html('');
          $.each(data.data,function(key,val){
            $('.products').append(`<dt data-id="cart_block_product_3_13_0" class="last_item"> <a class="cart-images" href="#"><img src="{{url('')}}/storage/images/products/${val.image}"/></a>
                 <div class="cart-info">
                   <div class="product-name"> <span class="quantity-formated">
                   </span> <a class="cart_block_product_name" href="{{url('')}}/products/${val.slug}">${val.name}</a> </div>
                   <small>${val.options}</small>
                   <div class="quantity"> الكمية : ${val.quantity}</div>
                   <span>${val.qprice}</span>
                  </div>
                <span class="remove_link" data-cartid=${val.cartid}><a  href="#"> </a></span>
              </dt>`);
          });
          $('.totalprice').html(data.totalprice);
          $('.totalprice2').html(data.totalprice);
          $('.ajax_cart_quantity').html(data.count);
        }
      },
      error:function(){
        alert('something went wrong');
      }
    });
}

});





@endif

//////////////////////////////ADD TO CART (GUEST)//////////////////////////////////////////////////


@if(auth()->guest())

//add to cart button
$('.addtocart').on('click',function(e){
  e.preventDefault();
  var unavaliableError=false;
  var quantityError=false;


  //if a user is logged in, no need to make cookies for order

  //get quantity, extoption id if exists
  var quantity=parseInt($('#quantity_wanted').val());
  var extoptionid=$(this).data('extoptionid');
  var maxquantity=$(this).data('maxquantity');
  var hasvariation=$(this).data('hasvariation');

  if(extoptionid=='' && hasvariation==1){
    alert('Unavaliable');
    unavaliableError=true;
  }else {
    if(quantity>maxquantity){
      alert('Insufficient quantity avaiable in store!');
      quantityError=true;
    }
  }

  if(unavaliableError==false && quantityError==false) {
    var cart=[];
    var data={product:{{$product->id}},extoption:extoptionid,quantity:quantity};
    var product_id={{$product->id}};
    if (!!$.cookie('cart_data')) {
     // have cookie
     cart=JSON.parse($.cookie('cart_data'));
     var newcart=[];
     var newquantity;
     var match=false;
         $.each(cart,function(key,value){
           //if the new item that's added to cart has the same variation and id as a one already in the cart we add the new quantity to the old
           if(product_id==value.product && value.extoption==extoptionid){
             newquantity=parseInt(quantity)+parseInt(value.quantity);

             //if total quantity greater than the quantity avaiable
             if(newquantity>maxquantity){
               newquantity=maxquantity;
               alert('Insufficient quantity, max of '+newquantity+' added to cart');
             }

             newcart.push({product:value.product,extoption:value.extoption,quantity:newquantity});
             newquantity=0;
             match=true;
           }else {
             newcart.push({product:value.product,extoption:value.extoption,quantity:value.quantity});
           }
          });
       //the item is completely new
       if(match==false){
         newcart.push(data);
       }
       //setting cookie
       $.cookie('cart_data', JSON.stringify(newcart), { path: '/' });

      } else {
       //there was no cookie at all.
       cart.push(data);
       $.cookie('cart_data', JSON.stringify(cart), { path: '/' });
      }
      alert('added to cart');
      //add it to cart view from cookie
      guestcart();
    }

  // var newdata = JSON.parse($.cookie('cart_data'));
  // console.log(newdata);

});
@endif





}).ajaxStart(function () {
    $('#loading').removeClass('hide');
  })
  .ajaxStop(function () {
    $('#loading').addClass('hide');
  });

</script>

@endpush
