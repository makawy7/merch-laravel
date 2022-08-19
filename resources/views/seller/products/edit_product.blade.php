

@extends('seller.layouts.layout')


@section('content')
<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">{{__('admindash.product.addproduct')}}</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" action="{{route('seller.product.update',$product->id)}}" method="post">
        @csrf
        <div class="box-body">
          <div class="form-group">
            <label for="name">{{__('admindash.product.product_name')}}</label>
            <input type="text" class="form-control" id="name" name="title" value="{{old('title')?old('title'):$product->title}}">
          </div>
          <div class="form-group">
            <label for="name_ar">{{__('admindash.product.product_name_ar')}}</label>
            <input type="text" class="form-control" id="name_ar" name="title_ar" value="{{old('title_ar')?old('title_ar'):$product->title_ar}}">
          </div>
          <div class="form-group col-md-12">
            <div class="col-md-6">
              <label for="maincatselect">{{__('admindash.product.maincat')}}</label>
              <select class="form-control" name="maincat_id" multiple="" id="maincatselect">
                @foreach($maincats as $maincat)
                  <option {{old('maincat_id')==$maincat->id?'selected':''}} {{!old('maincat_id') && $product->type->subcat->maincat->id==$maincat->id?'selected':''}} value="{{$maincat->id}}">{{$maincat->getName()}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-6">
              <label for="subcatselect">{{__('admindash.product.subcat')}}</label>
              <select class="form-control" name="subcat_id" multiple="" id="subcatselect">
              </select>
            </div>
            <div class="col-md-6">
              <label for="typeselect">{{__('admindash.product.type')}}</label>
              <select class="form-control" name="type_id" multiple="" id="typeselect">
              </select>
            </div>
          </div>
          <div class="form-group">
              <label for="typeselect">{{__('admindash.product.brand')}}</label>
              <select class="form-control" name="brand_id" id="brandselect"></select>
          </div>
          <div class="form-group">
            <label for="head_des">{{__('admindash.product.head_des')}}</label>
            <textarea id="head_des" name="head_des" rows="10" cols="80">{{old('head_des')?old('head_des'):json_decode($product->head_des)}}</textarea>
          </div>
          <div class="form-group">
            <label for="head_des_ar">{{__('admindash.product.head_des_ar')}}</label>
            <textarea id="head_des_ar" name="head_des_ar" rows="10" cols="80">{{old('head_des_ar')?old('head_des_ar'):json_decode($product->head_des_ar)}}</textarea>
          </div>
          <div class="form-group">
            <label for="des">{{__('admindash.product.des')}}</label>
            <textarea id="des" name="des" rows="10" cols="80">{{old('des')?old('des'):json_decode($product->des)}}</textarea>
          </div>
          <div class="form-group">
            <label for="des_ar">{{__('admindash.product.des_ar')}}</label>
            <textarea id="des_ar" name="des_ar" rows="10" cols="80">{{old('des_ar')?old('des_ar'):json_decode($product->des_ar)}}</textarea>
          </div>

          <!-- product picture -->
          <div class="form-group">
              <label class="col-md-12">{{__('admindash.product.images')}}</label>
              <div class="col-md-4"></div>
              <div class="col-md-4 hide" id="croppiecontainer">
                <div class="row">
                  <div id="croppieitem" style="width:600;height:400;" ></div>
                </div>
                <div class="row  d-flex justify-content-center">
                  <button id="saveavatar" type="button" name="button" class="btn btn-default content-center">{{__('admindash.actions.submit')}}</button>
                  <button id="croppiecancel" type="button" name="button" class="btn btn-default">{{__('admindash.actions.cancel')}}</button>
                </div>

              </div>
              <div class="col-md-4"></div>
              <div class="col-md-12">
                  <input id="avatar" type="file" class="form-control" accept="image/*">
                  <small id="wrongfiletype" class="text-danger hide">Please choose correct image type!</small>
                  <div class="col-sm-12" id="preview">

                  </div>
              </div>
          </div>
          <div class="form-group col-md-12">
            <label for="tags">{{__('admindash.product.tags')}}</label>
            <input type="text" id="tags" name="tags" data-role="tagsinput" value="{{old('tags')?old('tags'):$product->tags}}">
          </div>
          <div class="form-group col-md-12">
            <label >{{__('admindash.product.variation')}}</label>
            <select class="form-control" id="variation" name="variation">
              <option value="0" {{old('variation')==0?'selected':''}}>{{__('admindash.product.novariation')}}</option>
              <option value="1" {{old('variation')==1?'selected':''}} {{!old('variation') && count($product->variations)>0?'selected':''}}>{{__('admindash.product.withvariation')}}</option>
            </select>
          </div>
          <div class="form-group col-md-12 novar">
            <label for="price">{{__('admindash.product.price')}}</label>
            <input type="number" step="0.01" min="0" class="form-control"  value="{{old('price')?old('price'):$product->price}}" name="price" id="price">
          </div>
          <div class="form-group col-md-12 novar">
            <label for="quantity">{{__('admindash.product.quantity')}}</label>
            <input type="number" min="1" class="form-control" name="quantity" value="{{old('quantity')?old('quantity'):$product->quantity}}" id="quantity">
          </div>
        </div>
        <!-- /.box-body -->
        <input type="hidden" name="_method" value="PUT">
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">{{__('admindash.actions.submit')}}</button>
          <a href="{{route('seller.product.index')}}" class="btn btn-default">{{__('admindash.actions.cancel')}}</a>
        </div>
      </form>


      @if(count($maincats)>0)
          <!-- getting all sub categories -->
          @foreach($maincats as $maincat)
          <span id="subcats_{{$maincat->id}}" class="hide">
              @foreach($maincat->subcats as $subcat)
                <option {{old('subcat_id')==$subcat->id?'selected':''}} {{!old('subcat_id') && $product->type->subcat->id==$subcat->id?'selected':''}} value="{{$subcat->id}}">{{$subcat->getname()}}</option>
              @endforeach
          </span>
          <!-- getting all sub categories -->
          @foreach($maincat->subcats as $subcat)
          <span id="types_{{$subcat->id}}" class="hide">
            @foreach($subcat->types as $type)
            <option {{old('type_id')==$type->id?'selected':''}} {{!old('type_id') && $product->type->id==$type->id?'selected':''}} value="{{$type->id}}">{{$type->getname()}}</option>
            @endforeach
          </span>
          @endforeach
          <!-- getting all brands -->
          @foreach($maincat->subcats as $subcat)
            @foreach($subcat->types as $type)
              <span id="brands_{{$type->id}}" class="hide">
                <option value=""></option>
                @foreach($type->brands as $brand)
                <option {{old('brand_id')==$brand->id?'selected':''}} {{!old('brand_id') && $product->brand_id==$brand->id?'selected':''}} value="{{$brand->id}}">{{$brand->getname()}}</option>
                @endforeach
              </span>
            @endforeach
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
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('des');
    CKEDITOR.replace('des_ar');
    CKEDITOR.replace('head_des');
    CKEDITOR.replace('head_des_ar');

    //setting old selections from old()
    //setting old selections from old()
     @if(old('maincat_id'))
      var cat={{old('maincat_id')}};
      $('#subcatselect').html('');
      $('#typeselect').html('');
      $('#brandselect').html('');
      $('#subcatselect').append($(`#subcats_${cat}`).html());
     @elseif(isset($product))
      var cat={{$product->type->subcat->maincat->id}};
      $('#subcatselect').html('');
      $('#typeselect').html('');
      $('#brandselect').html('');
      $('#subcatselect').append($(`#subcats_${cat}`).html());
     @endif

     @if(old('subcat_id'))
      var cat={{old('subcat_id')}};
      $('#typeselect').html('');
      $('#brandselect').html('');
      $('#typeselect').append($(`#types_${cat}`).html());
     @elseif(isset($product->type->subcat->id))
      var cat={{$product->type->subcat->id}};
      $('#typeselect').html('');
      $('#brandselect').html('');
      $('#typeselect').append($(`#types_${cat}`).html());
     @endif

     @if(old('type_id'))
      var cat={{old('type_id')}};
      $('#brandselect').html('');
      $('#brandselect').append($(`#brands_${cat}`).html());
     @elseif(isset($product->type->id))
       var cat={{$product->type->id}};
       $('#brandselect').html('');
       $('#brandselect').append($(`#brands_${cat}`).html());
     @endif



    //end setting old selections

  $('#maincatselect').on('change',()=>{
    var id=$('#maincatselect').val();
    $('#subcatselect').html('');
    $('#typeselect').html('');
    $('#brandselect').html('');
    $('#subcatselect').append($(`#subcats_${id}`).html());
    // removing previous selections
    $("#subcatselect option:selected").removeAttr("selected");
    $("#typeselect option:selected").removeAttr("selected");
    $("#brandselect option:selected").removeAttr("selected");
  });
  //on sub cat change
  $('#subcatselect').on('change',()=>{
    var id=$('#subcatselect').val();
    $('#typeselect').html('');
    $('#brandselect').html('');
    $('#typeselect').append($(`#types_${id}`).html());
    // removing previous selections
    $("#typeselect option:selected").removeAttr("selected");
    $("#brandselect option:selected").removeAttr("selected");
  });

  //on sub cat change
  $('#typeselect').on('change',()=>{
    var id=$('#typeselect').val();
    $('#brandselect').html('');
    $('#brandselect').append($(`#brands_${id}`).html());
    // removing previous selections
    $("#brandselect option:selected").removeAttr("selected");
  });

///////////////////////////////////////////////Variation//////////////////////////////////////////////////////


@if(old('variation'))
  if({{old('variation')}}==0){
    $('button[type="submit"]').html(`{{__('admindash.actions.submit')}}`);
    $('.novar').show('hide');
  } else {
    $('button[type="submit"]').html(`{{__('admindash.actions.submit')}}`);
    $('.novar').hide('hide');
  }
@elseif(count($product->variations)>0)
  $('body button[type="submit"]').html(`{{__('admindash.actions.next')}}`);
  $('.novar').hide();
@endif

//on sub cat change
$('body').on('change','#variation',function(){
  if($(this).find("option:selected").val()==0){
    $('button[type="submit"]').html(`{{__('admindash.actions.submit')}}`);
    $('.novar').show();

  }else {
    $('button[type="submit"]').html(`{{__('admindash.actions.next')}}`);
    $('.novar').hide();
  }
});

////////////////////////////////////////////////tagsinput/////////////////////////////////////////////////////

$('#tags').tagsinput({});

///////////////////////////////////////////////Croppie///////////////////////////////////////////////

    //getting all old images and converting them to base64 images to avoid any conflicts when trying to post plain .jpg url images and base64 images
    function encodeImageFileAsToBase64(url) {
        var xhr = new XMLHttpRequest();
        xhr.onload = function() {
          var reader = new FileReader();
          reader.onloadend = function() {
              $('#preview').append(`<div class="col-3" style="display: inline;width:283px;position:relative;">
                                      <img src="${reader.result}" style="width:283px;" class="img-thumbnail">
                                      <a style="top:-150px;{{((app()->getLocale()=='ar')?'right:':'left:')}}20px;position:absolute;z-index:9999" class="deletepreview btn btn-info fa fa-trash-o"></a>
                                      <input type="hidden" name="images[]" value="${reader.result}">
                                    </div>`);
          }
          reader.readAsDataURL(xhr.response);
        };
        xhr.open('GET', url);
        xhr.responseType = 'blob';
        xhr.send();
    }

    @foreach(json_decode($product->images) as $image)
    encodeImageFileAsToBase64('{{url('storage/images/products/'.$image)}}');
    @endforeach


     var uploadCrop;

        function readFile(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    uploadCrop.croppie('bind', {
                        url: e.target.result
                    });
                    $('#croppieitem').addClass('ready');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }


        uploadCrop = $('#croppieitem').croppie({
          enforceBoundary : true,
           enableExif: true,
            viewport: {
                width: 383,
                height: 500,
                type: 'square'
            },
            boundary: {
                width: 483,
                height: 600
            },

        });


        $('#avatar').on('change', function () {
          //don't allow more than 5 images
           if($("#preview").children().length>=5){
             alert(`{{__('admindash.product.maximages')}}`);
           }else{
          //reinitialize wrong file type message
          if(!$('#wrongfiletype').hasClass('hide')){
             $('#wrongfiletype').addClass('hide');
          }

          if($(this).val()!=''){
            //getting the uploaded file extention
             var ext=$(this).val().split('.').pop().toLowerCase();
             //check if the file is an image
             var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
             if ($.inArray(ext, fileExtension) != -1) {
                 readFile(this);
                 $('#croppiecontainer').removeClass('hide');
               }else {
                 $('#wrongfiletype').removeClass('hide');
               }
             }
            }
          $(this).val('');
         });

         var counter=1;
        $('#saveavatar').on('click', function (ev) {
            uploadCrop.croppie('result', {
                type: 'canvas',
                size: { width: 766, height: 1000 }
            }).then(function (resp) {
                counter++;
                $('#preview').append(`<div class="col-3" style="display: inline;width:283px;position:relative;">
                                        <img src="${resp}" style="width:283px;" class="img-thumbnail">
                                        <a style="top:-150px;{{((app()->getLocale()=='ar')?'right:':'left:')}}20px;position:absolute;z-index:9999" class="deletepreview btn btn-info fa fa-trash-o"></a>
                                        <input type="hidden" name="images[]" value="${resp}">
                                      </div>`);

                $('#croppiecontainer').addClass('hide');
            });
        });

        //cancel before cropping
        $('#croppiecancel').on('click',function(){
          $('#croppiecontainer').addClass('hide');
          $('#avatar').val('');
        });


        //delete previews individually
        $('body').on('click','.deletepreview',function(){
          $(this).parent().remove();
        });


});


</script>

@endpush
