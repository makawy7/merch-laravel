
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
  <!-- <div class="breadcrumbdiv">
        <div class=" container clearfix">
          <div class="breadcrumbs">
          <a class="home" href="index.html"><i class="icon-home"></i></a>
          <span class="navigation-pipe"> &gt; </span>
          <a href="checkout.html">تفاصيل السلة </a>
           <span class="navigation-pipe"> &gt; </span>
           <a href="checkout2.html">عنوان الشحن </a>
           <span class="navigation-pipe"> &gt; </span>
           <a href="checkout3.html">طرق الشحن </a>
           <span class="navigation-pipe"> &gt; </span>
           الدفع

           </div>
        </div>
      </div> -->
      <ul class="step clearfix" id="order_step">
        <li class="step_todo first"><span>تفاصيل السلة</span></li>
  <li class="step_todo second"><span>تسجيل الدخول</span></li>
        <li class="step_todo third"> <span>عنوان الشحن</span> </li>
        <li class="step_todo four"> <span>طرق الشحن</span> </li>
        <li  class="step_current last"> <span>دفع</span> </li>
      </ul>
      <div >
  <form action="{{route('submitorder')}}" method="post" id="postorder">
    @csrf
    <h3 class="page-subheading">تم اضافة الطلب بنجاح ، وسيتم شحنه قريبا</h3>
    <div class="form_content clearfix">
        <table class="table table-striped">
          <thead>
            <tr>
              <td>رقم الطلب</td>
              <td>طريقة الدفع</td>
              <td>طريقة الشحن</td>
              <td>مصاريف الشحن</td>
              <td>اجمالي الطلب</td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>{{$ordergroup->order_number}}</td>
              <td>{{$ordergroup->getpaymentmethod->getname()}}</td>
              <td>{{$ordergroup->getshippingmethod->getname()}}</td>
              <td>{{$ordergroup->getshippingmethod->getcost()}}</td>
              <td>{{$ordergroup->gettotal()}}</td>
            </tr>
          </tbody>
        </table>

        <h3 class="page-subheading">تفاصيل الطلب</h3>

        <table class="table table-striped">
          <thead>
            <tr>
              <td>صورة المنتج</td>
              <td>اسم المنتج</td>
              <td>سعر المنتج</td>
              <td>الكمية</td>
              <td>الاجمالي</td>
            </tr>
          </thead>
          <tbody>
            @foreach($ordergroup->orders as $order)
            <tr>
              <td><img style="width:75px;height:75px" src="{{url('')}}/storage/images/products/{{$order->product->image}}"/></td>
              <td> <a href="{{url('')}}/products/{{$order->product->getslug()}}">{{$order->product->gettitle()}}</a>
                <small style="display:block" class="cart_ref">
                @if($order->extoption_id!='')
                   @foreach($order->extoption->options as $option)
                   <span class="label label-success">{{$option->getname()}}</span>
                   @endforeach
                @endif</small></td>
              <td>{{$order->extoption_id!=''?$order->extoption->getprice():$order->product->getprice()}}</td>
              <td>{{$order->quantity}}</td>
              <td>{{$order->getqprice()}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
    </div>
  </form>
       <p class="cart_navigation clearfix">
           <a href="{{route('index')}}" class="button btn btn-default standard-checkout button-medium" id="ordernow" > <span>العودة الي الصفحة الرئيسية</span> </a>
           <a href="{{route('myaccount')}}" class="button btn btn-default standard-checkout button-medium" id="ordernow" > <span>حسابي</span> </a>
       </p>
</div>
      <div class="clear"></div>
    </div>
    <!-- ================ نهاية اليسار الصفحة ============= -->
     </div>
</div>
<!-- === نهاية محتوى الصفحة العمود الايمن والايسر ... ملحوظة ترتيب محتوى الصفحات مختلفة عن محتوى الصفحة الرئيسية ====== -->


@endsection


@push('scripts')
<script type="text/javascript">

$(document).ready(function(){
  $('#ordernow').on('click',function(e){
    e.preventDefault();
    $('#postorder').submit();
  });
});

</script>

@endpush
