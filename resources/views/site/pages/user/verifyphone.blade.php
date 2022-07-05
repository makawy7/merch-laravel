
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
          <span class="navigation-pipe"> &gt; </span></span>تأكيد رقم الهاتف</div>
        </div>
      </div>
      <div id="tmcategoryslider" class="block products_block clearfix">
        <ul id="tmcategory-tabs" class="nav nav-tabs clearfix">
          <li class="first_item active">تأكيد رقم الهاتف</li>
        </ul>
      </div>

<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
  <form action="{{route('updateaccount')}}" method="post" id="sendcodeform">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <div class="form_content clearfix">

        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 padding-right">
            <div class="form-group form-error">
              <label>رقم الهاتف :</label>
              <input type="text" disabled id="phonenumber" class="form-control" value="{{auth()->user()->country_code.auth()->user()->phone}}" name="phone" placeholder="رقم الجوال" >
            </div>
        </div>

    </div>
  </form>
  <div class=" col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <p class="cart_navigation clearfix ">
        <a href="#" id="sendcode" class="button-exclusive btn btn-default" title="Continue shopping">ارسال رسالة التأكيد</a>
        <a href="{{url()->previous()==url()->current()?route('account'):url()->previous()}}" class="button-exclusive btn btn-default" title="Continue shopping">رجوع</a>
      </p>
  </div>

  <form action="{{route('updateaccount')}}" method="post" id="codeform">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <div class="form_content clearfix">

        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 padding-right">
            <div class="form-group form-error">
              <label>كود التاكيد</label>
              <input type="text" id="code" class="form-control" value="" name="phone" placeholder="كود التاكيد" >
            </div>
        </div>

    </div>
  </form>
  <div class=" col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <p class="cart_navigation clearfix ">
        <a href="#" id="submitcode" class="button-exclusive btn btn-default" title="Continue shopping">تأكيد</a>
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



  $('#sendcode').on('click',function(e){
    e.preventDefault();
    var self=this;
    $.ajax({
      url:`{{route('sendcode')}}`,
      method:'post',
      data:{_token:`{{csrf_token()}}`},
      success:function(data){
        if(data.status=='success'){
          $(self).hide();
          alert('verification code has been sent to your phone number');
        }
      },
      error:function(){
        alert('something went wrong');
      }
    });
  });


  $('#submitcode').on('click',function(e){
    e.preventDefault();
    if($('#code').val()==''){
      alert('Please Enter The Code');
    }else {
      var code=$('#code').val();
      $.ajax({
        url:`{{route('confirmcode')}}`,
        method:'post',
        data:{code:code,_token:`{{csrf_token()}}`},
        success:function(data){
          if(data.status=='success'){
            alert('Phone number has been verified Successfully');
            window.location.href="{{route('account')}}";
          }else {
            alert('code is Incorrect');
          }
        },
        error:function(){
          alert('something went wrong');
        }
      });
    }
  });
});

</script>

@endpush
