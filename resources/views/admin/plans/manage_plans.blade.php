

@extends('admin.layouts.layout')


@section('content')
@include('admin.datatable.includes.deletemodal')

<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">{{__('admindash.plans.plans')}}</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="main-table" class="table direction table-bordered table-striped">
          <thead>
          <tr>
            <th><input type="checkbox" class="mx-auto" id="checkbox_all"></th>
            <th>{{__('admindash.plans.plan')}}</th>
            <th>{{__('admindash.plans.price_')}}</th>
            <th>{{__('admindash.plans.sale_fee')}}</th>
            <th>{{__('admindash.plans.min_fee')}}</th>
            <th>{{__('admindash.plans.max_fee')}}</th>
            <th>{{__('admindash.plans.productlimit')}}</th>
            <th>{{__('admindash.plans.variations_')}}</th>
            <th>{{__('admindash.table.operations')}}</th>
          </tr>
          </thead>
          <tbody>
            @if(count($plans)>0)
              @foreach($plans as $plan)
                <tr data-id="{{$plan->id}}">
                  <td><input type="checkbox" id="checkbox_{{$plan->id}}" data-id="{{$plan->id}}" data-clicked="no" class="checkboxes"></td>
                  <td>{{$plan->getname()}}</td>
                  <td>{{$plan->price}} {{__('admindash.constants.usd')}}</td>
                  <td>{{$plan->fee}} %</td>
                  <td>{{$plan->min_fee}} {{__('admindash.constants.usd')}}</td>
                  <td>{{$plan->max_fee}} {{__('admindash.constants.usd')}}</td>
                  <td>{{$plan->product_limit?$plan->product_limit:trans('admindash.constants.unlimited')}}</td>
                  <td>{{$plan->variations==0?trans('admindash.constants.disabled'):trans('admindash.constants.enabled')}}</td>
                  <td>
                    <a id="editUsers" class="btn btn-primary" href="{{route('plans.show',$plan->id)}}">{{__('admindash.actions.showalldetails')}}</a>
                    <a id="editUsers" class="btn btn-default" href="{{route('plans.edit',$plan->id)}}"><i class="fa fa-edit"></i></a>
                    <form style="display:inline" id="deleteOneForm" action="{{route('plans.destroy',$plan->id)}}" method="post">
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
                    text: `<sapn style="font-size:14px" class="d-inline">{{trans('admindash.plans.addplan')}}</sapn>`,
                    className: 'btn btn-default',
                    action: function(){
                      window.location.href='{{route('plans.create')}}';  }
                   },
                    { //custom button
                    text: `<sapn style="font-size:14px" class="d-inline">تعديل الترتيب</sapn>`,
                    className: 'btn btn-primary',
                    action: function(){
                      window.location.href='{{route('plans.editorder')}}';  }
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
                            $('#deleteModalForm').attr('action',`{{route('plans.deletem')}}`);
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
