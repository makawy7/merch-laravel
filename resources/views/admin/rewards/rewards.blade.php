
@extends('admin.layouts.layout')


@section('content')
<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">{{__('admindash.rewards.rewards')}}</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" action="{{route('storerewards')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="box-body">
            <h4>{{__('admindash.rewards.email')}}</h4>
            <div class="thumbnail">
              <div class="form-group">
                <label for="email">{{__('admindash.rewards.active')}}</label>
                <input type="radio" id="email" {{$reward->email==1?'checked':''}} value="1" name="emailactive">
              </div>
              <div class="form-group">
                <label for="email">{{__('admindash.rewards.disabled')}}</label>
                <input type="radio" id="email" {{$reward->email==0?'checked':''}} value="0" name="emailactive">
              </div>
              <div class="form-group">
                <label for="emailpoints">{{__('admindash.rewards.points')}}</label>
                <input type="number" step="1" min="0" id="emailpoints" class="form-control" value="{{$reward->email_points}}" name="emailpoints">
              </div>
            </div>
            <h4>{{__('admindash.rewards.phone')}}</h4>
            <div class="thumbnail">
              <div class="form-group">
                <label for="phone">{{__('admindash.rewards.active')}}</label>
                <input type="radio" id="phone" value="1" {{$reward->phone==1?'checked':''}} name="phoneactive">
              </div>
              <div class="form-group">
                <label for="phone">{{__('admindash.rewards.disabled')}}</label>
                <input type="radio" id="phone" value="0" {{$reward->phone==0?'checked':''}} name="phoneactive">
              </div>
              <div class="form-group">
                <label for="phonepoints">{{__('admindash.rewards.points')}}</label>
                <input type="number" step="1" min="0" id="phonepoints" class="form-control" value="{{$reward->phone_points}}" name="phonepoints">
              </div>
            </div>
            <h4>{{__('admindash.rewards.review')}}</h4>
            <div class="thumbnail">
              <div class="form-group">
                <label for="review">{{__('admindash.rewards.active')}}</label>
                <input type="radio" id="review" value="1" {{$reward->review==1?'checked':''}} name="reviewactive">
              </div>
              <div class="form-group">
                <label for="review">{{__('admindash.rewards.disabled')}}</label>
                <input type="radio" id="review" value="0" {{$reward->review==0?'checked':''}} name="reviewactive">
              </div>
              <div class="form-group">
                <label for="reviewpoints">{{__('admindash.rewards.points')}}</label>
                <input type="number" step="1" min="0" id="reviewpoints" class="form-control" value="{{$reward->phone_points}}" name="reviewpoints">
              </div>
            </div>
            <h4>{{__('admindash.rewards.product')}}</h4>
            <div class="thumbnail">
              <div class="form-group">
                <label for="product">{{__('admindash.rewards.active')}}</label>
                <input type="radio" id="product" value="1" {{$reward->product==1?'checked':''}} name="productactive">
              </div>
              <div class="form-group">
                <label for="product">{{__('admindash.rewards.disabled')}}</label>
                <input type="radio" id="product" value="0" {{$reward->product==0?'checked':''}} name="productactive">
              </div>
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

});


</script>

@endpush
