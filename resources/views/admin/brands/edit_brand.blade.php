

@extends('admin.layouts.layout')


@section('content')
<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">{{__('admindash.brand.addbrand')}}</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" action="{{route('brand.update',$brand->id)}}" method="post">
        @csrf
        <div class="box-body">
          <div class="form-group">
            <label for="name">{{__('admindash.brand.brand_name')}}</label>
            <input type="text" class="form-control" id="name" name="name" value="{{old('name')?old('name'):$brand->name}}">
          </div>
          <div class="form-group">
            <label for="name_ar">{{__('admindash.brand.brand_name_ar')}}</label>
            <input type="text" class="form-control" id="name_ar" name="name_ar" value="{{old('name_ar')?old('name_ar'):$brand->name_ar}}">
          </div>
          <div class="form-group">
            <div class="col-md-6">
              <label for="maincatselect">{{__('admindash.brand.maincat')}}</label>
              <select class="form-control" name="maincat_id" multiple="" id="maincatselect">
                @foreach($maincats as $maincat)
                  <option {{old('maincat_id')==$maincat->id?'selected':''}} {{!old('maincat_id') && $brand->type->subcat->maincat->id==$maincat->id?'selected':''}} value="{{$maincat->id}}">{{$maincat->getName()}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-6">
              <label for="subcatselect">{{__('admindash.brand.subcat')}}</label>
              <select class="form-control" name="subcat_id" multiple="" id="subcatselect">
              </select>
            </div>
            <div class="col-md-6">
              <label for="typeselect">{{__('admindash.brand.type')}}</label>
              <select class="form-control" name="type_id" multiple="" id="typeselect">
              </select>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
        <input type="hidden" name="_method" value="PUT">
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">{{__('admindash.actions.submit')}}</button>
          <a href="{{route('brand.index')}}" class="btn btn-default">{{__('admindash.actions.cancel')}}</a>
        </div>
      </form>


      @if(count($maincats)>0)
          <!-- getting all sub categories -->
          @foreach($maincats as $maincat)
          <span id="subcats_{{$maincat->id}}" class="hide">
              @foreach($maincat->subcats as $subcat)
                <option {{old('subcat_id')==$subcat->id?'selected':''}} {{!old('subcat_id') && $brand->type->subcat->id==$subcat->id?'selected':''}} value="{{$subcat->id}}">{{$subcat->getname()}}</option>
              @endforeach
          </span>
          <!-- getting all sub categories -->
          @foreach($maincat->subcats as $subcat)
          <span id="types_{{$subcat->id}}" class="hide">
            @foreach($subcat->types as $type)
            <option {{old('type_id')==$type->id?'selected':''}} {{!old('type_id') && $brand->type->id==$type->id?'selected':''}} value="{{$type->id}}">{{$type->getname()}}</option>
            @endforeach
          </span>
          @endforeach
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
    $('#typeselect').html('');
    $('#subcatselect').append($(`#subcats_${cat}`).html());
   @elseif(isset($brand->type->subcat->maincat->id))
    var cat={{$brand->type->subcat->maincat->id}};
    $('#subcatselect').html('');
    $('#typeselect').html('');
    $('#subcatselect').append($(`#subcats_${cat}`).html());
   @endif

   @if(old('subcat_id'))
    var cat={{old('subcat_id')}};
    $('#typeselect').html('');
    $('#typeselect').append($(`#types_${cat}`).html());
   @elseif(isset($brand->type->subcat->id))
    var cat={{$brand->type->subcat->id}};
    $('#typeselect').html('');
    $('#typeselect').append($(`#types_${cat}`).html());
   @endif
  //end setting old selections

  $('#maincatselect').on('change',()=>{
    var id=$('#maincatselect').val();
    $('#subcatselect').html('');
    $('#typeselect').html('');
    $('#subcatselect').append($(`#subcats_${id}`).html());
    // removing previous selections
    $("#subcatselect option:selected").removeAttr("selected");
    $("#typeselect option:selected").removeAttr("selected");
  });
});

//on sub cat change
$('#subcatselect').on('change',()=>{
  var id=$('#subcatselect').val();
  $('#typeselect').html('');
  $('#typeselect').append($(`#types_${id}`).html());
  // removing previous selections
  $("#typeselect option:selected").removeAttr("selected");
});

</script>

@endpush
