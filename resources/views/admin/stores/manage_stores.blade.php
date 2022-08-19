

@extends('admin.layouts.layout')


@section('content')
@include('admin.datatable.includes.deletemodal')

<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">{{__('admindash.subscriptions.subscriptions')}}</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="main-table" class="table direction table-bordered table-striped">
          <thead>
          <tr>
            <th>{{__('admindash.stores.store_name')}}</th>
            <th>{{__('admindash.stores.store_owner')}}</th>
            <th>{{__('admindash.stores.numberofproducts')}}</th>
            <th>{{__('admindash.stores.ownerphone')}}</th>
            <th>{{__('admindash.stores.store_address')}}</th>
            <th>الارباح</th>

          </tr>
          </thead>
          <tbody>
            @if(count($stores)>0)
              @foreach($stores as $store)
                <tr data-id="{{$store->id}}">
                  <td>{{$store->getname()}}</td>
                  <td>{{$store->user->name}}</td>
                  <td>{{count($store->products)}}</td>
                  <td>{{$store->user->getphone()}}</td>
                  <td>{{$store->address}}</td>
                  <td> <a href="{{route('getstoreprofits',$store->id)}}" class="btn btn-primary">عرض الارباح</a> </td>
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
