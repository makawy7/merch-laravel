

@extends('admin.layouts.layout')


@section('content')
<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">{{__('admindash.countriesandcities.add_country')}}</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" action="{{route('storecountry')}}" method="post">
        @csrf
        <div class="box-body">
          <div class="form-group">
            <label for="name">{{__('admindash.countriesandcities.countryname')}}</label>
            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
          </div>
          <div class="form-group">
            <label for="name_ar">{{__('admindash.countriesandcities.countryname_ar')}}</label>
            <input type="text" class="form-control" id="name_ar" name="name_ar" value="{{old('name_ar')}}">
          </div>
          <div class="form-group">
            <label for="code">كود الهاتف للدولة</label>
            <input type="text" class="form-control" id="code" name="code" value="{{old('code')}}">
          </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn btn-primary">{{__('admindash.actions.submit')}}</button>
          <a href="{{route('countries')}}" class="btn btn-default">{{__('admindash.actions.cancel')}}</a>
        </div>
      </form>
    </div>
    <!-- /.box -->

  </div>

</div>

@endsection
