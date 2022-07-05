
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
      @foreach(auth()->user()->ordergroups as $ordergroup)
        <table class="table table-striped">
          <thead>
            <tr>
              <td>رقم الطلب</td>
              <td>طريقة الدفع</td>
              <td>طريقة الشحن</td>
              <td>مصاريف الشحن</td>
              <td>حالة الطلب</td>
              @if($ordergroup->delivered==1)
              <td>تاريخ التوصيل</td>
              @endif
              <td>اجمالي الطلب</td>
              <td>تفاصيل الطلب</td>

            </tr>
          </thead>
          <tbody>
            <tr>
              <td>{{$ordergroup->order_number}}</td>
              <td>{{$ordergroup->getpaymentmethod->getname()}}</td>
              <td>{{$ordergroup->getshippingmethod->getname()}}</td>
              <td>{{$ordergroup->getshippingcost()}}</td>
              <td>{{$ordergroup->delivered==1?'تم توصيل الطلب':($ordergroup->status==0?'بانتظار تاكيد البائع':$ordergroup->getstatus->getname())}}</td>
              @if($ordergroup->delivered==1)
              <td>{{$ordergroup->delivery_time}}</td>
              @endif
              <td>{{$ordergroup->gettotal()}}</td>
              <td> <a href="{{route('order_details',$ordergroup->order_number)}}">عرض التفاصيل</a> </td>

            </tr>
          </tbody>
        </table>
      @endforeach
    </div>
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
