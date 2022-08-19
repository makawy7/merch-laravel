

@extends('admin.layouts.layout')


@section('content')
<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">{{__('admindash.type.addtype')}}</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" action="{{route('type.update',$type->id)}}" method="post">
        @csrf
        <div class="box-body">
          <div class="form-group">
            <label for="name">{{__('admindash.type.type_name')}}</label>
            <input type="text" class="form-control" id="name" name="name" value="{{old('name')?old('name'):$type->name}}">
          </div>
          <div class="form-group">
            <label for="name_ar">{{__('admindash.type.type_name_ar')}}</label>
            <input type="text" class="form-control" id="name_ar" name="name_ar" value="{{old('name_ar')?old('name_ar'):$type->name_ar}}">
          </div>
          <div class="form-group">
            <div class="col-md-6">
              <label for="name_ar">{{__('admindash.type.maincat')}}</label>
              <select class="form-control" name="maincat_id" multiple="" id="maincatselect">
                @foreach($maincats as $maincat)
                  <option {{old('maincat_id')==$maincat->id?'selected':''}} {{!old('maincat_id') && $type->subcat->maincat->id==$maincat->id?'selected':''}} value="{{$maincat->id}}">{{$maincat->getName()}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-6">
              <label for="name_ar">{{__('admindash.type.subcat')}}</label>
              <select class="form-control" name="subcat_id" multiple="" id="subcatselect">
              </select>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
        <input type="hidden" name="_method" value="PUT">
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">{{__('admindash.actions.submit')}}</button>
          <a href="{{route('type.index')}}" class="btn btn-default">{{__('admindash.actions.cancel')}}</a>
        </div>
      </form>


      <!-- getting all sub categories -->
      @if(count($maincats)>0)
        @foreach($maincats as $maincat)
        <span id="subcats_{{$maincat->id}}" class="hide">
              @foreach($maincat->subcats as $subcat)
                <option {{old('subcat_id')==$subcat->id?'selected':''}} {{!old('subcat_id') && $type->subcat->id==$subcat->id?'selected':''}} value="{{$subcat->id}}">{{$subcat->getname()}}</option>
              @endforeach
          </span>
        @endforeach
      @endif

    </div>
    <!-- /.box -->

  </div>

</div>

@endsection


@push('scripts')
<script type="text/javascript">

$(document).ready(function(){
  //setting old selections from old()
   @if(old('maincat_id'))
    var cat={{old('maincat_id')}};
    $('#subcatselect').html('');
    $('#subcatselect').append($(`#subcats_${cat}`).html());
   @elseif(isset($type->subcat->maincat))
   var cat={{$type->subcat->maincat->id}};
   $('#subcatselect').html('');
   $('#subcatselect').append($(`#subcats_${cat}`).html());
   @endif
  //end setting old selections

  $('#maincatselect').on('change',()=>{
    var id=$('#maincatselect').val();
    $('#subcatselect').html('');
    $('#subcatselect').append($(`#subcats_${id}`).html());
    $("#subcatselect option:selected").removeAttr("selected");
  });
});

</script>

@endpush
