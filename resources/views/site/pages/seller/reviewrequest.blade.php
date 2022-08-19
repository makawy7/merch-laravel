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

      <h3>مراجعة طلب الاشتراك</h3>
      <br>
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <form class="planform" action="{{route('submitplan')}}" method="post">
        @csrf
        <table  class="table table-bordered stock-management-on">
          <thead>
            <tr>
                <th class="cart_description item">الخطة</th>
                <th class="cart_description item">السعر</th>
                <th class="cart_description item">طريقة الدفع</th>
                <th class="cart_description item">مدة الاشتراك</th>
            </tr>
          </thead>

          <tbody>
              <tr class="cart_item first_item">
                <td>{{$plan->getname()}}</td>
                <td>{{$plan->getprice()}}</td>
                <td>{{$paymentmethod->getname()}}</td>
                <td>{{$period}} اشهر</td>
              </tr>

          </tbody>
        </table>
      </form>
        <div class=" col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <p class="cart_navigation clearfix ">
            <a href="{{route('confirmsubscribe')}}" id="proceed" class="button-exclusive btn btn-default" title="Continue shopping">تأكيد</a>
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


});


</script>


@endpush
