

@extends('admin.layouts.layout')


@section('content')
<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">{{__('admindash.account.adduser')}}</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" action="{{route('user.store')}}" method="post">
        @csrf
        <div class="box-body">
          <div class="form-group">
            <label for="name">{{__('admindash.account.name')}}</label>
            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
          </div>
          <div class="form-group">
            <label for="email">{{__('admindash.account.email')}}</label>
            <input type="text" class="form-control" id="email" name="email" value="{{old('email')}}">
          </div>
          <div class="form-group">
            <label for="password">{{__('admindash.account.password')}}</label>
            <input type="password" class="form-control" id="password" name="password" >
          </div>
          <div class="form-group">
            <label for="password_confirmation">{{__('admindash.account.password_con')}}</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
          </div>
          <div class="form-group">
                          <label>{{__('admindash.account.birthday')}}:</label>

                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="date" class="form-control pull-right"  value="{{old('birthday')}}" name="birthday" id="datepicker">
                          </div>
                          <!-- /.input group -->
          </div>
          <div class="form-group">
            <label for="gender">{{__('admindash.account.gender')}}</label>
            <select class="form-control" name="gender">
              <option {{old('gender')=='male'?'selected':''}} value="male">{{__('admindash.constants.male')}}</option>
              <option {{old('gender')=='female'?'selected':''}} value="female">{{__('admindash.constants.female')}}</option>
            </select>
          </div>
          <div class="form-group">
            <label style="display:block">{{__('admindash.account.phone')}}</label>
            <select class="" name="country_code">
              @foreach($countries as $country)
                <option value="{{$country->code}}">{{$country->code}}</option>
              @endforeach
            </select>
            <input type="text" id="phonenumber" class="form-control" value="{{old('phone')}}" name="phone" >
          </div>

        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn btn-primary">{{__('admindash.actions.submit')}}</button>
          <a href="{{route('user.index')}}" class="btn btn-default">{{__('admindash.actions.cancel')}}</a>
        </div>
      </form>
    </div>
    <!-- /.box -->

  </div>

</div>

@endsection


@push('scripts')
<!-- bootstrap datepicker -->
<script src="{{url('des/admin/rtl')}}/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/8.4.7/js/intlTelInput.js"></script>

<script type="text/javascript">

$(document).ready(function(){


});
</script>

@endpush
