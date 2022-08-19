

@extends('admin.layouts.layout')


@section('content')
<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">{{__('admindash.settings.settings')}}</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" action="{{route('store_settings')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <div class="box-body">
          <div class="form-group">
            <label for="name">{{__('admindash.settings.sitename')}}</label>
            <input type="text" class="form-control" id="name" name="name" value="{{old('name')?old('name'):setting()->name}}">
          </div>
          <div class="form-group">
            <label for="name_ar">{{__('admindash.settings.sitename_ar')}}</label>
            <input type="text" class="form-control" id="name_ar" name="name_ar" value="{{old('name_ar')?old('name_ar'):setting()->name_ar}}">
          </div>
          <div class="form-group">
            <label for="icon">{{__('admindash.settings.icon')}}</label>
            <input type="file" class="form-control" id="icon" name="icon" accept="image/*" value="{{old('icon')}}">
          </div>
          <div class="form-group">
            <label for="logo">{{__('admindash.settings.logo')}}</label>
            <input type="file" class="form-control" id="logo" name="logo" accept="image/*" value="{{old('logo')}}">
          </div>
          <div class="form-group">
            <label for="terms">{{__('admindash.settings.terms')}}</label>
            <textarea id="terms" name="terms" rows="10" cols="80">{!!old('terms')?old('terms'):setting()->terms!!}</textarea>
          </div>
          <div class="form-group">
            <label for="terms_ar">{{__('admindash.settings.terms_ar')}}</label>
            <textarea id="terms_ar" name="terms_ar" rows="10" cols="80">{!!old('terms_ar')?old('terms_ar'):setting()->terms_ar!!}</textarea>
          </div>
          <div class="form-group">
            <label for="return_policy">{{__('admindash.settings.return_policy')}}</label>
            <textarea id="return_policy" name="return_policy" rows="10" cols="80">{!!old('return_policy')?old('return_policy'):setting()->return_policy!!}</textarea>
          </div>
          <div class="form-group">
            <label for="return_policy_ar">{{__('admindash.settings.return_policy_ar')}}</label>
            <textarea id="return_policy_ar" name="return_policy_ar" rows="10" cols="80">{!!old('return_policy_ar')?old('return_policy_ar'):setting()->return_policy_ar!!}</textarea>
          </div>
          <div class="form-group">
            <label for="privacy_policy">{{__('admindash.settings.privacy_policy')}}</label>
            <textarea id="privacy_policy" name="privacy_policy" rows="10" cols="80">{!!old('privacy_policy')?old('privacy_policy'):setting()->privacy_policy!!}</textarea>
          </div>
          <div class="form-group">
            <label for="privacy_policy_ar">{{__('admindash.settings.privacy_policy_ar')}}</label>
            <textarea id="privacy_policy_ar" name="privacy_policy_ar" rows="10" cols="80">{!!old('privacy_policy_ar')?old('privacy_policy_ar'):setting()->privacy_policy_ar!!}</textarea>
          </div>
          <div class="form-group">
            <label for="address">{{__('admindash.settings.address')}}</label>
            <input type="text" class="form-control" id="address" name="address" value="{{old('address')?old('address'):setting()->address}}">
          </div>
          <div class="form-group">
            <label for="address_ar">{{__('admindash.settings.address_ar')}}</label>
            <input type="text" class="form-control" id="address_ar" name="address_ar" value="{{old('address_ar')?old('address_ar'):setting()->address_ar}}">
          </div>
          <div class="form-group">
            <label for="phone">{{__('admindash.settings.phone')}}</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{old('phone')?old('phone'):setting()->phone}}">
          </div>
          <div class="form-group">
            <label for="email">{{__('admindash.settings.email')}}</label>
            <input type="email" class="form-control" id="email" name="email" value="{{old('email')?old('email'):setting()->email}}">
          </div>
          <div class="form-group">
            <label for="default_lang">{{__('admindash.settings.default_lang')}}</label>
            <select class="form-control" id="default_lang" name="default_lang">
                <option {{setting()->default_lang=='ar'?'selected':''}} value="ar">{{__('admindash.constants.ar')}}</option>
                <option {{setting()->default_lang=='en'?'selected':''}} value="en">{{__('admindash.constants.en')}}</option>
            </select>
          </div>
          <div class="form-group">
            <label for="default_currency">{{__('admindash.settings.default_currency')}}</label>
            <select class="form-control" id="default_currency" name="default_currency">
              @if(function_exists('currencies') && count(currencies())>0)
                @foreach(currencies() as $currency)
                  <option {{setting()->default_currency==$currency->id?'selected':''}} value="{{$currency->id}}">{{$currency->getname()}}</option>
                @endforeach
              @endif
            </select>
          </div>
          <div class="form-group">
            <label for="tags">{{__('admindash.settings.tags')}}</label>
            <input type="text" class="form-control" id="tags" name="tags" value="{{old('tags')?old('tags'):setting()->tags}}">
          </div>
          <div class="form-group">
            <label for="status">{{__('admindash.settings.status')}}</label>
            <select class="form-control" id="status" name="status">
                <option {{setting()->status==1?'selected':''}} value="1">{{__('admindash.constants.open')}}</option>
                <option {{setting()->status==0?'selected':''}} value="0">{{__('admindash.constants.closed')}}</option>
            </select>
          </div>
          <div class="form-group">
            <label for="maintenance_msg">{{__('admindash.settings.maintenance_msg')}}</label>
            <textarea id="maintenance_msg" name="maintenance_msg" rows="10" cols="80">{!!old('maintenance_msg')?old('maintenance_msg'):setting()->maintenance_msg!!}</textarea>
          </div>
          <div class="form-group">
            <label for="maintenance_msg_ar">{{__('admindash.settings.maintenance_msg_ar')}}</label>
            <textarea id="maintenance_msg_ar" name="maintenance_msg_ar" rows="10" cols="80">{!!old('maintenance_msg_ar')?old('maintenance_msg_ar'):setting()->maintenance_msg_ar!!}</textarea>
          </div>
          <div class="form-group">
            <label for="pointsprice">{{__('admindash.settings.pointsprice')}}</label>
            <input type="number" min="0" step="0.01" class="form-control" id="pointsprice" name="points_value" value="{{old('tags')?old('tags'):setting()->points_value}}">
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

</div>

@endsection

@push('scripts')
<script type="text/javascript">

$(document).ready(function(){

    CKEDITOR.replace('terms');
    CKEDITOR.replace('terms_ar');
    CKEDITOR.replace('return_policy');
    CKEDITOR.replace('return_policy_ar');
    CKEDITOR.replace('privacy_policy');
    CKEDITOR.replace('privacy_policy_ar');
    CKEDITOR.replace('maintenance_msg');
    CKEDITOR.replace('maintenance_msg_ar');

    $('#tags').tagsinput({});
});


</script>

@endpush
