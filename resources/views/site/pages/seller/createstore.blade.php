
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
          <li class="first_item active">انشاء المتجر</li>
        </ul>
      </div>

<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
  <form action="{{route('createstore')}}" method="post" id="createstoreform">
    @csrf

    <div class="form_content clearfix">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 padding-right">
            <div class="form-group form-error">
              <label>اسم المتجر باللغة الانجليزية :</label>
              <input type="text" class="form-control" value="{{old('name')}}" name="name"  >
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 padding-right">
            <div class="form-group form-error">
              <label>اسم المتجر باللغة العربية :</label>
              <input type="text" class="form-control" value="{{old('name_ar')}}"   name="name_ar">
          </div>
        </div>

        <div class="form-group form-error">
                     <label>عنوان المتجر :</label>
                     <textarea type="text" rows="5" class="form-control" name="address" placeholder="عنوان المتجر"></textarea>
       </div>


    </div>
  </form>

    <div class=" col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <p class="cart_navigation clearfix ">
          <a href="#" id="createstore" class="button-exclusive btn btn-default" title="Continue shopping">انشاء المتجر</a>
        </p>
    </div>

</div>
    </div>
      <div class="clear"></div>
       <!-- ================ نهاية اليسار الصفحة ============= -->

    </div>
     </div>




@endsection


@push('scripts')
<script type="text/javascript">

$(document).ready(function(){
  $('#createstore').on('click',function(e){
    e.preventDefault();
    $('#createstoreform').submit();
  })
});

</script>

@endpush
