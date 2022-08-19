

@extends('admin.layouts.layout')


@section('content')
<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">{{__('admindash.shippingmethods.add_shippingmethod')}}</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" action="{{route('storeshippingmethod')}}" method="post">
        @csrf
        <div class="box-body">
          <div class="form-group">
            <label for="name">{{__('admindash.shippingmethods.shippingmethod_name')}}</label>
            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
          </div>
          <div class="form-group">
            <label for="name_ar">{{__('admindash.shippingmethods.shippingmethod_name_ar')}}</label>
            <input type="text" class="form-control" id="name_ar" name="name_ar" value="{{old('name_ar')}}">
          </div>
          <div class="form-group">
            <label for="cost">{{__('admindash.shippingmethods.cost')}} ({{__('admindash.constants.usd')}})</label>
            <input type="number" step="0.01" min="0" class="form-control" id="cost" name="cost" value="{{old('cost')}}">
          </div>
          <div class="form-group">
            <label for="deliverytime">{{__('admindash.shippingmethods.deliverytime')}} ({{__('admindash.constants.days')}})</label>
            <input type="number" step="1" min="1" class="form-control" id="deliverytime" name="deliverytime" value="{{old('deliverytime')}}">
          </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn btn-primary">{{__('admindash.actions.submit')}}</button>
          <a href="{{route('shippingmethods')}}" class="btn btn-default">{{__('admindash.actions.cancel')}}</a>
        </div>
      </form>
    </div>
    <!-- /.box -->

  </div>

</div>

@endsection
