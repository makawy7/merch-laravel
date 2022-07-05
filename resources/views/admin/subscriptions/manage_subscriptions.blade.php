

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
            <th>{{__('admindash.subscriptions.plan_name')}}</th>
            <th>{{__('admindash.subscriptions.user')}}</th>
            <th>{{__('admindash.subscriptions.user_email')}}</th>
            <th>{{__('admindash.subscriptions.store')}}</th>
            <th>تاريخ اخر دفعة</th>
            <th>{{__('admindash.subscriptions.end_date')}}</th>
            <th>{{__('admindash.subscriptions.paymentmethod')}}</th>
            <th>اخر دفعة</th>
            <th>{{__('admindash.table.operations')}}</th>
          </tr>
          </thead>
          <tbody>
            @if(count($subscriptions)>0)
              @foreach($subscriptions as $subscription)
                <tr data-id="{{$subscription->id}}">
                  <td>{{$subscription->plan->getname()}}</td>
                  <td>{{$subscription->user->name}}</td>
                  <td>{{$subscription->user->email}}</td>
                  <td>{{$subscription->user->store->getname()}}</td>
                  <td>{{$subscription->getstartdate()}}</td>
                  <td>{{$subscription->getenddate()}}</td>
                  <td>{{$subscription->getpaymentmethod->getname()}}</td>
                  <td>{{$subscription->lastamount?$subscription->lastamount:$subscription->getprice()}} {{__('admindash.constants.usd')}}</td>
                  <td>
                    @if($subscription->active==0)
                    <a class="btn btn-success" href="{{route('activatesubscription',$subscription->id)}}">تفعيل</a>
                    @else
                    <a class="btn btn-danger" href="{{route('deactivatesubscription',$subscription->id)}}">تعطيل</a>
                    @endif
                    <a class="btn btn-default" href="{{route('editsubscription',$subscription->id)}}">تعديل</a>
                    <a class="btn btn-warning" href="{{route('deletesubscription',$subscription->id)}}">{{__('admindash.subscriptions.delete')}}</a>
                  </td>
                </tr>
              @endforeach
            @endif
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">طلبات تغيير الاشتراك</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table class="table direction table-bordered table-striped">
          <thead>
          <tr>
            <th>{{__('admindash.subscriptions.plan_name')}}</th>
            <th>{{__('admindash.subscriptions.user')}}</th>
            <th>{{__('admindash.subscriptions.user_email')}}</th>
            <th>{{__('admindash.subscriptions.store')}}</th>
            <th>{{__('admindash.subscriptions.start_date')}}</th>
            <th>{{__('admindash.subscriptions.end_date')}}</th>
            <th>{{__('admindash.subscriptions.paymentmethod')}}</th>
            <th>{{__('admindash.subscriptions.price')}}</th>
            <th>{{__('admindash.table.operations')}}</th>
          </tr>
          </thead>
          <tbody>
            @if(count($requests)>0)
              @foreach($requests as $request)
                <tr data-id="{{$request->id}}">
                  <td>{{$request->plan->getname()}}</td>
                  <td>{{$request->user->name}}</td>
                  <td>{{$request->user->email}}</td>
                  <td>{{$request->user->store->getname()}}</td>
                  <td>{{$request->getstartdate()}}</td>
                  <td>{{$request->getenddate()}}</td>
                  <td>{{$request->getpaymentmethod->getname()}}</td>
                  <td>{{$request->getprice()}} {{__('admindash.constants.usd')}}</td>
                  <td>
                    <a href="{{route('approverequest',['userid'=>$request->user->id,'reqid'=>$request->id])}}" class="btn btn-success">تفعيل</a>
                  </td>
                </tr>
              @endforeach
            @else
              <tr  class="text-center">
                <td colspan="9">لا يوجد طلبات في الانتظار</td>
              </tr>
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
