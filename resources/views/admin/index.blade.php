@extends('admin.layouts.layout')


@section('content')

<!-- Small boxes (Stat box) -->
<div class="row">
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-aqua">
      <div class="inner">
        <h3>{{count(ordersinq())}}</h3>

        <p>{{__('admindash.index.ordersinq')}}</p>
      </div>
      <div class="icon">
        <i class="fa fa-shopping-cart"></i>
      </div>
      <a href="{{route('orders')}}" class="small-box-footer">
        More info <i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green">
      <div class="inner">
        <h3>{{profits(currentyear(),currentmonth())['webprofits']+profits(currentyear(),currentmonth())['storesprofits']}}<sup style="font-size: 20px"> {{__('admindash.constants.usd')}}</sup></h3>

        <p>{{__('admindash.index.profits')}}</p>
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
      <a href="{{route('profits')}}" class="small-box-footer">
        More info <i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-yellow">
      <div class="inner">
        <h3>{{count(users())}}</h3>

        <p>{{__('admindash.index.users')}}</p>
      </div>
      <div class="icon">
        <i class="ion ion-person-add"></i>
      </div>
      <a href="{{route('user.index')}}" class="small-box-footer">
        More info <i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-red">
      <div class="inner">
        <h3>{{count(products())}}</h3>
        <p>{{__('admindash.index.products')}}</p>
      </div>
      <div class="icon">
        <i class="ion ion-pie-graph"></i>
      </div>
      <a href="{{route('product.index')}}" class="small-box-footer">
        More info <i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <!-- ./col -->
</div>
<!-- /.row -->

@endsection
