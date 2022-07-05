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

      </div>
      <div id="tmcategoryslider" class="block products_block clearfix">
        <ul id="tmcategory-tabs" class="nav nav-tabs clearfix">
          <li class="first_item active">الاشتراك في نظام البائعين</li>
        </ul>
      </div>

      <h3>اختار الخطه المناسبة لك لبدأ البيع</h3>
      <br>
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <form class="planform" action="{{route('submitplan')}}" method="post">
        @csrf
        <table  class="table table-bordered stock-management-on">
          <thead>
            <tr>
                <th style="width:200px"></th>
              @foreach($plans as $plan)
                <th class="cart_description item"> <input type="radio" class="plan" name="plan" value="{{$plan->id}}"> <strong>{{$plan->getname()}}</strong> </th>
              @endforeach
            </tr>
          </thead>

          <tbody>
              <tr class="cart_item first_item">
                <th> <strong>سعر الاشتراك</strong> </th>
                @foreach($plans as $plan)
                <td class="cart_description">{{$plan->getprice()}}</td>
                @endforeach
              </tr>
              <tr class="cart_item first_item">
                <th><strong>النسبة علي البيع</strong></th>
                @foreach($plans as $plan)
                <td class="cart_description">{{$plan->fee}} %</td>
                @endforeach
              </tr>
              <tr class="cart_item first_item">
                <th><strong>الحد الادني للعمولة</strong></th>
                @foreach($plans as $plan)
                <td class="cart_description">{{$plan->getminfee()}}</td>
                @endforeach
              </tr>
              <tr class="cart_item first_item">
                <th><strong>الحد الاقصي للعمولة</strong></th>
                @foreach($plans as $plan)
                <td class="cart_description">{{$plan->getmaxfee()}}</td>
                @endforeach
              </tr>
              <tr class="cart_item first_item">
                <th><strong>عدد المنتجات</strong></th>
                @foreach($plans as $plan)
                <td class="cart_description">{{$plan->product_limit?$plan->product_limit:'غير محدود'}}</td>
                @endforeach
              </tr>
              <tr class="cart_item first_item">
                <th><strong>التصنيفات</strong></th>
                @foreach($plans as $plan)
                <td class="cart_description">{{$plan->variations==0?'غير متاح':'متاح'}}</td>
                @endforeach
              </tr>
              <tr class="cart_item first_item">
                <th><strong>عدد الصور</strong></th>
                @foreach($plans as $plan)
                <td class="cart_description">{{$plan->photo_limit}}</td>
                @endforeach
              </tr>
              <tr class="cart_item first_item">
                <th><strong>عداد الحذف</strong></th>
                @foreach($plans as $plan)
                <td class="cart_description">{{$plan->deleted_counter?$plan->deleted_counter:'لا يوجد'}}</td>
                @endforeach
              </tr>
              <tr class="cart_item first_item">
                <th><strong>عدد مشاهدات المنتج</strong></th>
                @foreach($plans as $plan)
                <td class="cart_description">{{$plan->can_see_views==0?'غير مسموح':'مسموح'}}</td>
                @endforeach
              </tr>
              <tr class="cart_item first_item">
                <th><strong>الأحصائيات</strong></th>
                @foreach($plans as $plan)
                <td class="cart_description">{{$plan->analytics==0?'غير مسموح':'مسموح'}}</td>
                @endforeach
              </tr>
              <tr class="cart_item first_item">
                <th><strong>بادج الاشتراك</strong></th>
                @foreach($plans as $plan)
                <td class="cart_description">
                  @if($plan->badge)
                  <img src="{{url('storage/images/plans/'.$plan->badge)}}" width="100" height="100" alt="">
                  @else
                  {{__('admindash.plans.nobadge')}}
                  @endif
                </td>
                @endforeach
              </tr>
          </tbody>
        </table>
      </form>
        <div class=" col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <p class="cart_navigation clearfix ">
            <a href="{{route('subscribe')}}" id="proceed" class="button-exclusive btn btn-default" title="Continue shopping">متابعة</a>
          </p>
        </div>
</div>

    </div>
      <div class="clear"></div>
       <!-- ================ نهاية اليسار الصفحة ============= -->

    </div>
     </div>
<!-- === نهاية محتوى الصفحة العمود الايمن والايسر ... ملحوظة ترتيب محتوى الصفحات مختلفة عن محتوى الصفحة الرئيسية ====== -->


@endsection


@push('scripts')

<script type="text/javascript">

$(document).ready(function(){

$('#proceed').on('click',function(e){
  e.preventDefault();
  var planError=false;
  if($('.plan:checked').length==0){
    planError=true;
    alert('Please select plan');
  }


  if(planError==false){
    $('.planform').submit();
  }
});

});


</script>


@endpush
