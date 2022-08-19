
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

      <div >
    <div class="form_content clearfix">

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

        <h3>عنوان الشحن</h3>

        <table class="table table-striped">
          <thead>
            <tr>
              <td>{{__('admindash.orders.address_name')}}</td>
              <td>{{__('admindash.orders.address_phone')}}</td>
              <td>{{__('admindash.orders.address_address_line1')}}</td>
              <td>{{__('admindash.orders.address_address_line2')}}</td>
              <td>{{__('admindash.orders.address_city')}}</td>
              <td>{{__('admindash.orders.address_country')}}</td>
              <td>{{__('admindash.orders.address_postcode')}}</td>
              <td>{{__('admindash.orders.address_info')}}</td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>{{$ordergroup->getaddress->name}}</td>
              <td>{{$ordergroup->getaddress->phone}}</td>
              <td>{{$ordergroup->getaddress->add_1}}</td>
              <td>{{$ordergroup->getaddress->add_2?$ordergroup->getaddress->add_2:'N/A'}}</td>
              <td>{{$ordergroup->getaddress->getcity->getname()}}</td>
              <td>{{$ordergroup->getaddress->getcountry->getname()}}</td>
              <td>{{$ordergroup->getaddress->postcode?$ordergroup->getaddress->postcode:'N/A'}}</td>
              <td>{{$ordergroup->getaddress->info?$ordergroup->getaddress->info:'N/A'}}</td>
            </tr>
          </tbody>
        </table>
    </div>
       <p class="cart_navigation clearfix">
           <a href="{{url()->previous()}}" class="button btn btn-default standard-checkout button-medium"  > <span>رجوع</span> </a>
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
