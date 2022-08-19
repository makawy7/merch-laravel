

@extends('admin.layouts.layout')


@section('content')
<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">{{__('admindash.plans.addplan')}}</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" action="{{route('plans.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="box-body">
          <div class="form-group">
            <label for="name">{{__('admindash.plans.name')}}</label>
            <input type="text" class="form-control" id="name"  name="name" value="{{old('name')}}">
          </div>
          <div class="form-group">
            <label for="name_ar">{{__('admindash.plans.name_ar')}}</label>
            <input type="text" class="form-control" id="name_ar" name="name_ar" value="{{old('name_ar')}}">
          </div>
          <div class="form-group">
            <label for="head_des">{{__('admindash.plans.des')}}</label>
            <textarea id="des" name="des" rows="10" cols="80">{{old('des')}}</textarea>
          </div>
          <div class="form-group">
            <label for="des_ar">{{__('admindash.plans.des_ar')}}</label>
            <textarea id="des_ar" name="des_ar" rows="10" cols="80">{{old('des_ar')}}</textarea>
          </div>
          <div class="form-group col-md-12 novar">
            <label for="price">{{__('admindash.plans.price')}}</label>
            <input type="number" step="0.01" min="0" class="form-control"  value="{{old('price')}}" name="price" id="price">
          </div>
          <div class="form-group col-md-12 novar">
            <label for="salefee">{{__('admindash.plans.salefee')}}</label>
            <input type="number" min="1" step="0.01" class="form-control" name="salefee" value="{{old('salefee')}}" id="salefee">
          </div>
          <div class="form-group col-md-12 novar">
            <label for="minfee">{{__('admindash.plans.minfee')}}</label>
            <input type="number" step="0.01" min="0" class="form-control"  value="{{old('minfee')}}" name="minfee" id="minfee">
          </div>
          <div class="form-group col-md-12 novar">
            <label for="maxfee">{{__('admindash.plans.maxfee')}}</label>
            <input type="number" step="0.01" min="0" class="form-control"  value="{{old('maxfee')}}" name="maxfee" id="maxfee">
          </div>
          <div class="form-group col-md-12">
            <label >{{__('admindash.plans.product_priority')}}</label>
            <select class="form-control" id="product_priority" name="product_priority">
              <option value="0" {{old('variation')==0?'selected':''}}>0</option>
              <option value="1" {{old('variation')==1?'selected':''}}>1</option>
              <option value="2" {{old('variation')==2?'selected':''}}>2</option>
              <option value="3" {{old('variation')==3?'selected':''}}>3</option>
              <option value="4" {{old('variation')==4?'selected':''}}>4</option>
              <option value="5" {{old('variation')==5?'selected':''}}>5</option>
            </select>
          </div>
          <div class="form-group">
            <label for="badge">{{__('admindash.plans.badge')}}</label>
            <input type="file" class="form-control" id="badge" name="badge" accept="image/*" value="{{old('badge')}}">
          </div>
          <div class="form-group col-md-12 novar">
            <label for="product_limit">{{__('admindash.plans.product_limit')}}</label>
            <input type="number" step="1" min="1" class="form-control"  value="{{old('product_limit')}}" name="product_limit" id="product_limit">
          </div>
          <div class="form-group col-md-12 novar">
            <label for="trans_limit">{{__('admindash.plans.trans_limit')}}</label>
            <input type="number" step="1" min="1" class="form-control"  value="{{old('trans_limit')}}" name="trans_limit" id="trans_limit">
          </div>
          <div class="form-group col-md-12 novar">
            <label for="deleted_counter">{{__('admindash.plans.deleted_counter')}}</label>
            <input type="number" step="1" min="1" class="form-control"  value="{{old('deleted_counter')}}" name="deleted_counter" id="deleted_counter">
          </div>
          <div class="form-group col-md-12 novar">
            <label for="photo_limit">{{__('admindash.plans.photo_limit')}}</label>
            <select class="form-control"  name="photo_limit" id="photo_limit">
              <option value="1" {{old('photo_limit')==1?'selected':''}}>1</option>
              <option value="2" {{old('photo_limit')==2?'selected':''}}>2</option>
              <option value="3" {{old('photo_limit')==3?'selected':''}}>3</option>
              <option value="4" {{old('photo_limit')==4?'selected':''}}>4</option>
              <option value="5" {{old('photo_limit')==5?'selected':''}}>5</option>
            </select>
          </div>
          <div class="form-group col-md-12 novar">
            <label for="variations">{{__('admindash.plans.variations')}}</label>
            <select step="1" min="1" class="form-control"  name="variations" id="variations">
              <option value="0" {{old('variations')==0?'selected':''}}>{{__('admindash.constants.no')}}</option>
              <option value="1" {{old('variations')==1?'selected':''}}>{{__('admindash.constants.yes')}}</option>
            </select>
          </div>
          <div class="form-group col-md-12 novar">
            <label for="staff_accounts">{{__('admindash.plans.staff_accounts')}}</label>
            <input type="number" step="1" min="0" class="form-control"  value="{{old('staff_accounts')}}" name="staff_accounts" id="staff_accounts">
          </div>
          <div class="form-group col-md-12 novar">
            <label for="can_see_views">{{__('admindash.plans.can_see_views')}}</label>
            <select class="form-control"  name="can_see_views" id="can_see_views">
              <option value="0" {{old('can_see_views')==0?'selected':''}}>{{__('admindash.constants.no')}}</option>
              <option value="1" {{old('can_see_views')==1?'selected':''}}>{{__('admindash.constants.yes')}}</option>
            </select>
          </div>
          <div class="form-group col-md-12 novar">
            <label for="analytics">{{__('admindash.plans.analytics')}}</label>
            <select class="form-control"  name="analytics" id="analytics">
              <option value="0" {{old('analytics')==0?'selected':''}}>{{__('admindash.constants.no')}}</option>
              <option value="1" {{old('analytics')==1?'selected':''}}>{{__('admindash.constants.yes')}}</option>
            </select>
          </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn btn-primary">{{__('admindash.actions.submit')}}</button>
          <a href="{{route('plans.index')}}" class="btn btn-default">{{__('admindash.actions.cancel')}}</a>
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
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('des');
    CKEDITOR.replace('des_ar');
    CKEDITOR.replace('head_des');
    CKEDITOR.replace('head_des_ar');
});

</script>

@endpush
