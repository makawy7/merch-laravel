

@extends('seller.layouts.layout')


@section('content')
<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">{{__('admindash.product.addproductvariation')}}</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->

        @csrf
        <div class="box-body">
          <div class="form-group">
            <button type="button" name="button" class="btn btn-default addnewvariation">{{__('admindash.product.addnewvariation')}}</button>
          </div>
          @if(count($product->variations)>0)
            @foreach($product->variations as $variation)
              <div class="well" >
                <div class="form-group">
                  <label for="">{{__('admindash.product.variation_name')}}</label>
                  <input type="text" class="form-control name" disabled value="{{$variation->name}}">
                  <small class="text-danger name_warning">{{__('admindash.product.variation_name_required')}}</small>
                </div>
                <div class="form-group">
                  <label for="">{{__('admindash.product.variation_name_ar')}}</label>
                  <input type="text" class="form-control name_ar" disabled value="{{$variation->name_ar}}">
                  <small class="text-danger name_ar_warning">{{__('admindash.product.variation_name_ar_required')}}</small>
                </div>
                <div class="form-group">
                  <button type="button" name="button" data-id="{{$variation->id}}" class="btn btn-danger delete">{{__('admindash.actions.delete')}}</button>
                  <button type="button" name="button"  class="btn btn-primary edit">{{__('admindash.actions.edit')}}</button>
                  <button type="button" name="button" data-id="{{$variation->id}}" class="btn btn-success doedit">{{__('admindash.actions.submit')}}</button>
                </div>
              </div>
            @endforeach
          @else
            <div class="well" >
              <div class="form-group">
                <label for="">{{__('admindash.product.variation_name')}}</label>
                <input type="text" class="form-control name" required name="name">
                <small class="text-danger name_warning">{{__('admindash.product.variation_name_required')}}</small>
              </div>
              <div class="form-group">
                <label for="">{{__('admindash.product.variation_name_ar')}}</label>
                <input type="text" class="form-control name_ar" required name="name_ar">
                <small class="text-danger name_ar_warning">{{__('admindash.product.variation_name_ar_required')}}</small>
              </div>
              <div class="from-group">
                <button type="button" name="button" data-product={{$product->id}} class="btn btn-success save">{{__('admindash.actions.submit')}}</button>
              </div>
            </div>
          @endif
        </div>
        <!-- /.box-body -->

        <input type="hidden" name="product" value="{{$product->id}}">
        <div class="box-footer">
          <a href="{{route('seller.add.options',$product->id)}}" class="btn btn-primary">{{__('admindash.actions.next')}}</a>
        </div>



    </div>
    <!-- /.box -->

  </div>

</div>

@endsection


@push('scripts')
<script type="text/javascript">

$(document).ready(function(){
//initializing fields
$('.doedit').hide();
$('.name_warning').hide();
$('.name_ar_warning').hide();

@if(count($product->variations)>=3)
  $('.addnewvariation').hide();
@endif


var counter=1;

$('.addnewvariation').on('click',function(){
  counter++;
  $(this).parent().parent().append(`
            <div class="well" >
                <div class="form-group">
                  <label for="">{{__('admindash.product.variation_name')}}</label>
                  <input type="text" class="form-control name" required name="name">
                  <small class="text-danger name_warning">{{__('admindash.product.variation_name_required')}}</small>
                </div>
                <div class="form-group">
                  <label for="">{{__('admindash.product.variation_name_ar')}}</label>
                  <input type="text" class="form-control name_ar" required name="name_ar">
                  <small class="text-danger name_ar_warning">{{__('admindash.product.variation_name_ar_required')}}</small>
                </div>
                <div class="from-group">
                  <button type="button" name="button" data-product={{$product->id}} class="btn btn-success save">{{__('admindash.actions.submit')}}</button>
                </div>
            </div>`);

  if($('.well').length>=3){
    $(this).hide();
  }
  $('.name_warning').hide();
  $('.name_ar_warning').hide();
});

$('body').on('click','.close',function(){
  $(this).parent().remove();
  counter--;
  $('.addnewvariation').show();
});


/////////////////////////////////////////////Store Variation///////////////////////////////////////////

  $('body').on('click','.save',function(){
    var product_id=$(this).data('product');
    var name=$(this).parent().parent().find('.name').val();
    var name_ar=$(this).parent().parent().find('.name_ar').val();
    var self=this;
    var nameError=false;
    var nameArError=false;
    if(name==''){
      nameError=true;
      $('.name_warning').show();
    }else {
      $('.name_warning').hide();
    }
    if(name_ar==''){
      nameArError=true;
      $('.name_ar_warning').show();
    }else {
      $('.name_ar_warning').hide();
    }

    if(nameError==false && nameArError==false){
      $.ajax({
        url:`{{route('seller.store.variation')}}`,
        method:'post',
        data:{product_id:product_id,name:name,name_ar:name_ar,_token:`{{csrf_token()}}`},
        success:function(data){
          console.log(data);
          $(self).parent().parent().find('input').attr('disabled','disabled');
          $(self).parent().append(`
            <button type="button" name="button" data-id="${data.id}" class="btn btn-danger delete">{{__('admindash.actions.delete')}}</button>
            <button type="button" name="button"  class="btn btn-primary edit">{{__('admindash.actions.edit')}}</button>
            <button type="button" name="button" data-id="${data.id}" class="btn btn-success doedit">{{__('admindash.actions.submit')}}</button>`);
          $(self).parent().find('.doedit').hide();
          $(self).remove();
        },
        error:function(){
          alert('something went wrong!');
        }
      });
    }

  });



  /////////////////////////////////////////////Update Variation///////////////////////////////////////////

  $('body').on('click','.edit',function(){
    $(this).hide();
    $(this).parent().find('.delete').hide();
    $(this).parent().find('.doedit').show();
    $(this).parent().parent().find('input').removeAttr('disabled');
  });

  $('body').on('click','.doedit',function(){
    var name=$(this).parent().parent().find('.name').val();
    var name_ar=$(this).parent().parent().find('.name_ar').val();
    var id=$(this).data('id');
    var self=this;
    var nameError=false;
    var nameArError=false;

    if(name==''){
      nameError=true;
      $('.name_warning').show();
    }else {
      $('.name_warning').hide();
    }
    if(name_ar==''){
      nameArError=true;
      $('.name_ar_warning').show();
    }else {
      $('.name_ar_warning').hide();
    }

    if(nameError==false && nameArError==false){
      $.ajax({
        url:`{{route('seller.update.variation')}}`,
        method:'put',
        data:{id:id,name:name,name_ar:name_ar,_token:`{{csrf_token()}}`},
        success:function(data){
          $(self).hide();
          $(self).parent().find('.edit').show();
          $(self).parent().find('.delete').show();
          $(self).parent().parent().find('input').attr('disabled','disabled');
        },
        error:function(){
          alert('something went wrong!');
        }
      });
    }
  });


/////////////////////////////////////////////Delete Variation///////////////////////////////////////////


  $('body').on('click','.delete',function(){
    var id=$(this).data('id');
    var self=this;
    $.ajax({
      url:`{{route('seller.delete.variation')}}`,
      method:'delete',
      data:{id:id,_token:`{{csrf_token()}}`},
      success:function(data){
        $(self).parent().parent().remove();
        $('.addnewvariation').show();
      },
      error:function(){
        alert('something went wrong!');
      }
    });
  });


});


</script>

@endpush
