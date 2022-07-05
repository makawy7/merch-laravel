

@extends('admin.layouts.layout')


@section('content')
<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">{{__('admindash.currencies.add_currency')}}</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" action="{{route('storecurrency')}}" method="post">
        @csrf
        <div class="box-body">
          <div class="form-group">
            <label for="name">{{__('admindash.currencies.currency_name')}}</label>
            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
          </div>
          <div class="form-group">
            <label for="name_ar">{{__('admindash.currencies.currency_name_ar')}}</label>
            <input type="text" class="form-control" id="name_ar" name="name_ar" value="{{old('name_ar')}}">
          </div>
          <div class="form-group">
            <label for="abbreviation">{{__('admindash.currencies.abbreviation')}}</label>
            <input type="text" class="form-control" id="abbreviation" name="abbreviation" value="{{old('abbreviation')}}">
          </div>
          <div class="form-group">
            <label for="abbreviation_ar">{{__('admindash.currencies.abbreviation_ar')}}</label>
            <input type="text" class="form-control" id="abbreviation_ar" name="abbreviation_ar" value="{{old('abbreviation_ar')}}">
          </div>
          <div class="form-group">
            <label for="value">{{__('admindash.currencies.value')}}</label>
            <input type="number" step="0.00000001" min="0" class="form-control" id="value" name="value" value="{{old('value')}}">
          </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn btn-primary">{{__('admindash.actions.submit')}}</button>
          <a href="{{route('currencies')}}" class="btn btn-default">{{__('admindash.actions.cancel')}}</a>
        </div>
      </form>
    </div>
    <!-- /.box -->

  </div>

</div>

@endsection
