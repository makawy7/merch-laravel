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
 <div class="breadcrumbdiv">
          <div class=" container clearfix">
            <div class="breadcrumbs">
            <a class="home" href="index.html"><i class="icon-home"></i></a>
            <span class="navigation-pipe"> &gt; </span></span>عنوان الشحن</div>
          </div>
        </div>




        <div id="tmcategoryslider" class="block products_block clearfix">
      <ul id="tmcategory-tabs" class="nav nav-tabs clearfix">
        <li class="first_item active">تعديل عنوان الشحن</li>
      </ul>
    </div>


    <form action="{{route('updateaddress',$address->id)}}" method="post" id="new_address">
      @csrf
      <div >
        <div class="form_content clearfix">
           <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 padding-right">
               <div class="form-group form-error">
                 <label>اسم المستلم :</label>
                 <input type="text" class="form-control" name="name" placeholder="اسم المستلم" value="{{old('name')?old('name'):$address->name}}">
               </div>
           </div>

           <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 padding-right">
             <div class="form-group form-error">
               <label>العنوان 1 :</label>
               <input type="text" class="form-control" name="add_1" name placeholder="العنوان 1" value="{{old('add_1')?old('add_1'):$address->add_1}}">
            </div>
           </div>
           <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 padding-right">
             <div class="form-group form-error">
               <label>العنوان 2: (اختياري)</label>
               <input type="text" class="form-control" name="add_2" placeholder="العنوان 2" value="{{old('add_2')?old('add_2'):$address->add_2}}">
            </div>
           </div>
           <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 padding-right">
             <div class="form-group form-error">
               <label>اختار الدولة :</label>
               <select name="country" id="countries"  class="form-control">
                   <option value=""></option>
                 @foreach($countries as $country)
                   <option {{old('country')==$country->id?'selected':''}} {{!old('country') && $address->country==$country->id?'selected':''}} value="{{$country->id}}">{{$country->getname()}}</option>
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
             <input type="text" class="form-control" name="postcode" placeholder="الرمز البريدى" value="{{old('postalcode')?old('postalcode'):$address->postcode}}">
           </div>
           <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
               <div class="form-group form-error">
                 <label>رقم هاتف المستلم :</label>
                 <input type="text" class="form-control" name="phone" placeholder="رقم الجوال" value="{{old('phone')?old('phone'):$address->phone}}">
               </div>
           </div>
           <div class="form-group form-error">
             <label>معلومات اضافية :</label>
             <textarea type="text" rows="5" class="form-control" name="info" placeholder="معلومات اضافية" >{{old('info')?old('info'):$address->info}}</textarea>
           </div>

        </div>
      </div>
      <input type="hidden" name="_method" value="PUT">
    </form>
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
      <p class="cart_navigation clearfix ">
        <a href="#" id="editaddress"  class="button-exclusive btn btn-default" >تعديل</a>
        <a href="{{route('addresses')}}" id="cancel"  class="button-exclusive btn btn-default" >الغاء</a>
     </p>
    </div>
      </div>
        <div class="clear"></div>
        <!-- ================ نهايى اليسار الصفحة ============= -->
      </div>
       </div>
<!-- === نهاية محتوى الصفحة العمود الايمن والايسر ... ملحوظة ترتيب محتوى الصفحات مختلفة عن محتوى الصفحة الرئيسية ====== -->

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
  $('#editaddress').on('click',function(e){
    e.preventDefault();
    $('#new_address').submit();
  });

  //setting old selections from old()
   @if(old('country'))
     var cat={{old('country')}};
     $('#cities').html('');
     $('#cities').append($(`#cities_${cat}`).html());
   @elseif(isset($address->country))
     var cat={{$address->country}};
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
