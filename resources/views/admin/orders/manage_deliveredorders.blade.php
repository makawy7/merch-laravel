

@extends('admin.layouts.layout')


@section('content')
@include('admin.datatable.includes.deletemodal')

<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">{{__('admindash.orders.deliveredorders')}}</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="main-table" class="table direction table-bordered table-striped">
          <thead>
          <tr>
            <th>#</th>
            <th>{{__('admindash.orders.ordernumber')}}</th>
            <th>{{__('admindash.orders.paymentmethod')}}</th>
            <th>{{__('admindash.orders.shippingmethod')}}</th>
            <th>{{__('admindash.orders.ordertotal')}}</th>
            <th>{{__('admindash.orders.orderdate')}}</th>
            <th>{{__('admindash.orders.delivered_at')}}</th>
            <th>{{__('admindash.table.operations')}}</th>
          </tr>
          </thead>
          <tbody>
            @if(count($orders)>0)
              @foreach($orders as $order)
                <tr data-id="{{$order->id}}">
                  <td>{{$order->id}}</td>
                  <td>{{$order->order_number}}</td>
                  <td>{{$order->getpaymentmethod->getname()}}</td>
                  <td>{{$order->getshippingmethod->getname()}}</td>
                  <td>{{$order->gettotal()}}</td>
                  <td>{{$order->created_at}}</td>
                  <td>{{$order->delivery_time}}</td>
                  <td>
                    <a id="editUsers" class="btn btn-primary" href="{{route('orderdetails',$order->order_number)}}">{{__('admindash.orders.orderdetails')}}</i></a>
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
                      { "orderable": false, "targets": [1,2,3,4,5,6] }
                    ],
      order: [ 0, 'desc' ],
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
