

@extends('admin.layouts.layout')


@section('content')
<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">{{__('admindash.countriesandcities.edit_city')}}</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" action="{{route('updatecity',$city->id)}}" method="post">
        @csrf
        <div class="box-body">
          <div class="form-group">
            <label for="name">{{__('admindash.countriesandcities.cityname')}}</label>
            <input type="text" class="form-control" id="name" name="name" value="{{old('name')?old('name'):$city->name}}">
          </div>
          <div class="form-group">
            <label for="name_ar">{{__('admindash.countriesandcities.cityname_ar')}}</label>
            <input type="text" class="form-control" id="name_ar" name="name_ar" value="{{old('name_ar')?old('name_ar'):$city->name_ar}}">
          </div>
          <div class="form-group">
            <label for="">{{__('admindash.countriesandcities.country')}}</label>
            <select class="form-control" name="country_id">
              <option value=""></option>
              @foreach($countries as $country)
                <option {{$city->country->id==$country->id?'selected':''}} value="{{$country->id}}">{{$country->getName()}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn btn-primary">{{__('admindash.actions.submit')}}</button>
          <a href="{{route('cities')}}" class="btn btn-default">{{__('admindash.actions.cancel')}}</a>
        </div>
      </form>
    </div>
    <!-- /.box -->

  </div>

</div>

@endsection
