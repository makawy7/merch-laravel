

@extends('seller.layouts.layout')


@section('content')
<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">معلومات</h3>
      </div>
      <!-- /.box-header -->
      <table class="table direction table-striped">
        <tr>
            <th>تاريخ انتهاء الاشتراك</th>
            <td>{{auth()->user()->store->subscription->getenddate()}}</td>
        </tr>
        <tr>
            <th>خطة اشتراك المتجر</th>
            <td>{{auth()->user()->store->subscription->plan->getname()}}</td>
        </tr>
      </table>
    </div>

    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">{{__('sellerdash.storesettings')}}</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" action="{{route('updatestore',auth()->user()->store->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="box-body">
          <div class="form-group">
            <label for="name">{{__('sellerdash.storename')}}</label>
            <input type="text" class="form-control" id="name" name="name" value="{{auth()->user()->store->name}}">
          </div>
          <div class="form-group">
            <label for="name_ar">{{__('sellerdash.storename_ar')}}</label>
            <input type="text" class="form-control" id="name_ar" name="name_ar" value="{{auth()->user()->store->name_ar}}">
          </div>
          <div class="form-group">
            <label for="address">{{__('sellerdash.storeaddress')}}</label>
            <textarea type="text" class="form-control" id="address" name="address">{{auth()->user()->store->address}}</textarea>
          </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn btn-primary">{{__('admindash.actions.submit')}}</button>
        </div>
      </form>
    </div>
    <!-- /.box -->

  </div>
  @if(auth()->user()->store->subscription->plan->staff_accounts>0)
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">{{__('sellerdash.addstaff')}}</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" action="{{route('addstaff',auth()->user()->store->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="box-body">

          <div class="form-group">
            <label for="email">{{__('sellerdash.enteruseremail')}}</label>
            <input type="email" class="form-control" id="email" name="email" value="" >
          </div>

          <div class="thumbnail">
            <h4>{{__('sellerdash.staff')}}</h4>
            @foreach(auth()->user()->store->staff as $staff)
              <div class="thumbnail">
                  <strong>{{$staff->name}}</strong>
                  @if(auth()->user()->store->owner_id!=$staff->id)
                    <a href="{{route('deletestaff',$staff->id)}}" class="btn btn-danger">{{__('sellerdash.delete')}}</a>
                  @endif
              </div>
            @endforeach
          </div>

        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn btn-primary">{{__('admindash.actions.add')}}</button>
        </div>
      </form>
    </div>
    <!-- /.box -->
    @endif

    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">طلب تغيير خطة الاشتراك</h3>
      </div>
      <div class="box-body">
        <form class="form" id="changeplanfrom" action="{{route('changeplan')}}" method="post">
          @csrf
          <div class="form-group">
            <label for="">اختار الخطه</label>
            <table  class="table direction table-bordered stock-management-on">
              <thead>
                <tr>
                    <th style="width:200px"></th>
                  @foreach($plans as $plan)
                    <th class="cart_description item"> <input type="radio" class="plan" name="plan" value="{{$plan->id}}"> <strong>{{$plan->getname()}}</strong> </th>
                  @endforeach
                </tr>
              </thead>

              <tbody>
                  <tr class="cart_item first_item">
                    <th> <strong>سعر الاشتراك</strong> </th>
                    @foreach($plans as $plan)
                    <td class="cart_description">{{$plan->getprice()}}</td>
                    @endforeach
                  </tr>
                  <tr class="cart_item first_item">
                    <th><strong>النسبة علي البيع</strong></th>
                    @foreach($plans as $plan)
                    <td class="cart_description">{{$plan->fee}} %</td>
                    @endforeach
                  </tr>
                  <tr class="cart_item first_item">
                    <th><strong>الحد الادني للعمولة</strong></th>
                    @foreach($plans as $plan)
                    <td class="cart_description">{{$plan->getminfee()}}</td>
                    @endforeach
                  </tr>
                  <tr class="cart_item first_item">
                    <th><strong>الحد الاقصي للعمولة</strong></th>
                    @foreach($plans as $plan)
                    <td class="cart_description">{{$plan->getmaxfee()}}</td>
                    @endforeach
                  </tr>
                  <tr class="cart_item first_item">
                    <th><strong>عدد المنتجات</strong></th>
                    @foreach($plans as $plan)
                    <td class="cart_description">{{$plan->product_limit?$plan->product_limit:'غير محدود'}}</td>
                    @endforeach
                  </tr>
                  <tr class="cart_item first_item">
                    <th><strong>التصنيفات</strong></th>
                    @foreach($plans as $plan)
                    <td class="cart_description">{{$plan->variations==0?'غير متاح':'متاح'}}</td>
                    @endforeach
                  </tr>
                  <tr class="cart_item first_item">
                    <th><strong>عدد الصور</strong></th>
                    @foreach($plans as $plan)
                    <td class="cart_description">{{$plan->photo_limit}}</td>
                    @endforeach
                  </tr>
                  <tr class="cart_item first_item">
                    <th><strong>عداد الحذف</strong></th>
                    @foreach($plans as $plan)
                    <td class="cart_description">{{$plan->deleted_counter?$plan->deleted_counter:'لا يوجد'}}</td>
                    @endforeach
                  </tr>
                  <tr class="cart_item first_item">
                    <th><strong>عدد مشاهدات المنتج</strong></th>
                    @foreach($plans as $plan)
                    <td class="cart_description">{{$plan->can_see_views==0?'غير مسموح':'مسموح'}}</td>
                    @endforeach
                  </tr>
                  <tr class="cart_item first_item">
                    <th><strong>الأحصائيات</strong></th>
                    @foreach($plans as $plan)
                    <td class="cart_description">{{$plan->analytics==0?'غير مسموح':'مسموح'}}</td>
                    @endforeach
                  </tr>
                  <tr class="cart_item first_item">
                    <th><strong>بادج الاشتراك</strong></th>
                    @foreach($plans as $plan)
                    <td class="cart_description">
                      @if($plan->badge)
                      <img src="{{url('storage/images/plans/'.$plan->badge)}}" width="100" height="100" alt="">
                      @else
                      {{__('admindash.plans.nobadge')}}
                      @endif
                    </td>
                    @endforeach
                  </tr>
              </tbody>
            </table>
          </div>
          <div class="form-group">
            <label for="period">اختار مدة الاشتراك</label>
            <select class="form-control" class="period" name="period">
              <option value=""></option>
              <option value="1">1 شهر</option>
              <option value="3">3 اشهر</option>
              <option value="6">6 اشهر</option>
              <option value="12">12 شهر</option>
            </select>
          </div>
          <div class="form-group">
            <label for="">اختار طريقة الدفع</label>
            <select class="form-control" name="method">
              <option value=""></option>
              @foreach($methods as $method)
              <option value="{{$method->id}}">{{$method->getname()}}</option>
              @endforeach
            </select>
          </div>
        </form>

      </div>
      <div class="box-footer">
        <a href="#" id="changeplan" class="btn btn-primary">ادخل الطلب</a>
      </div>
    </div>
  </div>

</div>

@endsection

@push('scripts')
<script type="text/javascript">

$(document).ready(function(){

    $('#changeplan').on('click',function(e){
        e.preventDefault();
        $('#changeplanfrom').submit();
    });
});


</script>

@endpush
