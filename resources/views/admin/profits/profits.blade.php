

@extends('admin.layouts.layout')


@section('content')
@include('admin.datatable.includes.deletemodal')

<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">{{__('admindash.profits.profits_')}} {{currentyear()}}</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="main-table" class="table direction table-bordered table-striped">
          <thead>
          <tr>
            <th>{{__('admindash.profits.month')}}</th>
            <th>{{__('admindash.profits.websales')}}</th>
            <th>{{__('admindash.profits.storesales')}}</th>
            <th>{{__('admindash.profits.sales')}}</th>
            <th>{{__('admindash.profits.webprofits')}}</th>
            <th>{{__('admindash.profits.storesprofits')}}</th>
            <th>{{__('admindash.profits.monthprofit')}}</th>
          </tr>
          </thead>
          <tbody>
            @for($i=1;$i<=12;$i++)
            <tr class="{{currentmonth()==$i?'bg-olive':''}}">
              <td>{{__('admindash.months.'.$i)}}</td>
              <td>{{profits(currentyear(),$i)['websales']}}</td>
              <td>{{profits(currentyear(),$i)['storesales']}}</td>
              <td>{{profits(currentyear(),$i)['sales']}}</td>
              <td>{{profits(currentyear(),$i)['webprofits']}} {{__('admindash.constants.usd')}}</td>
              <td>{{profits(currentyear(),$i)['storesprofits']}} {{__('admindash.constants.usd')}}</td>
              <td>{{profits(currentyear(),$i)['storesprofits']+profits(currentyear(),$i)['webprofits']}} {{__('admindash.constants.usd')}}</td>
            </tr>
            @endfor
            <tr>
              <th>{{__('admindash.profits.yeartotal')}}</th>
              <th>{{profits(currentyear())['websales']}}</th>
              <th>{{profits(currentyear())['storesales']}}</th>
              <th>{{profits(currentyear())['sales']}}</th>
              <th>{{profits(currentyear())['webprofits']}} {{__('admindash.constants.usd')}}</th>
              <th>{{profits(currentyear())['storesprofits']}} {{__('admindash.constants.usd')}}</th>
              <th>{{profits(currentyear())['storesprofits']+profits(currentyear())['webprofits']}} {{__('admindash.constants.usd')}}</th>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </div>



    <div class="box">
      <div class="box-header">
        <h3 class="box-title">{{__('admindash.profits.profits_')}} {{previousyear()}}</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="main-table" class="table direction table-bordered table-striped">
          <thead>
          <tr>
            <th>{{__('admindash.profits.month')}}</th>
            <th>{{__('admindash.profits.websales')}}</th>
            <th>{{__('admindash.profits.storesales')}}</th>
            <th>{{__('admindash.profits.sales')}}</th>
            <th>{{__('admindash.profits.webprofits')}}</th>
            <th>{{__('admindash.profits.storesprofits')}}</th>
            <th>{{__('admindash.profits.monthprofit')}}</th>
          </tr>
          </thead>
          <tbody>
            @for($i=1;$i<=12;$i++)
            <tr>
              <td>{{__('admindash.months.'.$i)}}</td>
              <td>{{profits(previousyear(),$i)['websales']}}</td>
              <td>{{profits(previousyear(),$i)['storesales']}}</td>
              <td>{{profits(previousyear(),$i)['sales']}}</td>
              <td>{{profits(previousyear(),$i)['webprofits']}} {{__('admindash.constants.usd')}}</td>
              <td>{{profits(previousyear(),$i)['storesprofits']}} {{__('admindash.constants.usd')}}</td>
              <td>{{profits(previousyear(),$i)['storesprofits']+profits(previousyear(),$i)['webprofits']}} {{__('admindash.constants.usd')}}</td>
            </tr>
            @endfor
            <tr>
              <th>{{__('admindash.profits.yeartotal')}}</th>
              <th>{{profits(previousyear())['websales']}}</th>
              <th>{{profits(previousyear())['storesales']}}</th>
              <th>{{profits(previousyear())['sales']}}</th>
              <th>{{profits(previousyear())['webprofits']}} {{__('admindash.constants.usd')}}</th>
              <th>{{profits(previousyear())['storesprofits']}} {{__('admindash.constants.usd')}}</th>
              <th>{{profits(previousyear())['storesprofits']+profits(previousyear())['webprofits']}} {{__('admindash.constants.usd')}}</th>
            </tr>
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


$(document).ready(function() {




});

</script>
@endpush
