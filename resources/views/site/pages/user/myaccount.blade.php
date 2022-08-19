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
          <span class="navigation-pipe"> &gt; </span></span>ملفي الشخصي</div>
        </div>
      </div>
      <div id="tmcategoryslider" class="block products_block clearfix">
        <ul id="tmcategory-tabs" class="nav nav-tabs clearfix">
          <li class="first_item active">المعلومات الشخصية</li>
        </ul>
      </div>

      <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
  <form action="#" method="post" id="login_form">
    <div class="form_content clearfix">
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 padding-right">
    <div class="form-group form-error">
      <label>الأسم بالكامل :</label>
      <input type="text" class="form-control" value="{{auth()->user()->name}}" name="name" placeholder="الاسم" >
      </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 padding-right">
    <div class="form-group form-error">
      <label>اسم المستخدم :</label>
      <input type="text" class="form-control" value="{{auth()->user()->username}}"   name="username"  placeholder="اسم المستخدم" >
      </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 padding-right">
      <div class="form-group form-error">
        <label>رقم الهاتف :</label>
        <input type="text" class="form-control" value="({{auth()->user()->country_code}}) {{auth()->user()->phone}}" name="phone" placeholder="رقم الجوال" >
        @if(!auth()->user()->phone_verified_at)
        <small> <a href="{{route('verifyphone')}}">تاكيد رقم الهاتف</a> </small>
        @endif
      </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 padding-right">
      <div class="form-group form-error">
        <label>البريد الالكتروني :</label>
        <input type="email" class="form-control" value="{{auth()->user()->email}}" name="email" placeholder="" >
        @if(!auth()->user()->email_verified_at)
        <small> <a href="{{route('verification.resend')}}">تأكيد البريد الالكتروني</a> </small>
        @endif
      </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 padding-right">
    <div class="form-group form-error">
    <label>الدولة :</label>
      <input type="text" class="form-control" value="{{auth()->user()->getcountry?auth()->user()->getcountry->getname():''}}" placeholder="اسم الدولة" >
      </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 padding-right">
    <div class="form-group form-error">
    <label> المدينة :</label>
       <input type="text" class="form-control" value="{{auth()->user()->getcity?auth()->user()->getcity->getname():''}}" placeholder="اسم المدينة" >
      </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 padding-right">
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 padding-right">
                  <label> الجنس :</label>
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 padding-right padding-left">
                  <div class="form-group form-error">
                    <select name="gender" id="gender" class="form-control">
                      <option {{auth()->user()->gender=='male'?'selected':''}} value="male" selected="selected">ذكر</option>
                      <option {{auth()->user()->gender=='female'?'selected':''}} value="female">أنثى</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 padding-right">
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 padding-right padding-left">
                  <label> تاريخ الميلاد :</label>
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 padding-right padding-left">
                  <div class="form-group form-error">
                    <input class="is_required validate account_input form-control" name="birthday" value="{{auth()->user()->birthday}}" type="date" placeholder="تاريخ الميلاد">
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 padding-right">
              </div>
              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 padding-right">
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 padding-right">
                    <label>اللغة الافتراضية</label>
                    </div>
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 padding-right padding-left">
                      <div class="form-group form-error">
                        <select name="default_lang" id="default_lang" class="form-control">
                          <option {{auth()->user()->gender=='ar'?'selected':''}} value="ar">العربية</option>
                          <option {{auth()->user()->gender=='en'?'selected':''}} value="en">English</option>
                        </select>
                      </div>
                    </div>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 padding-right">
                  <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 padding-right padding-left">
                      <label>العملة الافتراضية</label>
                  </div>
                  <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 padding-right padding-left">
                    <select name="currency" id="currency" class="form-control">
                      @if(function_exists('currencies') && count(currencies())>0)
                        @foreach(currencies() as $currency)
                      <option {{auth()->user()->currency==$currency->id?'selected':''}} value="{{$currency->id}}">{{$currency->getname()}} ({{$currency->getabbreviation()}}) </option>
                        @endforeach
                      @endif
                    </select>
                  </div>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 padding-right">
                  <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 padding-right padding-left">
                      <label>نقاط المكافأة</label>
                  </div>
                  <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 padding-right padding-left">
                    <input type="number" class="form-control" value="{{auth()->user()->points}}" name="name" placeholder="نقاط المكافأة" >
                  </div>
              </div>

    </div>
  </form>
  <div class="clear"></div>
  <div id="tmcategoryslider" class="block products_block clearfix">
    <ul id="tmcategory-tabs" class="nav nav-tabs clearfix">
      <li class="first_item active">ابدأ البيع</li>
    </ul>
  </div>

  <div class=" col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <p class="cart_navigation clearfix ">
    @if(auth()->user()->store)
      <a href="{{route('seller.product.index')}}" id="" class="button-exclusive btn btn-default" title="Continue shopping">ادارة المتجر</a>
    @elseif(auth()->user()->subscription && !auth()->user()->store)
      <a href="{{route('create_store')}}" id="" class="button-exclusive btn btn-default" title="Continue shopping">انشاء المتجر</a>
    @else
      <a href="{{route('subscribe')}}" id="" class="button-exclusive btn btn-default" title="Continue shopping">الاشتراك في نظام البائعين</a>
    @endif
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

  $('#phonenumber').intlTelInput({
    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/8.4.6/js/utils.js"
  }).done(function() {
      $('#phonenumber').intlTelInput("setCountry", `{{auth()->user()->country_iso2?auth()->user()->country_iso2:'gb'}}`);
  });

});


</script>


@endpush
