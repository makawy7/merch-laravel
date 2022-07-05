

@extends('admin.layouts.layout')


@section('content')
<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">{{__('admindash.product.extoptions')}}</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">

              @if(count($product->variations)==3)
                @foreach($product->variations[0]->options as $option1)
                    @foreach($product->variations[1]->options as $option2)
                      @foreach($product->variations[2]->options as $option3)
                        <div class="well col-md-12 text-center">
                          <div class="well col-md-2" style="display:inline">
                            <label>{{$product->variations[0]->getName()}}</label>
                            <input type="text" disabled class="form-control option text-center" data-id="{{$option1->id}}" value="{{$option1->getName()}}">
                          </div>
                          <div class="well col-md-2" style="display:inline">
                            <label>{{$product->variations[1]->getName()}}</label>
                            <input type="text" disabled class="form-control option text-center" data-id="{{$option2->id}}" value="{{$option2->getName()}}">
                          </div>
                          <div class="well col-md-2" style="display:inline">
                            <label>{{$product->variations[2]->getName()}}</label>
                            <input type="text" disabled class="form-control option text-center" data-id="{{$option3->id}}" value="{{$option3->getName()}}">
                          </div>
                          @php $ids=$option1->id.','.$option2->id.','.$option3->id;@endphp
                          <div class="well col-md-2" style="display:inline">
                            <label>{{__('admindash.product.price')}}</label>
                            <input type="number" min="0" step="0.01" {{$product->getextoptions($ids)?'disabled':''}} class="form-control name text-center price" value="{{$product->getextoptions($ids)?$product->getextoptions($ids)['price']:''}}">
                            <small class="text-danger hide pricewarning">Please Enter Price</small>
                          </div>
                          <div class="well col-md-2" style="display:inline">
                            <label>{{__('admindash.product.quantity')}}</label>
                            <input type="number" min="0"  step="1" {{$product->getextoptions($ids)?'disabled':''}} class="form-control name text-center quantity" value="{{$product->getextoptions($ids)?$product->getextoptions($ids)['quantity']:''}}">
                            <small class="text-danger hide quantitywarning">Please Enter Quantity</small>
                          </div>
                          <div class="well col-md-2" style="display:inline">
                            <label>{{__('admindash.product.picture')}}</label>
                            <input type="file" {{$product->getextoptions($ids)?'disabled':''}} style="width:100%" class="image" data-id="1" name="" value="">
                            <img src="{{$product->getextoptions($ids)?url('storage/images/products/'.$product->getextoptions($ids)['image']):''}}" class="imagevalue {{$product->getextoptions($ids)?'':'hide'}}" width="150px" alt="">
                          </div>
                          <div class="well col-md-2" style="display:inline">
                            <label style="display:block">{{__('admindash.actions.operations')}}</label>
                            @if($product->getextoptions($ids))
                            <input type="submit" class="form-control btn btn-success edit" value="{{__('admindash.actions.edit')}}">
                            <input type="submit" class="form-control btn btn-primary hide doedit" data-id="{{$product->getextoptions($ids)['id']}}"  value="{{__('admindash.actions.submit')}}">
                            @else
                            <input type="submit" class="form-control btn btn-primary save" value="{{__('admindash.actions.submit')}}">
                            @endif
                          </div>
                        </div>
                      @endforeach
                    @endforeach
                @endforeach
              @elseif(count($product->variations)==2)
                  @foreach($product->variations[0]->options as $option1)
                      @foreach($product->variations[1]->options as $option2)
                          <div class="well col-md-12 text-center">
                            <div class="well col-md-2" style="display:inline">
                              <label>{{$product->variations[0]->getName()}}</label>
                              <input type="text" disabled class="form-control option text-center" data-id="{{$option1->id}}" value="{{$option1->getName()}}">
                            </div>
                            <div class="well col-md-2" style="display:inline">
                              <label>{{$product->variations[1]->getName()}}</label>
                              <input type="text" disabled class="form-control option text-center" data-id="{{$option2->id}}" value="{{$option2->getName()}}">
                            </div>
                            @php $ids=$option1->id.','.$option2->id;@endphp
                            <div class="well col-md-2" style="display:inline">
                              <label>{{__('admindash.product.price')}}</label>
                              <input type="number" min="0" step="0.01" {{$product->getextoptions($ids)?'disabled':''}} class="form-control name text-center price" value="{{$product->getextoptions($ids)?$product->getextoptions($ids)['price']:''}}">
                              <small class="text-danger hide pricewarning">Please Enter Price</small>
                            </div>
                            <div class="well col-md-2" style="display:inline">
                              <label>{{__('admindash.product.quantity')}}</label>
                              <input type="number" min="0"  step="1" {{$product->getextoptions($ids)?'disabled':''}} class="form-control name text-center quantity" value="{{$product->getextoptions($ids)?$product->getextoptions($ids)['quantity']:''}}">
                              <small class="text-danger hide quantitywarning">Please Enter Quantity</small>
                            </div>
                            <div class="well col-md-2" style="display:inline">
                              <label>{{__('admindash.product.picture')}}</label>
                              <input type="file" {{$product->getextoptions($ids)?'disabled':''}} style="width:100%" class="image" data-id="1" name="" value="">
                              <img src="{{$product->getextoptions($ids)?url('storage/images/products/'.$product->getextoptions($ids)['image']):''}}" class="imagevalue {{$product->getextoptions($ids)?'':'hide'}}" width="150px" alt="">
                            </div>
                            <div class="well col-md-2" style="display:inline">
                              <label style="display:block">{{__('admindash.actions.operations')}}</label>
                              @if($product->getextoptions($ids))
                              <input type="submit" class="form-control btn btn-success edit" value="{{__('admindash.actions.edit')}}">
                              <input type="submit" class="form-control btn btn-primary hide doedit" data-id="{{$product->getextoptions($ids)['id']}}"  value="{{__('admindash.actions.submit')}}">
                              @else
                              <input type="submit" class="form-control btn btn-primary save" value="{{__('admindash.actions.submit')}}">
                              @endif
                            </div>
                          </div>
                      @endforeach
                  @endforeach
              @elseif(count($product->variations)==1)
                  @foreach($product->variations[0]->options as $option1)
                        <div class="well col-md-12 text-center">
                          <div class="well col-md-2" style="display:inline">
                            <label>{{$product->variations[0]->getName()}}</label>
                            <input type="text" disabled class="form-control option text-center" data-id="{{$option1->id}}" value="{{$option1->getName()}}">
                          </div>
                          @php $ids=$option1->id;@endphp
                          <div class="well col-md-2" style="display:inline">
                            <label>{{__('admindash.product.price')}}</label>
                            <input type="number" min="0" step="0.01" {{$product->getextoptions($ids)?'disabled':''}} class="form-control name text-center price" value="{{$product->getextoptions($ids)?$product->getextoptions($ids)['price']:''}}">
                            <small class="text-danger hide pricewarning">Please Enter Price</small>
                          </div>
                          <div class="well col-md-2" style="display:inline">
                            <label>{{__('admindash.product.quantity')}}</label>
                            <input type="number" min="0"  step="1" {{$product->getextoptions($ids)?'disabled':''}} class="form-control name text-center quantity" value="{{$product->getextoptions($ids)?$product->getextoptions($ids)['quantity']:''}}">
                            <small class="text-danger hide quantitywarning">Please Enter Quantity</small>
                          </div>
                          <div class="well col-md-2" style="display:inline">
                            <label>{{__('admindash.product.picture')}}</label>
                            <input type="file" {{$product->getextoptions($ids)?'disabled':''}} style="width:100%" class="image" data-id="1" name="" value="">
                            <img src="{{$product->getextoptions($ids)?url('storage/images/products/'.$product->getextoptions($ids)['image']):''}}" class="imagevalue {{$product->getextoptions($ids)?'':'hide'}}" width="150px" alt="">
                          </div>
                          <div class="well col-md-2" style="display:inline">
                            <label style="display:block">{{__('admindash.actions.operations')}}</label>
                            @if($product->getextoptions($ids))
                            <input type="submit" class="form-control btn btn-success edit" value="{{__('admindash.actions.edit')}}">
                            <input type="submit" class="form-control btn btn-primary hide doedit" data-id="{{$product->getextoptions($ids)['id']}}" value="{{__('admindash.actions.submit')}}">
                            @else
                            <input type="submit" class="form-control btn btn-primary save" value="{{__('admindash.actions.submit')}}">
                            @endif
                          </div>
                        </div>
                  @endforeach
              @endif

              @if(count($product->variations[0]->options)==0)
                    <h4 class="text-center text-danger">{{__('admindash.messages.nooptionswarning')}}</h4>
              @endif
      </div>
      <div class="box-footer">
        <a href="{{route('productminmax',$product->id)}}" type="button" name="button" class="btn btn-primary">{{__('admindash.actions.finish')}}</a>
        <a href="{{route('add.options',$product->id)}}" type="button" name="button" class="btn btn-default">{{__('admindash.actions.back')}}</a>
      </div>
    </div>
    <!-- /.box -->

  </div>

</div>

@endsection


@push('scripts')
<script type="text/javascript">

$(document).ready(function(){

////////////////////////////////////////////////////BASE64 IMAGES//////////////////////////////////////////

function getBase64(file) {
  return new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => resolve(reader.result);
    reader.onerror = error => reject(error);
  });
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$('.image').on('change',function(){
  var image=$(this).get(0).files[0];
  getBase64(image).then(
      data=>$(this).parent().find('.imagevalue').attr('src',data)
    ).then(
      $(this).parent().find('.imagevalue').removeClass('hide')
    );
});


////////////////////////////////////////////Add New ExtOption/////////////////////////////////////////////

  $('body').on('click','.save',function(){
    var ids='';
    var price=$(this).parent().parent().find('.price').val();
    var quantity=$(this).parent().parent().find('.quantity').val();
    var image=$(this).parent().parent().find('.imagevalue').attr('src');

    var priceError=false;
    var quantityError=false;
    var self=this;

    $(this).parent().parent().find('.option').each(function(){
      ids+=$(this).data('id')+',';
    });
    ids=ids.replace(/,+$/,'');
    if(price==''){
      $(this).parent().parent().find('.pricewarning').removeClass('hide');
      priceError=true;
    }else {
      if(!$(this).parent().parent().find('.pricewarning').hasClass('hide')){
        $(this).parent().parent().find('.pricewarning').addClass('hide');
      }
    }
    if(quantity==''){
      $(this).parent().parent().find('.quantitywarning').removeClass('hide');
      quantityError=true;
    }else {
      if(!$(this).parent().parent().find('.quantitywarning').hasClass('hide')){
        $(this).parent().parent().find('.quantitywarning').addClass('hide');
      }
    }

    if(priceError==false && quantityError==false){
      $.ajax({
        url:`{{route('store.extoption')}}`,
        method:'post',
        data:{price:price,quantity:quantity,image:image,product_id:`{{$product->id}}`,ids:ids,_token:`{{csrf_token()}}`},
        success:function(data){
          $(self).parent().parent().find('.price').attr('disabled','disabled');
          $(self).parent().parent().find('.quantity').attr('disabled','disabled');
          $(self).parent().parent().find('.image').attr('disabled','disabled');
          $(self).parent().append(`
            <input type="submit" class="form-control btn btn-success edit" value="{{__('admindash.actions.edit')}}">
            <input type="submit" class="form-control btn btn-primary hide doedit" data-id="${data.id}" value="{{__('admindash.actions.submit')}}">`);
            $(self).remove();
        },
        error:function(){
          alert('something went wrong');
        }
      });

    }
  });



///////////////////////////////////////////////// Edit //////////////////////////////////////////////////////

  $('body').on('click','.edit',function(){
    $(this).addClass('hide');
    $(this).parent().find('.doedit').removeClass('hide');
    $(this).parent().parent().find('.price').removeAttr('disabled');
    $(this).parent().parent().find('.quantity').removeAttr('disabled');
    $(this).parent().parent().find('.image').removeAttr('disabled');
  });

  $('body').on('click','.doedit',function(){

    var extoptionId=$(this).data('id');
    var price=$(this).parent().parent().find('.price').val();
    var quantity=$(this).parent().parent().find('.quantity').val();
    var image=$(this).parent().parent().find('.imagevalue').attr('src');

    var priceError=false;
    var quantityError=false;
    var self=this;
    if(price==''){
      $(this).parent().parent().find('.pricewarning').removeClass('hide');
      priceError=true;
    }else {
      if(!$(this).parent().parent().find('.pricewarning').hasClass('hide')){
        $(this).parent().parent().find('.pricewarning').addClass('hide');
      }
    }
    if(quantity==''){
      $(this).parent().parent().find('.quantitywarning').removeClass('hide');
      quantityError=true;
    }else {
      if(!$(this).parent().parent().find('.quantitywarning').hasClass('hide')){
        $(this).parent().parent().find('.quantitywarning').addClass('hide');
      }
    }

    if(priceError==false && quantityError==false){
      $.ajax({
        url:`{{route('update.extoption')}}`,
        method:'put',
        data:{price:price,quantity:quantity,image:image,id:extoptionId,_token:`{{csrf_token()}}`},
        success:function(data){
          $(self).parent().parent().find('.price').attr('disabled','disabled');
          $(self).parent().parent().find('.quantity').attr('disabled','disabled');
          $(self).parent().parent().find('.image').attr('disabled','disabled');
          $(self).addClass('hide');
          $(self).parent().find('.edit').removeClass('hide');
        },
        error:function(){
          alert('something went wrong');
        }
      });

    }
  });
});


</script>

@endpush
