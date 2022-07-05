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
		<div id="tmcategoryslider" class="block products_block clearfix">
        <ul id="tmcategory-tabs" class="nav nav-tabs clearfix">
          <li class="first_item active">شروط واحكام</li>
        </ul>
      </div>
         <div class="rte">
           @if(function_exists('setting'))
            {!! setting()->getterms() !!}
           @endif
         </div>
          <div class="clear"></div>
        </div>
         <!-- ================ نهاية اليسار الصفحة ============= -->
         </div>
    </div>
  <!-- === نهاية محتوى الصفحة العمود الايمن والايسر ... ملحوظة ترتيب محتوى الصفحات مختلفة عن محتوى الصفحة الرئيسية ====== -->

@endsection
