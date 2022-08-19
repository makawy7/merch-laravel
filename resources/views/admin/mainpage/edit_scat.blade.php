
@extends('admin.layouts.layout')


@section('content')
<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">{{__('admindash.mainpage.editscat')}}</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" action="{{route('updatescat',$scat->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="box-body">
              <div class="form-group">
                <label for="bannertitle">{{__('admindash.mainpage.scat_name')}}</label>
                <input type="text" id="bannertitle"  class="form-control" value="{{old('title')?old('title'):$scat->title}}" name="title">
              </div>
              <div class="form-group">
                <label for="bannertitle_ar">{{__('admindash.mainpage.scat_name_ar')}}</label>
                <input type="text" id="bannertitle_ar"  class="form-control" value="{{old('title_ar')?old('title_ar'):$scat->title_ar}}" name="title_ar">
              </div>
              <div class="form-group">
                <label for="bannerimage">{{__('admindash.mainpage.image')}}</label>
                <input type="file" id="bannerimage" accept="image/*"  class="form-control" name="image">
              </div>
              <div class="form-group">
                <label for="bannerlink">{{__('admindash.mainpage.link')}}</label>
                <input type="url" id="bannerlink" class="form-control" value="{{old('url')?old('url'):$scat->url}}" name="url">
              </div>
            </div>

        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn btn-primary">{{__('admindash.actions.submit')}}</button>
          <a href="{{route('scats')}}" class="btn btn-default">{{__('admindash.actions.cancel')}}</a>
      </form>
        </div>

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
