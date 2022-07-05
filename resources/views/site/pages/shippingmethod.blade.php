
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
              <span class="navigation-pipe"> &gt; </span>
              <a href="checkout.html">تفاصيل السلة </a>
               <span class="navigation-pipe"> &gt; </span>
               <a href="checkout2.html">عنوان الشحن </a>
               <span class="navigation-pipe"> &gt; </span>
               طرق الشحن
               </div>
            </div>
          </div>
          <ul class="step clearfix" id="order_step">
            <li class="step_todo first"><span>تفاصيل السلة</span></li>
			<li class="step_todo second"><span>تسجيل الدخول</span></li>
            <li class="step_todo third"> <span>عنوان الشحن</span> </li>
            <li class="step_current four"> <span>طرق الشحن</span> </li>
            <li id="step_end" class="step_todo last"> <span>دفع</span> </li>
          </ul>
          <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9 padding-right">
			<form action="{{route('shippingselected')}}" method="post" id="shippingselected">
        @csrf
        <h3 class="page-subheading">يُرجى تحديد طريقة شحن مفضلة لاستخدامها في هذا الطلب.</h3>
        <div class="form_content clearfix">
        @foreach($shippingmethods as $shippingmethod)
            <div class="form-group form-error">
              <div id="tmcategoryslider" class="block products_block clearfix">
                <ul id="tmcategory-tabs" class="nav nav-tabs clearfix">
                  <li class="first_item active">{{$shippingmethod->getname()}}</li>
                </ul>
              </div>
              <label for="id_gender1" class="top">
              <input type="radio" name="shippingmethod" value="{{$shippingmethod->id}}" checked="checked">
              <b>{{$shippingmethod->getname()}} -- {{$shippingmethod->getcost()}} -- {{$shippingmethod->deliverytime}} {{__('site.constants.days')}}</b>
              </label>
            </div>
        @endforeach
        </div>
      </form>
             <p class="cart_navigation clearfix">
          <a  href="#" class="button btn btn-default standard-checkout button-medium" id="shippinglink"> <span>مواصلة الطلب</span> </a>

           </p>
		</div>
          <div class="clear"></div>
        </div>
        <!-- ================ نهاية يسار الصفحة ============= -->
         </div>
    </div>
 <!-- === نهاية محتوى الصفحة العمود الايمن والايسر ... ملحوظة ترتيب محتوى الصفحات مختلفة عن محتوى الصفحة الرئيسية ====== -->

@endsection


@push('scripts')
<script type="text/javascript">

$(document).ready(function(){
  $('#shippinglink').on('click',function(e){
    e.preventDefault();
    $('#shippingselected').submit();
  });
});

</script>

@endpush
