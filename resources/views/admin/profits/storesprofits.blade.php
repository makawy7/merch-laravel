

@extends('admin.layouts.layout')


@section('content')
@include('admin.datatable.includes.deletemodal')

<div class="row">
  <!-- left column -->
  <div class="col-md-12" id="maincontainer">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">{{__('admindash.profits.stores_profits')}}</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="form-group">
          <label for="">{{__('admindash.profits.choosestore')}}</label>
          <select class="form-control" name="" id="store">
            @foreach($stores as $store)
            <option value="{{$store->id}}">{{$store->getname()}}</option>
            @endforeach
          </select>

        </div>
      </div>
      <!-- /.box-body -->
    </div>

  </div>

</div>

@endsection


@push('scripts')
<script type="text/javascript">


$(document).ready(function() {

//When Page Loads For The First Time
$.ajax({
  url:`{{route('getstoreprofits')}}`,
  method:'get',
  data:{id:`{{$stores[0]->id}}`},
  success:(data)=>{
    $('.statistics').remove();
    $('#maincontainer').append(data.html);
  },
  error:()=>{
    alert('something went wrong');
  }

});

$('body').on('change','#store',function(){
  var id=$('#store option:selected').val();

  $.ajax({
    url:`{{route('getstoreprofits')}}`,
    method:'get',
    data:{id:id},
    success:(data)=>{
      $('.statistics').remove();
      $('#maincontainer').append(data.html);
    },
    error:()=>{
      alert('something went wrong');
    }

  });
});


}).ajaxStart(function () {
    $('#loadingspinner').removeClass('hide');
  })
  .ajaxStop(function () {
    $('#loadingspinner').addClass('hide');
  });

</script>
@endpush
