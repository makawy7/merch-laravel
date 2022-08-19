
@extends('site.layouts.layout2')

@section('content')

<div id="columns" class="container">
  <div class="row" id="columns_inner">
    <div id="left_column" class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
      @include('site.includes.menu')

    </div>
    <div id="center_column" class="center_column col-xs-12 col-sm-9 col-md-9 col-lg-9">
      <!-- Steps -->
      <ul class="step clearfix" id="order_step">
        <li class="step_todo first"><span>تفاصيل السلة</span></li>
  <li class="step_current second"><span>تسجيل الدخول</span></li>
        <li class="step_todo third"> <span>عنوان الشحن</span> </li>
        <li class="step_todo four"> <span>طرق الشحن</span> </li>
        <li id="step_end" class="step_todo last"> <span>دفع</span> </li>
      </ul>
      <!-- /Steps -->

      <div class="col-xs-12 col-sm-6">
  <form action="{{route('login')}}" method="post" id="login_form" class="box">
    @csrf
    <h3 class="page-subheading">تسجيل دخول</h3>
    <div class="form_content clearfix">
      <!-- <div class="form-group form-error">
        <input class="is_required validate account_input form-control" type="text" placeholder="إسم المستخدم">
      </div>
      <div class="form-group form-error">
        <input class="is_required validate account_input form-control" type="tel" placeholder="رقم الجوال">
      </div> -->
      <div class="form-group form-error">
        <input class="is_required validate account_input form-control" type="email"  name="email" placeholder="البريد الإلكترونى">
      </div>
      <div class="form-group form-error">
        <input class="is_required validate account_input form-control" type="password"  name="password" placeholder="كلمة المرور">
      </div>
      <div class="form-group form-error">
        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

        <label class="form-check-label" for="remember">
            تذكرني
        </label>
      </div>
      @if (Route::has('password.request'))
          <a class="btn btn-link" href="{{ route('password.request') }}">
              هل نسيت كلمة المرور؟
          </a>
      @endif
      <p>
        <button type="submit" id="SubmitLogin" name="SubmitLogin" class="button btn btn-info button-medium">
          <span>
            <i class="icon-lock left"></i>
            دخول
          </span>
        </button>
      </p>
    </div>
  </form>
         <!-- <p class="cart_navigation clearfix">
      <a  href="checkout2.html" class="button btn btn-default standard-checkout button-medium" > <span>مواصلة الطلب</span> </a>

       </p> -->
</div>

      <!-- end order-detail-content -->


      <div class="clear"></div>
    </div>
     </div>
</div>
@endsection
