<!-- ================ بداية  المنتجات المقترحة ============= -->
<div class="columns-container">
  <div class="container">
    <div id="tmcategoryslider3" class="block products_block clearfix">
      <ul id="tmcategory-tabs3" class="nav nav-tabs clearfix">
        <li class="first_item active"> <a href="#tab_5" data-toggle="tab">المنتجات المقترحة</a> </li>
      </ul>
      <div class="tab-content">
        <div id="tab_5" class="tab_content tab-pane">
          <div class="block_content row">
            <ul id="tm_5" class="tm-carousel product_list">
              @if(function_exists('mostviewed') && count(mostviewed())>0)
                @foreach(mostviewed() as $product)
                  @include('site.includes.productelement')
                @endforeach
              @endif
            </ul>
          </div>
          <div class="customNavigation"> <a class="btn prev tmcategory_prev"></a> <a class="btn next tmcategory_next"></a> </div>
          <script>
          $(document).ready(function() {
            var owl3 = $("#tm_5");
            owl3.owlCarousel({
              items : 5, //10 items above 1000px browser width
              itemsDesktop : [1200,4],
              itemsDesktopSmall : [991,3],
              itemsTablet: [767,2],
              itemsMobile : [480,1]
            });
            $("#tab_5 .tmcategory_next").click(function(){
              owl3.trigger('owl.next');
            })
            $("#tab_5 .tmcategory_prev").click(function(){
              owl3.trigger('owl.prev');
            })
          });
      </script>
        </div>
      </div>
    </div>
    <script type="text/javascript">
$(document).ready(function() {
  $('#tmcategory-tabs3 li:first, #tmcategoryslider3 .tab-content div:first').addClass('active');
});
</script>
  </div>
</div>
<!-- ================ نهاية  المنتجات المقترحة ============= -->
<!-- ================ بداية  footer ============= -->
<div class="footer-container">
  <footer id="footer"  class="container">
    <div class="row">
    <div class="footer-block col-xs-12 col-sm-3 col-md-3 col-lg-3" id="tm_links_block1_footer">
        <h4 class="title_block">حول المتجر</h4>
        <ul class="block_content toggle-footer">
          <li>
            <div class="tm_contactinfo"><b><i class="fa fa-map-marker"></i>&nbsp;العنـوان : </b> 7 شارع ايوب متفرع من الهرم - الجيزة</div>
          </li>
          <li><b><i class="fa fa-phone-square"></i>&nbsp;تليفـون :</b> <span>0020235824529</span></li>
          <li><b><i class="fa fa fa-envelope"></i>&nbsp;إيميل :</b> <span>zayan@kaizendesign.net</span></li>
        </ul>
      </div>
      <div class="footer-block col-xs-12 col-sm-3 col-md-2 col-lg-2" id="tm_links_block1_footer">
        <h4 class="title_block"> المعلومات</h4>
        <div class="block_content toggle-footer">
          <ul class="bullet">
              <li><a href="{{route('terms')}}">شروط وأحكام</a></li>
              <li><a href="{{route('returnpolicy')}}">سياسة الإسترجاع</a></li>
              <li><a href="{{route('privacypolicy')}}">سياسة الخصوصية</a></li>
              <li><a href="{{route('contactus')}}">إتصل بنا</a></li>
          </ul>
        </div>
      </div>
      <div class="footer-block col-xs-12 col-sm-3 col-md-2 col-lg-2" id="tm_links_block1_footer">
        <h4 class="title_block"> الرئيسية </h4>
        <div class="block_content toggle-footer">
          <ul class="bullet">
            <li> <a href="{{route('newlylisted')}}">أحدث المنتجات</a> </li>
            <li><a href="{{route('bestselling')}}">الأكثر مبيعا</a></li>
            <li><a href="{{route('wishlist')}}">المفضلة</a></li>
          </ul>
        </div>
      </div>
      @if(auth()->user())
        <div class="footer-block col-xs-12 col-sm-3 col-md-2 col-lg-2" id="tm_links_block1_footer">
          <h4 class="title_block"> حسابى </h4>
          <div class="block_content toggle-footer">
            <ul class="bullet">
              <li> <a href="{{route('myorders')}}">طلباتى</a> </li>
              <li> <a href="{{route('cart.index')}}">سلة المشتريات</a> </li>
              <li> <a href="{{route('addresses')}}">عناوينى</a> </li>
              <li> <a href="{{route('myaccount')}}">حسابى</a> </li>
            </ul>
          </div>
        </div>
      @endif
      <div class="footer-block col-xs-12 col-sm-3 col-md-3 col-lg-3" id="tm_links_block1_footer">
        <h4 class="title_block"> راسلنا </h4>
        <div class="block_content toggle-footer">
          <form action="{{route('contact_us')}}" method="post" class="contact-form-box">
            @csrf
            <input class="form-control" type="text" name="title" placeholder="عنوان الرسالة">
            <textarea class="form-control" rows="4" name="body" placeholder="الرسالة"></textarea>
            <button type="submit"class="button btn btn-info">ارسال <i class="fa fa-sign-in"></i></button>
          </form>
        </div>
      </div>
      <div class="tm_foooterdiv">
        <div class="col-xs-12 col-sm-6 col-md-64 col-lg-6">
          <h6 class="text-center"> تصميم وبرمجة شركة<a class="_blank" href="http://kaizendesign.net/"> كايزن ديزاين </a>© 2019 </h6>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-64 col-lg-6">
          <div id="paiement_logo_block_left" class="paiement_logo_block"> <a href="#"><img src="{{url('des/site')}}/images/master-card.jpg"></a> <a href="#"><img src="{{url('des/site')}}/images/visa.jpg"></a> <a href="#"><img src="{{url('des/site')}}/images/k.jpg"></a> </div>
        </div>
      </div>
    </div>
  </footer>
</div>
<!-- ================ نهاية  footer ============= -->
</div>
<a class="top_button" href="#" style="display:none;">&nbsp;</a>
<script src="{{url('des/site')}}/js/classie.js"></script>
<script src="{{url('des/site')}}/js/modalEffects.js"></script>
<script src="{{url('des/site')}}/js/cssParser.js"></script>
<script src="{{url('des/site')}}/js/modernizr.custom.js"></script>


@stack('scripts')

<script type="text/javascript">

//REGISTRATION
$(document).ready(function(){

///////////////////////////////REGISTRATION FORM///////////////////////////////////

  //setting old selections from old()
   @if(old('country'))
     var cat={{old('country')}};
     $('#cityinput').html('');
     $('#cityinput').append($(`#c_${cat}`).html());
   @else
     var id=$('#countryinput').val();
     $('#cityinput').html('');
     $('#cityinput').append($(`#c_${id}`).html());
     $('#cityinput option:selected').removeAttr("selected");
   @endif
  //end setting old selections

  $('#countryinput').on('change',()=>{
    var id=$('#countryinput').val();
    $('#cityinput').html('');
    $('#cityinput').append($(`#c_${id}`).html());
    $('#cityinput option:selected').removeAttr("selected");
  });

  $('#birthdayerror').hide();
  $('#nameerror').hide();
  $('#emailerror').hide();
  $('#passerror').hide();
  $('#passcerror').hide();
  $('#phoneerror').hide();

  $('#register').on('click',function(e){
    e.preventDefault();

    var birthday=$('#registerform').find('input[name="birthday"]').val();
    var name=$('#registerform').find('input[name="name"]').val();
    var email=$('#registerform').find('input[name="email"]').val();
    var password=$('#registerform').find('input[name="password"]').val();
    var passwordc=$('#registerform').find('input[name="password_confirmation"]').val();
    var phone=$('#registerform').find('input[name="phone"]').val();
    var birthdayError=false;
    var nameError=false;
    var emailError=false;
    var passwordError=false;
    var passwordcError=false;
    var phoneError=false;


    if(birthday==''){
        $('#birthdayerror').show();
        birthdayError=true;
    }else {
      $('#birthdayerror').hide();
      birthdayError=false;
    }

    if(name==''){
        $('#nameerror').show();
        nameError=true;
    }else {
      $('#nameerror').hide();
      nameError=false;
    }

    if(email==''){
        $('#emailerror').show();
        emailError=true;
    }else {
      $('#emailerror').hide();
      emailError=false;
    }

    if(password==''){
        $('#passerror').show();
        passwordError=true;
    }else {
      $('#passerror').hide();
      passwordError=false;
    }

    if(passwordc==''){
        $('#passcerror').show();
        passwordcError=true;
    }else {
      $('#passcerror').hide();
      passwordcError=false;
    }

    if(phone==''){
        $('#phoneerror').show();
        phoneError=true;
    }else {
      $('#phoneerror').hide();
      phoneError=false;
    }

    if(birthdayError==false && nameError==false && emailError==false && passwordError==false && passwordcError==false && phoneError==false){
      $('#registerform').submit();
    }
  });
});




//////////////////////////////USER CART//////////////////////////////////////////

@if(auth()->user())

$('body').on('click','.remove_link',function(e){
  e.preventDefault();
  var cartid=$(this).data('cartid');
  var self=this;
  $.ajax({
    url:`{{route('deletefromcart')}}`,
    method:'post',
    data:{cartid:cartid,_token:`{{csrf_token()}}`},
    success:function(data){
      $(self).parent().remove();
      $('.totalprice').html(data.totalprice);
      $('.totalprice2').html(data.totalprice);
      $('.ajax_cart_quantity').html(data.count);
    },
    error:function(){
      alert('something went wrong');
    }
  });
});
@endif






/////////////////////////////////GUEST CART//////////////////////////////////////////




//get guest cart data from cookies
@if(auth()->guest())
guestcart();


//delete from cart
$('body').on('click','.remove_link',function(e){

    e.preventDefault();
    var productid=$(this).data('productid');
    var extoptionid=$(this).data('extoptionid');
    $(this).parent().remove();
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
      }else {
        $('.totalprice').html(0);
        $('.totalprice2').html(0);
        $('.ajax_cart_quantity').html(0);
      }
    //call guestdata function again to set all data with ajax
    guestcart();


});

function guestcart(){
  $('.products').html('');
  var price=0;
  var options='';
  var locale=`{{app()->getLocale()}}`;
  if (!!$.cookie('cart_data')) {
   // have cookie
   var getcart=JSON.parse($.cookie('cart_data'));
      $('.ajax_cart_quantity').html(getcart.length);
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
                   options+=v.name_ar+'-';
                 }else {
                   options+=v.name+'-';
                 }
               });
             // rtrim the - at the end
             options=options.replace(/-+$/,'');
            //counting the total price
             price=price+parseInt(data.qprice);
             $('.products').append(`<dt data-id="cart_block_product_3_13_0" class="last_item"> <a class="cart-images" href="#"><img src="{{url('')}}/storage/images/products/${data.image}"/></a>
                  <div class="cart-info">
                    <div class="product-name"> <span class="quantity-formated">
                    </span> <a class="cart_block_product_name" href="{{url('')}}/products/${data.slug}">${data.name}</a> </div>
                    <small>${options}</small>
                    <div class="quantity"> الكمية : ${data.quantity}</div>
                    <span>${data.qprice}</span>
                   </div>
                 <span class="remove_link" data-productid="${data.productid}" data-extoptionid="${data.extoptionid}"><a  href="#"> </a></span>
               </dt>`);
             var abbreviation=`{{getcurrency()->getabbreviation()}}`;
             $('.totalprice').html(price +' '+abbreviation);
             $('.totalprice2').html(price +' '+abbreviation);
             // $('.ajax_cart_quantity').html(data.count);
           }
         });
      });
  }else {
    $('.products').append(`<dt data-id="cart_block_product_3_13_0" class="last_item"> No Items </dt>`);
    $('.totalprice').html(0);
    $('.totalprice2').html(0);
    $('.ajax_cart_quantity').html(0);
  }//endif
}//end guestcart
@endif
</script>
</body>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
</html>
