
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
       <!-- ================ بداية يسار الصفحة ============= -->
       <div id="center_column" class="center_column col-xs-12 col-sm-9 col-md-9 col-lg-9">

         <div class="breadcrumbdiv">
           <div class="breadcrumb container clearfix">
             <div class="breadcrumbs">
             <a class="home" href="index.html"><i class="icon-home"></i></a>
             <span class="navigation-pipe">&gt;</span>سلة التسوق الخاصة بك</div>
           </div>
         </div>

         <h1 id="cart_title"><span class="heading-counter"><i class="fa fa-shopping-cart"></i> تحتوي سلة التسوق الخاصة بك على : <span id="summary_products_quantity"><span class="product_count">@if(auth()->user())
            {{count(auth()->user()->carts)}}
            @endif</span> منتجات</span> </span> </h1>

         <ul class="step clearfix" id="order_step">
           <li class="step_current  first"> <span> تفاصيل السلة</span> </li>
           <li class="step_todo second"> <span>تسجيل دخول</span> </li>
           <li class="step_todo third"> <span>عنوان الشحن</span> </li>
           <li class="step_todo four"> <span>طرق الشحن</span> </li>
           <li id="step_end" class="step_todo last"> <span>دفع</span> </li>
         </ul>

         <div id="order-detail-content" class="table_block table-responsive">
           <table id="cart_summary" class="table table-bordered stock-management-on">
             <thead>
               <tr>
                 <th class="cart_product first_item">صورة المنتج</th>
                 <th class="cart_description item">اسم المنتج</th>
                 <th class="cart_description item">البائع</th>
                 <th class="cart_avail item text-center">الحالة</th>
                 <th class="cart_unit item text-right">سعر المنتج</th>
                 <th class="cart_quantity item text-center">الكمية</th>
                 <th class="cart_delete last_item">حذف</th>
                 <th class="cart_total item text-right">المجموع الفرعى</th>
               </tr>
             </thead>
             <tbody>
               @if(auth()->user())
                @if(count(auth()->user()->carts)>0)
                  @php $totalprice=0; @endphp
                  @foreach(auth()->user()->carts as $cart)
                  <tr class="cart_item first_item" data-cartid="{{$cart->id}}" data-maxquantity="{{$cart->extoption_id!=''?$cart->extoption->quantity:$cart->product->quantity}}">
                                   <td class="cart_product">
                                     <a href="#"><img src="{{url('')}}/storage/images/products/{{$cart->product->image}}"/></a>
                                  </td>
                                   <td class="cart_description">
                                       <p class="product-name">
                                       <a href="{{url('')}}/products/{{$cart->product->getslug()}}">{{$cart->product->gettitle()}}</a>
                                       <small class="cart_ref">
                                       @if($cart->extoption_id!='')
                                          @foreach($cart->extoption->options as $option)
                                          <span class="label label-success">{{$option->getname()}}</span>
                                          @endforeach
                                       @endif</small>
                                       </p>
                                   </td>
                                   <td class="cart_description">
                                     <p class="product-name">
                                     <a href="cart-data.html">زيان</a>
                                     <small><a href="#">كايزن ديزاين</a></small>
                                     </p>
                                   </td>
                                   <td class="cart_avail"><span class="label label-success">متوفر</span></td>
                                   <td class="cart_unit" data-title="المجموع الفرعى">
                                     <ul class="text-center">
                                       <li class="price">{{$cart->extoption_id!=''?$cart->extoption->getprice():$cart->product->getprice()}}</li>
                                     </ul>
                                   </td>
                                   <td class="cart_quantity text-center" data-title="الكمية">
                                     <input size="2" type="text" autocomplete="off" class="cart_quantity_input form-control grey" value="{{$cart->quantity}}" name="" />
                                     <div class="cart_quantity_button clearfix">
                                     <a rel="nofollow" class="cart_quantity_down btn btn-default button-minus" href="#">
                                      <span><i class="icon-minus"></i></span>
                                     </a>
                                     <a rel="nofollow" class="cart_quantity_up btn btn-default button-plus" id="cart_quantity_up_17_105_0_0" href="#" title="Add">
                                     <span><i class="icon-plus"></i></span>
                                     </a>
                                     </div>
                                   </td>
                                   <td class="cart_delete text-center">
                                     <div> <a href="#"><i class="icon-trash deleteitem"></i></a>
                                     </div>
                                   </td>
                                   <td class="cart_total" data-title="المجموع الفرعى"><span class="price qprice">{{$cart->extoption_id!=''?$cart->extoption->price*$cart->quantity*getcurrency()->value.' '.getcurrency()->getabbreviation():$cart->product->price*$cart->quantity*getcurrency()->value.' '.getcurrency()->getabbreviation()}}</span></td>
                                   @php  $totalprice+=$cart->extoption_id!=''?$cart->extoption->price*$cart->quantity:$cart->product->price*$cart->quantity; @endphp
                   </tr>
                  @endforeach
                @else
                  <tr>
                    <td colspan="8">Your shopping cart is empty</td>
                  </tr>
                @endif
               @endif
             </tbody>
             <tfoot>
               <tr class="cart_total_price">
                 <td rowspan="4" colspan="3" id="cart_voucher" class="cart_voucher"></td>
                 <td colspan="3" class="text-center">مجموع المنتجات</td>
                 <td colspan="2" class="price" id="total_product">{{auth()->user() && count(auth()->user()->carts)>0?count(auth()->user()->carts):0}}</td>
               </tr>
               <!-- <tr>
               <td colspan="3" class="text-center"> نقاط المكافآت </td>
               <td colspan="2" class="price-discount price" id="total_wrapping">0.00 ل.س</td>
             </tr> -->
             <!-- <tr class="cart_total_delivery">
             <td colspan="3" class="text-center">إجمالى الشحن</td>
             <td colspan="2" class="price" id="total_shipping" >7.00 ل.س</td>
           </tr> -->
           <tr class="cart_total_price">
             <td colspan="3" class="total_price_container text-center"><span>المجموع الكلي</span>
               <div class="hookDisplayProductPriceBlock-price"> </div></td>
               <td colspan="2" class="price" id="total_price_container"><span id="total_price">{{isset($totalprice)?$totalprice*getcurrency()->value.' '.getcurrency()->getabbreviation():0}}</span></td>
             </tr>
           </tfoot>
           </table>
         </div>


         <p class="cart_navigation clearfix">
           <a  href="{{route('shippingaddress')}}" class="button btn btn-default standard-checkout button-medium checkout" > <span>مواصلة الطلب</span> </a>
           <a href="{{route('cart.index')}}" class="button-exclusive btn btn-default" title="Continue shopping">تحديث السلة</a>
          </p>
         <div class="clear"></div>
       </div>

       <!-- ================ نهاية يسار الصفحة ============= -->
        </div>
   </div>
    <!-- === نهاية محتوى الصفحة العمود الايمن والايسر ... ملحوظة ترتيب محتوى الصفحات مختلفة عن محتوى الصفحة الرئيسية ====== -->

@endsection


@push('scripts')
<script type="text/javascript">

//loading spinner
$(document)
.ajaxStart(function () {
  $('#loading').removeClass('hide');
})
.ajaxStop(function () {
  $('#loading').addClass('hide');
});


$(document).ready(function(){

@if(auth()->user() && count(auth()->user()->carts)==0)

  $('.checkout').hide();

@elseif(auth()->user() && count(auth()->user()->carts)>0)

  $('body').on('click','.button-plus',function(e){
    e.preventDefault();
    updatequantity('plus',this);
  });

  $('body').on('click','.button-minus',function(e){
    e.preventDefault();
    updatequantity('minus',this);
  });

  $('body').on('click','.deleteitem',function(e){
    e.preventDefault();
    var cartid=$(this).parent().parent().parent().parent().data('cartid');
    var self=this;
    $.ajax({
      url:`{{route('deletefromcart')}}`,
      method:'post',
      data:{cartid:cartid,_token:`{{csrf_token()}}`},
      success:function(data){
        $(self).parent().parent().parent().parent().remove();
        $('#total_price').html(data.totalprice);
        $('#total_product').html(data.count);
        if(data.count==0){
          $('.checkout').hide();
          $('tbody').html('');
          $('.product_count').html(0);
          $('tbody').append(`<tr><td colspan="8"> No Items</td></tr>`);
        }
      },
      error:function(){
        alert('something went wrong');
      }
    });
  });


///////////////////////////functions/////////////////////////////

function updatequantity(op,self){

  var cartid=$(self).parent().parent().parent().data('cartid');
  var maxquantity=$(self).parent().parent().parent().data('maxquantity');
  var newquantity;
  var quantityError=false;
  var canupdate=true;

  if(op=='plus'){
    newquantity=parseInt($(self).parent().parent().find('.cart_quantity_input').val())+1;
    if(newquantity>maxquantity){
      quantityError=true;
      alert('Insufficient quantity avaiable');
    }
  }else {
    newquantity=parseInt($(self).parent().parent().find('.cart_quantity_input').val())-1;
    if(newquantity<1){
       canupdate=false;
       alert('quantity must be at leat 1, or delete the product');
    }
  }

  if(canupdate==true && quantityError==false){
    $.ajax({
      url:`{{route('updatequantity')}}`,
      method:'post',
      data:{cartid:cartid,newquantity:newquantity,_token:`{{csrf_token()}}`},
      success:function(data){
        $(self).parent().parent().find('.cart_quantity_input').val(newquantity);
        $(self).parent().parent().parent().find('.qprice').html(data.qprice);
        $('#total_price').html(data.totalprice);
      },
      error:function(){
        alert('something went wrong');
      }
    });
  }

}
@endif

/////////////////////////////////////////////////guest cart////////////////////////////////////////////////////////

@if(auth()->guest())
// show loading spinner on page loading
$('#loading').removeClass('hide');

//load table content from cookies with ajax
guestcartpage();

//delete from cart table
$('body').on('click','.deleteitem',function(e){
    e.preventDefault();
    var productid=$(this).data('productid');
    var extoptionid=$(this).data('extoptionid');
    if (!!$.cookie('cart_data')) {
     // have cookie
     var cart=JSON.parse($.cookie('cart_data'));
     var newcart=[];
         $.each(cart,function(key,value){
           if(productid==value.product && value.extoption==extoptionid){
             //do nothing
           }else {
             newcart.push({product:value.product,extoption:value.extoption,quantity:value.quantity});
           }
          });
          // all elements has been deleted, we delete cookie
          if(newcart.length==0){
              $.removeCookie('cart_data', { path: '/' });
          }else {
            //setting cookie
            $.cookie('cart_data', JSON.stringify(newcart), { path: '/' });
          }
      }
    //call guestcartpage & guestcart function again to set all data with ajax
    guestcartpage();
});

//if any item got deleted from the small cart preview menu, we will update the table again with ajax
$('body').on('click','.remove_link',function(e){
      guestcartpage();
});


//updating quantity
$('body').on('click','.button-plus',function(e){
  e.preventDefault();
  var self=this;
  updatequantity('plus',self);
});

$('body').on('click','.button-minus',function(e){
  e.preventDefault();
  var self=this;
  updatequantity('minus',self);
});




////////////////////////////////////////////functions////////////////////////////////////////////

function guestcartpage(){


  $('tbody').html('');
  var price=0;
  var locale=`{{app()->getLocale()}}`;
  var options='';
  //get products stored in cookies if exists
  if (!!$.cookie('cart_data')) {
   // have cookie
   var getcart=JSON.parse($.cookie('cart_data'));
      $('#total_product').html(getcart.length);
      $('.product_count').html(getcart.length);
     $.each(getcart,function(key,value){
         $.ajax({
           url:`{{route('guestcart')}}`,
           method:'get',
           data:{product_id:value.product,extoption:value.extoption,quantity:value.quantity},
           success:function(data){
              //resetting options value for each loop
                options='';
               //get options if the product has variation
               $.each(data.options,function(k,v){
                 if(locale=='ar'){
                   options+=`<span class="label label-success">${v.name_ar}</span>`
                 }else {
                   options+=`<span class="label label-success">${v.name}</span>`;
                 }
               });

             //counting the total price
             price=price+parseInt(data.qprice);
             $('tbody').append(`<tr class="cart_item first_item" data-productid="${data.productid}" data-extoptionid="${data.extoptionid}" data-maxquantity="${data.maxquantity}" data-price="${data.price}">
                              <td class="cart_product">
                              <a href="#"><img src="{{url('')}}/storage/images/products/${data.image}"/></a>
                              </td>
                              <td class="cart_description">
                              <p class="product-name">
                              <a href="{{url('')}}/products/${data.slug}">${data.name}</a>
                              <small class="cart_ref">${options}</small>
                              </p>
                                </td>
                                <td class="cart_description">
                              <p class="product-name">
                              <a href="cart-data.html">زيان</a>
                              <small><a href="#">كايزن ديزاين</a></small>
                              </p>
                                </td>
                              <td class="cart_avail"><span class="label label-success">متوفر</span></td>
                              <td class="cart_unit" data-title="المجموع الفرعى">
                              <ul class="text-center">
                                  <li class="price">${data.price}</li>
                                </ul>
                                </td>
                              <td class="cart_quantity text-center" data-title="الكمية">
                                <input size="2" type="text" autocomplete="off" class="cart_quantity_input form-control grey" value="${data.quantity}"  name="" />
                                <div class="cart_quantity_button clearfix">
                                <a rel="nofollow" class="cart_quantity_down btn btn-default button-minus" href="#">
                                 <span><i class="icon-minus"></i></span>
                                </a>
                                <a rel="nofollow" class="cart_quantity_up btn btn-default button-plus" id="cart_quantity_up_17_105_0_0" href="#" title="Add">
                                <span><i class="icon-plus"></i></span>
                                </a>
                                </div>
                              </td>
                              <td class="cart_delete text-center">
                              <div> <a href="#"><i class="icon-trash deleteitem" data-productid="${data.productid}" data-extoptionid="${data.extoptionid}"></i></a>
                              </div>
                              </td>
                              <td class="cart_total" data-title="المجموع الفرعى"><span class="price qprice">${data.qprice}</span></td>
                            </tr>`);
                            var abbreviation=`{{getcurrency()->getabbreviation()}}`;
                            $('#total_price').html(price+' '+abbreviation);
                      }
                  });
           });
     //no cookies stored
    }else {
      $('tbody').append(`<tr><td colspan="8"> No Items</td></tr>`);
      $('#total_product').html(0);
      $('#total_price').html(0);
      $('.checkout').hide();
    }//endif
}


function updatequantity(operation,self){
  var productid=$(self).parent().parent().parent().data('productid');
  var extoptionid=$(self).parent().parent().parent().data('extoptionid');
  var maxquantity=$(self).parent().parent().parent().data('maxquantity');
  var price=$(self).parent().parent().parent().data('price');

  var cart=[];

  if (!!$.cookie('cart_data')) {
   // have cookie
   cart=JSON.parse($.cookie('cart_data'));
   var newcart=[];
   var newquantity=0;
   var canupdate=true;
       $.each(cart,function(key,value){

         //if the new item that's added to cart has the same variation and id as a one already in the cart we add the new quantity to the old
         if(productid==value.product && value.extoption==extoptionid){
           if(operation=='plus'){
             newquantity=parseInt(value.quantity)+1;
           }else{
             newquantity=parseInt(value.quantity)-1;
           }

           //if total quantity greater than the quantity avaiable
           if(newquantity>maxquantity){
             newquantity=maxquantity;
             canupdate=false;
             alert('Insufficient quantity');
           }

           if(newquantity<1){
              canupdate=false;
              newquantity=1;
           }
           newcart.push({product:value.product,extoption:value.extoption,quantity:newquantity});
         }else {
           newcart.push({product:value.product,extoption:value.extoption,quantity:value.quantity});
         }
        });

     if(canupdate==true){
       //setting cookie
       $.cookie('cart_data', JSON.stringify(newcart), { path: '/' });
       $(self).parent().parent().find('.cart_quantity_input').val(newquantity);
       $(self).parent().parent().parent().find('.qprice').html(newquantity*price);
       guestcartpage();
    }
    }
}
@endif

});
</script>

@endpush
