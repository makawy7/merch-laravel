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
      <form class="periodform" action="{{route('submitsub')}}" method="post">
        @csrf
        <div class="form-group">
          <label for="period">اختار مدة الاشتراك</label>
          <select class="form-control" class="period" name="period">
            <option value="1">1 شهر</option>
            <option value="3">3 اشهر</option>
            <option value="6">6 اشهر</option>
            <option value="12">12 شهر</option>
          </select>
        </div>
      </form>
        <div class=" col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <p class="cart_navigation clearfix ">
            <a href="{{route('subscribe')}}" id="proceed" class="button-exclusive btn btn-default" title="Continue shopping">اشترك</a>
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
  var periodError=false;



  if(periodError==false){
    $('.periodform').submit();
  }
});

});


</script>


@endpush
