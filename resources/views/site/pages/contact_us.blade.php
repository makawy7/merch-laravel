
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
      <li class="first_item active">تواصل معنا</li>
    </ul>
  </div>
     <form action="{{route('contact_us')}}" method="post" class="contact-form-box">
       @csrf
            <fieldset>
                <div class="clearfix">
                    <div class="col-xs-12 col-md-7 padding-right">
                            <p class="form-group">
                            @if(!auth()->user())
                            <label><span class="required"></span> الأسم</label>
                            <input class="form-control grey validate" name="name" type="text" placeholder="الأسم" />
                            </p>
                            <div class="form-group">
                            <label><span class="required"></span> رقم الهاتف</label>
                            <input class="form-control grey" type="tel" name="phone" placeholder="رقم الهاتف" />
                            </div>
                            <div class="form-group">
                            <label><span class="required"></span> البريد الألكترونى</label>
                            <input class="form-control grey" type="email" name="email" placeholder="البريد الألكترونى" />
                            </div>
                            @endif
                            <div class="form-group">
                            <label><span class="required">*</span> عنوان الرسالة</label>
                            <input class="form-control grey" type="text" name="title" placeholder="عنوان الرسالة" />
                            </div>
                            <div class="form-group">
                            <label><span class="required">*</span > أكتب رسالتك</label>
                            <textarea class="form-control" type="text" name="body" rows="12" placeholder="أكتب رسالتك" ></textarea>
                            </div>

                            <p class="text-center">
                <button type="submit" id="SubmitLogin" name="SubmitLogin" class="button btn btn-info button-medium"> <span>إرسال <i class="fa fa-sign-in"></i></span> </button>
              </p>


                                        </div>

                </div>

            </fieldset>
        </form>
      <div class="clear"></div>
    </div>
    <!-- ================ نهاية اليسار الصفحة ============= -->
     </div>
</div>

@endsection
