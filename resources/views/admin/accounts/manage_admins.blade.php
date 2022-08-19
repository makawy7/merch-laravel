

@extends('admin.layouts.layout')


@section('content')
@include('admin.datatable.includes.deletemodal')

<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">{{__('admindash.account.users')}}</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="main-table" class="table direction table-bordered table-striped">
          <thead>
          <tr>
            <th><input type="checkbox" class="mx-auto" id="checkbox_all"></th>
            <th>{{__('admindash.account.adminname')}}</th>
            <th>{{__('admindash.account.email')}}</th>
            <th>حالة الايميل</th>
            <th>{{__('admindash.account.phone')}}</th>
            <th>حالة الهاتف</th>
            <th>{{__('admindash.account.gender')}}</th>
            <th>{{__('admindash.account.city')}}</th>
            <th>{{__('admindash.account.country')}}</th>
            <th>{{__('admindash.table.operations')}}</th>
          </tr>
          </thead>
          <tbody>
            @if(count($users)>0)
              @foreach($users as $user)
                <tr data-id="{{$user->id}}">
                  <td><input type="checkbox" id="checkbox_{{$user->id}}" data-id="{{$user->id}}" data-clicked="no" class="checkboxes"></td>
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->email_verified_at?'تم تأكيده':'لم يتم تأكيده'}}</td>
                  <td>{{$user->getphone()}}</td>
                  <td>{{$user->phone_verified_at?'تم تأكيده':'لم يتم تأكيده'}}</td> 
                  <td>{{$user->gender=='male'?__('admindash.constants.male'):__('admindash.constants.female')}}</td>
                  <td>{{$user->getcountry?$user->getcountry->getname():'N/A'}}</td>
                  <td>{{$user->getcity?$user->getcity->getname():'N/A'}}</td>
                  <td>
                    <a id="editUsers" class="btn btn-primary" href="{{route('admin.revokeadmin',$user->id)}}">{{__('admindash.account.revokeadmin')}}</a>
                    <form style="display:inline" id="deleteOneForm" action="{{route('admin.destroy',$user->id)}}" method="post">
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
                            $('#deleteModalForm').attr('action',`{{route('admin.deletem')}}`);
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
