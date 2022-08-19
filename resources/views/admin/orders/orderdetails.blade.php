

@extends('admin.layouts.layout')


@section('content')
@include('admin.datatable.includes.deletemodal')

<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <div class="box">

      <!-- /.box-header -->
      <div class="box-body">
        <table class="table direction table-bordered table-striped">
          <thead>
            <tr>
              <td>{{__('admindash.orders.ordernumber')}}</td>
              <td>{{__('admindash.orders.paymentmethod')}}</td>
              <td>{{__('admindash.orders.shippingmethod')}}</td>
              <td>{{__('admindash.orders.shippingcost')}}</td>
              <td>{{__('admindash.orders.status')}}</td>
              <td>{{__('admindash.orders.ordertotal')}}</td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>{{$ordergroup->order_number}}</td>
              <td>{{$ordergroup->getpaymentmethod->getname()}}</td>
              <td>{{$ordergroup->getshippingmethod->getname()}}</td>
              <td>{{$ordergroup->getshippingmethod->getcost()}}</td>
              <td>
                <select class="hide" id="statusselect">
                    <option value=""></option>
                  @foreach($statuses as $status)
                    <option value="{{$status->id}}">{{$status->getname()}}</option>
                  @endforeach
                </select>
                <span id="orderstatus">{{$ordergroup->status==0?trans('admindash.orders.awaitingconfirm'):$ordergroup->getstatus->getname()}}</span> &nbsp;
                <button id="savestatus" class="btn btn-primary " name="button">{{__('admindash.actions.change')}}</button>
                <button id="dosavestatus" class="btn btn-success hide" name="button">{{__('admindash.actions.submit')}}</button>

              </td>
              <td>{{$ordergroup->gettotal()}}</td>
            </tr>
          </tbody>
        </table>

        <h4 class="page-subheading">{{__('admindash.orders.orderdetails')}}</h4>

        <table class="table direction table-bordered table-striped">
          <thead>
            <tr>
              <td>{{__('admindash.orders.productpic')}}</td>
              <td>{{__('admindash.orders.productname')}}</td>
              <td>{{__('admindash.orders.productprice')}}</td>
              <td>{{__('admindash.orders.store')}}</td>
              <td>{{__('admindash.orders.productquantity')}}</td>
              <td>{{__('admindash.orders.producttotal')}}</td>
            </tr>
          </thead>
          <tbody>
            @foreach($ordergroup->orders as $order)
            <tr>
              <td><img style="width:75px;height:75px" src="{{url('')}}/storage/images/products/{{$order->product->image}}"/></td>
              <td> <a href="{{url('')}}/products/{{$order->product->getslug()}}">{{$order->product->gettitle()}}</a>
                <small style="display:block" class="cart_ref">
                @if($order->extoption_id!='')
                   @foreach($order->extoption->options as $option)
                   <span class="label label-primary">{{$option->getname()}}</span>
                   @endforeach
                @endif</small></td>
              <td>{{$order->extoption_id!=''?$order->extoption->getdollarprice():$order->product->getdollarprice()}}</td>
              <td>{{$order->product->store_id==0?'Merch':$order->product->store->getname()}}</td>
              <td>{{$order->quantity}}</td>
              <td>{{$order->getqprice()}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>

        <h4 class="page-subheading">{{__('admindash.orders.shippingaddress')}}</h4>

        <table class="table direction table-bordered table-striped">
          <thead>
            <tr>
              <td>{{__('admindash.orders.address_name')}}</td>
              <td>{{__('admindash.orders.address_phone')}}</td>
              <td>{{__('admindash.orders.address_address_line1')}}</td>
              <td>{{__('admindash.orders.address_address_line2')}}</td>
              <td>{{__('admindash.orders.address_city')}}</td>
              <td>{{__('admindash.orders.address_country')}}</td>
              <td>{{__('admindash.orders.address_postcode')}}</td>
              <td>{{__('admindash.orders.address_info')}}</td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>{{$ordergroup->getaddress->name}}</td>
              <td>{{$ordergroup->getaddress->phone}}</td>
              <td>{{$ordergroup->getaddress->add_1}}</td>
              <td>{{$ordergroup->getaddress->add_2?$ordergroup->getaddress->add_2:'N/A'}}</td>
              <td>{{$ordergroup->getaddress->getcity->getname()}}</td>
              <td>{{$ordergroup->getaddress->getcountry->getname()}}</td>
              <td>{{$ordergroup->getaddress->postcode?$ordergroup->getaddress->postcode:'N/A'}}</td>
              <td>{{$ordergroup->getaddress->info?$ordergroup->getaddress->info:'N/A'}}</td>
            </tr>
          </tbody>
        </table>

        <form id="deliveryfrom" class="form" action="{{route('submitdetails',$ordergroup->id)}}" method="post">
          @csrf
          <div class="from-group">
            <label for="">{{__('admindash.orders.isdelivered')}}</label>
            <select class="form-control" name="delivered">
              <option {{$ordergroup->delivered==0?'selected':''}} value="0">{{__('admindash.constants.no')}}</option>
              <option {{$ordergroup->delivered==1?'selected':''}} value="1">{{__('admindash.constants.yes')}}</option>
            </select>
          </div>
        </form>
      </div>
      <div class="box-footer">
        <a href="{{url()->previous()}}" type="button" name="button" class="btn btn-default">{{__('admindash.actions.back')}}</a>
        <a href="#" id="submitdelivery" type="button" name="button" class="btn btn-primary">{{__('admindash.actions.submit')}}</a>
      </div>
      <!-- /.box-body -->
    </div>

  </div>

</div>

@endsection


@push('scripts')
<script type="text/javascript">

$(document).ready(function(){
  $('#savestatus').on('click',function(){
    $('#orderstatus').hide();
    $(this).hide();
    $('#statusselect').removeClass('hide');
    $('#dosavestatus').removeClass('hide');
  });

  $('#dosavestatus').on('click',function(){
    var statusid=$('#statusselect option:selected').val();
    var ordergroupid=`{{$ordergroup->id}}`;
    $.ajax({
      url:`{{route('changestatus')}}`,
      method:'post',
      data:{statusid:statusid,ordergroupid:ordergroupid,_token:`{{csrf_token()}}`},
      success:function(data){
        $('#statusselect').addClass('hide');
        $('#dosavestatus').addClass('hide');
        $('#orderstatus').html(data);
        $('#orderstatus').show();
        $('#savestatus').show();
      },
      error:function(){
        alert('something went wrong');
      }
    });
  });

  $('#submitdelivery').on('click',function(e){
    e.preventDefault();
    $('#deliveryfrom').submit();
  });
});

</script>
@endpush
