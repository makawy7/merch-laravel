

@extends('admin.layouts.layout')


@section('content')
@include('admin.datatable.includes.deletemodal')

<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">{{__('admindash.brand.brands')}}</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="main-table" class="table direction table-bordered table-striped">
          <thead>
          <tr>
            <th><input type="checkbox" class="mx-auto" id="checkbox_all"></th>
            <th>{{__('admindash.table.brand')}}</th>
            <th>{{__('admindash.table.type')}}</th>
            <th>{{__('admindash.table.subcat')}}</th>
            <th>{{__('admindash.table.maincat')}}</th>
            <th>{{__('admindash.table.operations')}}</th>
          </tr>
          </thead>
          <tbody>
            @if(count($brands)>0)
              @foreach($brands as $brand)
                <tr data-id="{{$brand->id}}">
                  <td><input type="checkbox" id="checkbox_{{$brand->id}}" data-id="{{$brand->id}}" data-clicked="no" class="checkboxes"></td>
                  <td>{{$brand->getname()}}</td>
                  <td>{{$brand->type->getname()}}</td>
                  <td>{{$brand->type->subcat->getname()}}</td>
                  <td>{{$brand->type->subcat->maincat->getname()}}</td>
                  <td>
                    <a id="editUsers" class="btn btn-default" href="{{route('brand.edit',$brand->id)}}"><i class="fa fa-edit"></i></a>
                    <form style="display:inline" id="deleteOneForm" action="{{route('brand.destroy',$brand->id)}}" method="post">
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
      order: [ 2, 'asc' ],
      dom: 'Bflrtip',

      buttons: {
              dom: { //overriding buttons class name
                    button: {
                    tag: 'button',
                    className: 'btn main-table'},
                  },
              buttons: [
                    { //custom button
                    text: `<sapn style="font-size:14px" class="d-inline">{{trans('admindash.brand.addbrand')}}</sapn>`,
                    className: 'btn btn-default',
                    action: function(){
                      window.location.href='{{route('brand.create')}}';  }
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
                            $('#deleteModalForm').attr('action',`{{route('brand.deletem')}}`);
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
