

@extends('admin.layouts.layout')


@section('content')
@include('admin.datatable.includes.deletemodal')

<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">{{__('admindash.contactus.messages')}}</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="main-table" class="table direction table-bordered table-striped">
          <thead>
          <tr>
            <th>{{__('admindash.contactus.title')}}</th>
            <th>{{__('admindash.contactus.body')}}</th>
            <th>{{__('admindash.contactus.sender')}}</th>
            <th>{{__('admindash.contactus.phone')}}</th>
            <th>{{__('admindash.contactus.email')}}</th>
          </tr>
          </thead>
          <tbody>
            @if(count($messages)>0)
              @foreach($messages as $message)
                <tr >
                  <td>{{$message->title}}</td>
                  <td>{{$message->body}}</td>
                  <td>{{$message->name?$message->name:($message->user?$message->user->name:'')}}</td>
                  <td>{{$message->phone?$message->phone:($message->user?$message->user->getphone():'')}}</td>
                  <td>{{$message->email?$message->email:($message->user?$message->user->email:'')}}</td>
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
