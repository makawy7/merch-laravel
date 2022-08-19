

@extends('admin.layouts.layout')


@section('content')
<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">{{__('admindash.product.options')}}</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        @if(count($product->variations)>0)
          @foreach($product->variations as $variation)
            <div class="well col-md-4 text-center">
              <label>{{$variation->getName()}}</label>
              <div class="form-group well var_{{$variation->id}}" data-id="{{$variation->id}}">
                <input type="text" class="form-control name" value="" placeholder="{{__('admindash.product.option_name')}}">
                <small class="text-danger name_warning hide">{{__('admindash.product.option_name_required')}}</small>
                <input type="text" class="form-control name_ar" value="" placeholder="{{__('admindash.product.option_name_ar')}}">
                <small class="text-danger name_ar_warning hide">{{__('admindash.product.option_name_ar_required')}}</small>
                <input type="button" name="button" class="btn btn-primary form-control addoption" value="{{__('admindash.actions.add')}}">
              </div>
              @foreach($variation->options as $option)
                <div class="form-group well" data-optionid="{{$option->id}}">
                  <input type="text" disabled class="form-control name text-center" value="{{$option->name}}">
                  <small class="text-danger name_warning hide">{{__('admindash.product.option_name_required')}}</small>
                  <input type="text" disabled class="form-control name_ar text-center" value="{{$option->name_ar}}">
                  <small class="text-danger name_ar_warning hide">{{__('admindash.product.option_name_ar_required')}}</small>
                  <input type="button" name="button" class="btn btn-primary editoption" style="width: 49%" value="{{__('admindash.actions.edit')}}">
                  <input type="button" name="button" class="btn btn-danger deleteoption" style="width: 49%" value="{{__('admindash.actions.delete')}}">
                  <input type="button" name="button" class="btn bg-olive form-control doeditoption hide" value="{{__('admindash.actions.submit')}}">
                </div>
              @endforeach
            </div>
          @endforeach
        @else
          <h4 class="text-center text-danger">{{__('admindash.messages.novariationswarning')}}</h4>
        @endif
      </div>
      <div class="box-footer">
        @if(count($product->variations)!=0)
        <a href="{{route('add.extoption',$product->id)}}" type="button" name="button" class="btn btn-primary">{{__('admindash.actions.next')}}</a>
        @endif
        <a href="{{route('add.variation',$product->id)}}" type="button" name="button" class="btn btn-default">{{__('admindash.actions.back')}}</a>
      </div>
    </div>
    <!-- /.box -->

  </div>

</div>

@endsection


@push('scripts')
<script type="text/javascript">

$(document).ready(function(){

/////////////////////////////////////////////Add Option/////////////////////////////////////////////////

$('body').on('click','.addoption',function(){
  var id=$(this).parent().data('id');
  var name=$(this).parent().find('.name').val();
  var name_ar=$(this).parent().find('.name_ar').val();
  var self=this;
  var nameError=false;
  var nameArError=false;
  //warning messages
  if(name==''){
    if($(this).parent().find('.name_warning').hasClass('hide')){
      $(this).parent().find('.name_warning').removeClass('hide');
    }
    nameError=true;
  }else {
    if(!$(this).parent().find('.name_warning').hasClass('hide')){
      $(this).parent().find('.name_warning').addClass('hide');
    }
  }
  if(name_ar==''){
    if($(this).parent().find('.name_ar_warning').hasClass('hide')){
      $(this).parent().find('.name_ar_warning').removeClass('hide');
    }
    nameError=true;
  }else {
    if(!$(this).parent().find('.name_ar_warning').hasClass('hide')){
      $(this).parent().find('.name_ar_warning').addClass('hide');
    }
  }

  if(nameError==false && nameArError==false){
    $.ajax({
      url:`{{route('var.addoptions')}}`,
      method:'post',
      data:{id:id,name:name,name_ar:name_ar,_token:`{{csrf_token()}}`},
      success:function(data){
        $(self).parent().find('.name').val('');
        $(self).parent().find('.name_ar').val('');
        $(self).parent().parent().append(`
          <div class="form-group well" data-optionid="${data.id}">
            <input type="text" disabled class="form-control name text-center" value="${data.name}">
            <small class="text-danger name_warning hide">{{__('admindash.product.option_name_required')}}</small>
            <input type="text" disabled class="form-control name_ar text-center" value="${data.name_ar}">
            <small class="text-danger name_ar_warning hide">{{__('admindash.product.option_name_ar_required')}}</small>
            <input type="button" name="button" class="btn btn-primary editoption" style="width: 49%" value="{{__('admindash.actions.edit')}}">
            <input type="button" name="button" class="btn btn-danger deleteoption" style="width: 49%" value="{{__('admindash.actions.delete')}}">
            <input type="button" name="button" class="btn bg-olive form-control doeditoption hide" value="{{__('admindash.actions.submit')}}">
          </div>`);
      },
      error:function(){
        alert('Something Went Wrong');
      }
    });
  }

});


//////////////////////////////////////////////////Delete Options///////////////////////////////////////////////////////////

$('body').on('click','.deleteoption',function(){
    var optionId=$(this).parent().data('optionid');
    var self=this;
    $.ajax({
      url:`{{route('var.removeoptions')}}`,
      method:'delete',
      data:{id:optionId,_token:`{{csrf_token()}}`},
      success:function(data){
        $(self).parent().remove();
      },
      error:function(){
        alert('Something Went Wrong');
      }
    });
});

//////////////////////////////////////////Edit Options//////////////////////////////////////////////////////

$('body').on('click','.editoption',function(){
  $(this).addClass('hide');
  $(this).parent().find('.deleteoption').addClass('hide');
  $(this).parent().find('.doeditoption').removeClass('hide');
  $(this).parent().find('input').removeAttr('disabled');
});


$('body').on('click','.doeditoption',function(){
  var id=$(this).parent().data('optionid');
  var name=$(this).parent().find('.name').val();
  var name_ar=$(this).parent().find('.name_ar').val();
  var self=this;

  var nameError=false;
  var nameArError=false;
  //warning messages
  if(name==''){
    if($(this).parent().find('.name_warning').hasClass('hide')){
      $(this).parent().find('.name_warning').removeClass('hide');
    }
    nameError=true;
  }else {
    if(!$(this).parent().find('.name_warning').hasClass('hide')){
      $(this).parent().find('.name_warning').addClass('hide');
    }
  }
  if(name_ar==''){
    if($(this).parent().find('.name_ar_warning').hasClass('hide')){
      $(this).parent().find('.name_ar_warning').removeClass('hide');
    }
    nameError=true;
  }else {
    if(!$(this).parent().find('.name_ar_warning').hasClass('hide')){
      $(this).parent().find('.name_ar_warning').addClass('hide');
    }
  }

  if(nameError==false && nameArError==false){
    $.ajax({
      url:`{{route('var.updateoptions')}}`,
      method:'put',
      data:{id:id,name:name,name_ar:name_ar,_token:`{{csrf_token()}}`},
      success:function(data){
        $(self).parent().find('.name').val(`${data.name}`);
        $(self).parent().find('.name_ar').val(`${data.name_ar}`);
        $(self).parent().find('.name').attr("disabled", "disabled");
        $(self).parent().find('.name_ar').attr("disabled", "disabled");
        $(self).addClass('hide');
        $(self).parent().find('.deleteoption').removeClass('hide');
        $(self).parent().find('.editoption').removeClass('hide');
      },
      error:function(){
        alert('Something Went Wrong');
      }
    });
  }

});

});


</script>

@endpush
