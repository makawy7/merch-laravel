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



        @if(count(auth()->user()->addresses)>0)
          <div id="tmcategoryslider" class="block clearfix">
              <ul id="tmcategory-tabs" class="nav nav-tabs clearfix">
                <li class="first_item active">العنوانين المضافة</li>
              </ul>
          </div>

          <div  id="previousaddress" class="table_block table-responsive">
            <table  class="table table-bordered stock-management-on">
              <thead>
                <tr>
                  <th class="cart_description item">معلومات العنوان</th>
                  <th class="cart_delete last_item">العمل</th>
                </tr>

              </thead>

              <tbody>
                @foreach(auth()->user()->addresses as $address)
                  <tr class="cart_item first_item">
                    <td class="cart_description">
                      <p class="product-name">
                      {{$address->name.' - '.$address->getcountry->getname().' - '.$address->getcity->getname().' - '.$address->phone.' - '.$address->add_1}}
                      </p>
                    </td>
                    <td class="cart_delete text-center">
                      <a href="{{route('editaddress',$address->id)}}" class="btn btn-default"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                      <form class="hide destroyaddress" action="{{route('destroyaddress',$address->id)}}" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                      </form>
                      <a href="#" onclick="$('.destroyaddress').submit();" class="btn btn-default"><i class="icon-trash"></i></a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @endif


        <div id="tmcategoryslider" class="block products_block clearfix">
      <ul id="tmcategory-tabs" class="nav nav-tabs clearfix">
        <li class="first_item active">اضافة عنوان شحن جديد</li>
      </ul>
    </div>


    <form action="{{route('addnewaddress')}}" method="post" id="new_address">
      @csrf
      <div >
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
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
      <p class="cart_navigation clearfix ">
        <a href="#" id="addnew"  class="button-exclusive btn btn-default" >اضافة</a>
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
  $('#addnew').on('click',function(e){
    e.preventDefault();
    $('#new_address').submit();
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
