

@extends('seller.layouts.layout')


@section('content')
@include('admin.datatable.includes.deletemodal')

<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">{{__('admindash.product.products')}}</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="main-table" class="table direction table-bordered table-striped">
          <thead>
          <tr>
            <th><input type="checkbox" class="mx-auto" id="checkbox_all"></th>
            <th>{{__('admindash.table.product')}}</th>
            <th>{{__('admindash.table.price')}}</th>
            <th>{{__('admindash.table.quantity')}}</th>
            <th>{{__('admindash.table.brand')}}</th>
            <th>{{__('admindash.table.type')}}</th>
            <th>{{__('admindash.table.subcat')}}</th>
            <th>{{__('admindash.table.maincat')}}</th>
            <th>{{__('admindash.table.operations')}}</th>
          </tr>
          </thead>
          <tbody>
            @if(count($products)>0)
              @foreach($products as $product)
                <tr data-id="{{$product->id}}">
                  <td><input type="checkbox" id="checkbox_{{$product->id}}" data-id="{{$product->id}}" data-clicked="no" class="checkboxes"></td>
                  <td>{{$product->gettitle()}}</td>
                  <td>{{isset($product->price)?$product->price:$product->getdollarpricerange()}}</td>
                  <td>{{$product->quantity?$product->quantity:'N/A'}}</td>
                  <td>{{isset($product->brand)?$product->brand->getname():'N/A'}}</td>
                  <td>{{$product->type->getname()}}</td>
                  <td>{{$product->type->subcat->getname()}}</td>
                  <td>{{$product->type->subcat->maincat->getname()}}</td>
                  <td>
                    <a id="editUsers" class="btn btn-default" href="{{route('seller.product.edit',$product->id)}}"><i class="fa fa-edit"></i></a>
                    <form style="display:inline" id="deleteOneForm" action="{{route('seller.product.destroy',$product->id)}}" method="post">
                      @csrf
                      <input type="hidden" name="_method" value="DELETE">
                      <button class="btn btn-danger" onclick="deleteOne()"><i class="fa fa-trash-o"></i></button>
                    </form>
                  </td>
                </tr>
              @endforeach
            @endif
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </div>

  </div>

</div>

@endsection


@push('scripts')
<script type="text/javascript">

//delete form modal submit button
function deleteSubmit(){
  $("#deleteModalForm").submit();
}
function deleteOne(){
  $("#deleteOneForm").submit();
}

$(document).ready(function() {

    var table=$('#main-table').DataTable({

      lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "{{__('admindash.datatable.all')}}"]],
      iDisplayLength: 10,
      columnDefs: [
                      { "orderable": false, "targets": [0,5] }
                    ],
      order: [ 1, 'asc' ],
      dom: 'Bflrtip',

      buttons: {
              dom: { //overriding buttons class name
                    button: {
                    tag: 'button',
                    className: 'btn main-table'},
                  },
              buttons: [
                    { //custom button
                    text: `<sapn style="font-size:14px" class="d-inline">{{trans('admindash.product.addproduct')}}</sapn>`,
                    className: 'btn btn-default',
                    action: function(){
                      window.location.href='{{route('seller.product.create')}}';  }
                   },


                   {    //the select button (confirged in this example to get all ids of selected rows) as deleted button

                       text: `<sapn style="font-size:14px" >{{trans('admindash.actions.delete_selected')}}</sapn>`,
                       className:' btn btn-danger selectButton',
                       action: function ( e, dt, button, config ) {
                             var length=$('.checkboxes').filter(':checked').length;
                             var ids='';
                             $('.checkboxes').each(function(){
                              if($(this).prop('checked')==true){
                                ids+=$(this).data('id')+',';}
                             });
                            $('#deleteCount').html(length);
                            $('#deleteModalForm').attr('action',`{{route('seller.product.deletem')}}`);
                            $('#deleteInput').val(ids);
                            $('#deleteModal').modal('show');
                       },

                   },
                ]
         },//end if main buttons:


         //translation
         @include('admin.datatable.includes.lang')

         initComplete:function(){
           if(!$('.selectButton').hasClass('hide')){
             $('.selectButton').addClass('hide');
            }
               }

    });

  @include('admin.datatable.includes.checkboxes')


});

</script>
@endpush
