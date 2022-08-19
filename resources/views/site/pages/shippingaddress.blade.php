
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
           <div class=" container clearfix">
             <div class="breadcrumbs">
             <a class="home" href="index.html"><i class="icon-home"></i></a>
             <span class="navigation-pipe"> &gt; </span><a href="checkout.html">تفاصيل السلة </a> &gt; </span>عنوان الشحن</div>
           </div>
         </div>
         <ul class="step clearfix" id="order_step">
           <li class="step_todo first"><span>تفاصيل السلة</span></li>
     <li class="step_todo second"><span>تسجيل الدخول</span></li>
           <li class="step_current third"> <span>عنوان الشحن</span> </li>
           <li class="step_todo four"> <span>طرق الشحن</span> </li>
           <li id="step_end" class="step_todo last"> <span>دفع</span> </li>
         </ul>

      <form id="addressform" action="{{route('selectshipping')}}" method="post">
          @csrf


          @if(count(auth()->user()->addresses)>0)
            <div id="tmcategoryslider" class="block clearfix">
                <ul id="tmcategory-tabs" class="nav nav-tabs clearfix">
                  <li class="first_item active"><input type="radio" value="prev" name="shipping" class="shipping" checked > اختار من عناوينك السابقة</li>
                </ul>
            </div>

            <div  id="previousaddress" class="table_block table-responsive">
              <table  class="table table-bordered stock-management-on">
                <thead>
                  <tr>
                    <th class="cart_product first_item"></th>
                    <th class="cart_description item">معلومات العنوان</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach(auth()->user()->addresses as $address)
                    <tr class="cart_item first_item">
                      <td class="cart_product">
                        <input type="radio" value="{{$address->id}}" name="pre_address" checked>
                      </td>
                      <td class="cart_description">
                        <p class="product-name">
                        {{$address->name.' - '.$address->getcountry->getname().' - '.$address->getcity->getname().' - '.$address->phone.' - '.$address->add_1}}
                        </p>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @endif

         <div class="clear"></div>

         <div id="tmcategoryslider" class="block clearfix">
             <ul id="tmcategory-tabs" class="nav nav-tabs clearfix">
               <li class="first_item active"> <input type="radio" value="new" name="shipping" {{count(auth()->user()->addresses)==0?'checked':''}} class="shipping"> ادخل عنوان التوصيل</li>
             </ul>
         </div>
         <div id="new_address">
           <div class="form_content clearfix">
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 padding-right">
                  <div class="form-group form-error">
                    <label>اسم المستلم :</label>
                    <input type="text" class="form-control" name="name" placeholder="اسم المستلم" >
                  </div>
              </div>

              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 padding-right">
                <div class="form-group form-error">
                  <label>العنوان 1 :</label>
                  <input type="text" class="form-control" name="add_1" name placeholder="العنوان 1" >
               </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 padding-right">
                <div class="form-group form-error">
                  <label>العنوان 2: (اختياري)</label>
                  <input type="text" class="form-control" name="add_2" placeholder="العنوان 2" >
               </div>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 padding-right">
                <div class="form-group form-error">
                  <label>اختار الدولة :</label>
                  <select name="country" id="countries"  class="form-control">
                      <option value=""></option>
                    @foreach($countries as $country)
                      <option value="{{$country->id}}">{{$country->getname()}}</option>
                    @endforeach
                   </select>
                 </div>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 padding-right">
                <div class="form-group form-error">
                  <label>اختار المدينة :</label>
                  <select name="city" id="cities" class="form-control">
                  </select>
                 </div>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 padding-right">
                <label>الرمز البريدى :</label>
                <input type="text" class="form-control" name="postcode" placeholder="الرمز البريدى" >
              </div>
              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                  <div class="form-group form-error">
                    <label>رقم هاتف المستلم :</label>
                    <input type="text" class="form-control" name="phone" placeholder="رقم الجوال" >
                  </div>
              </div>
              <div class="form-group form-error">
                <label>معلومات اضافية :</label>
                <textarea type="text" rows="5" class="form-control" name="info" placeholder="معلومات اضافية" ></textarea>
              </div>

           </div>
         </div>

       </form>
       <p class="cart_navigation clearfix">
         <button class="button btn btn-default standard-checkout button-medium" id="submitaddress"> <span>مواصلة الطلب</span> </button>
       </p>

       </div>
       <!-- ================ نهاية يسار الصفحة ============= -->
        </div>
   </div>
  <!-- === نهاية محتوى الصفحة العمود الايمن والايسر ... ملحوظة ترتيب محتوى الصفحات مختلفة عن محتوى الصفحة الرئيسية ====== -->
      <!-- getting all sub cities form countries -->

        @foreach($countries as $country)
        <span id="cities_{{$country->id}}" class="hide">
          @foreach($country->cities as $city)
            <option {{old('city')==$city->id?'selected':''}} value="{{$city->id}}">{{$city->getname()}}</option>
          @endforeach
        </span>
        @endforeach


@endsection


@push('scripts')
<script type="text/javascript">

$(document).ready(function(){

@if(count(auth()->user()->addresses)>0)

$('#new_address').hide();

$('body').on('change','.shipping',function(e){

  if($('.shipping:checked').val()=='prev'){
    $('#previousaddress').show();
    $('#new_address').hide();
  }else {
    $('#previousaddress').hide();
    $('#new_address').show();
  }

});
@endif

  $('#submitaddress').on('click',function(e){
    e.preventDefault();
    $("#addressform").submit();
  });




    //setting old selections from old()
     @if(old('country'))
      var cat={{old('country')}};
      $('#cities').html('');
      $('#cities').append($(`#cities_${cat}`).html());
     @endif
    //end setting old selections

    $('#countries').on('change',()=>{
      var id=$('#countries').val();
      $('#cities').html('');
      $('#cities').append($(`#cities_${id}`).html());
      $("#cities option:selected").removeAttr("selected");
    });

});
</script>

@endpush
