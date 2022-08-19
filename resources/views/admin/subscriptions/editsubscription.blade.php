

@extends('admin.layouts.layout')


@section('content')
<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">تعديل الاشتراك</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" action="{{route('updatesubscription',$subscription->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="box-body">
          <div class="form-group  direction">
                          <label>تاريخ اخر دفعة:</label>

                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="date" class="form-control pull-right"  value="{{old('start_date')?old('start_date'):$subscription->getstartdate()}}" name="start_date" >
                          </div>
                          <!-- /.input group -->
          </div>
          <div class="form-group direction">
                          <label>تاريخ انتهاء الاشتراك:</label>

                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="date" class="form-control pull-right"  value="{{old('end_date')?old('end_date'):$subscription->getenddate()}}" name="end_date" >
                          </div>
                          <!-- /.input group -->
          </div>
          <div class="form-group">
            <label for="lastamount">اخر دفعة</label>
            <input type="number" step="0.01" min="0" class="form-control" id="lastamount" name="lastamount" value="{{old('lastamount')?old('lastamount'):($subscription->lastamount?$subscription->lastamount:$subscription->getprice())}}">
          </div>

        </div>
        <!-- /.box-body -->

        <div class="box-footer direction">
          <button type="submit" class="btn btn-primary">{{__('admindash.actions.submit')}}</button>
          <a href="{{route('subscriptions')}}" class="btn btn-default">{{__('admindash.actions.cancel')}}</a>
        </div>
      </form>


    </div>
    <!-- /.box -->

  </div>

</div>

@endsection
