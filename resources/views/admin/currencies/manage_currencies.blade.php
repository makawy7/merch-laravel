

@extends('admin.layouts.layout')


@section('content')
@include('admin.datatable.includes.deletemodal')

<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">{{__('admindash.currencies.currencies')}}</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="main-table" class="table direction table-bordered table-striped">
          <thead>
          <tr>
            <th><input type="checkbox" class="mx-auto" id="checkbox_all"></th>
            <th>{{__('admindash.currencies.currency')}}</th>
            <th>{{__('admindash.currencies.abbreviation_1')}}</th>
            <th>{{__('admindash.currencies.value_1')}}</th>
            <th>{{__('admindash.table.operations')}}</th>
          </tr>
          </thead>
          <tbody>
            @if(count($currencies)>0)
              @foreach($currencies as $currency)
                <tr data-id="{{$currency->id}}">
                  <td><input type="checkbox" id="checkbox_{{$currency->id}}" data-id="{{$currency->id}}" data-clicked="no" class="checkboxes"></td>
                  <td>{{$currency->getname()}}</td>
                  <td>{{$currency->getabbreviation()}}</td>
                  <td>{{__('admindash.currencies.1usd')}} {{$currency->value}} {{$currency->getabbreviation()}}</td>
                  <td>
                    <a id="editUsers" class="btn btn-default" href="{{route('editcurrency',$currency->id)}}"><i class="fa fa-edit"></i></a>
                    <form style="display:inline" id="deleteOneForm" action="{{route('destroycurrency',$currency->id)}}" method="post">
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
                      { "orderable": false, "targets": [0,2] }
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
                    text: `<sapn style="font-size:14px" class="d-inline">{{trans('admindash.currencies.add_currency')}}</sapn>`,
                    className: 'btn btn-default',
                    action: function(){
                      window.location.href='{{route('addcurrency')}}';  }
                   },
                    { //custom button
                    text: `<sapn style="font-size:14px" class="d-inline">تعديل الترتيب</sapn>`,
                    className: 'btn btn-primary',
                    action: function(){
                      window.location.href='{{route('editcurrenciesorders')}}';  }
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
                            $('#deleteModalForm').attr('action',`{{route('deletemcurrencies')}}`);
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
