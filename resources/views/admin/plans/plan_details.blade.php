

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
        <table class="table direction table-bordered table-striped">
          <tbody>
              <tr>
                <th>{{__('admindash.plans.plan')}}</th>
                  <td>{{$plan->getname()}}</td>
              </tr>
              <tr>
                <th>{{__('admindash.plans.des_')}}</th>
                  <td>{!!$plan->getdes()!!}</td>
              </tr>
              <tr>
                <th>{{__('admindash.plans.price_')}}</th>
                  <td>{{$plan->price}} {{__('admindash.constants.usd')}}</td>
              </tr>
              <tr>
                  <th>{{__('admindash.plans.sale_fee')}}</th>
                  <td>{{$plan->fee}} %</td>
              </tr>
              <tr>
                  <th>{{__('admindash.plans.min_fee')}}</th>
                  <td>{{$plan->min_fee}} {{__('admindash.constants.usd')}}</td>
              </tr>
              <tr>
                  <th>{{__('admindash.plans.max_fee')}}</th>
                  <td>{{$plan->max_fee}} {{__('admindash.constants.usd')}}</td>
              </tr>
              <tr>
                  <th>{{__('admindash.plans.productlimit')}}</th>
                  <td>{{$plan->product_limit?$plan->product_limit:trans('admindash.constants.unlimited')}}</td>
              </tr>
              <tr>
                  <th>{{__('admindash.plans.variations_')}}</th>
                  <td>{{$plan->variations==0?trans('admindash.constants.disabled'):trans('admindash.constants.enabled')}}</td>
              </tr>

              <tr>
                  <th>{{__('admindash.plans.photolimit')}}</th>
                  <td>{{$plan->photo_limit}}</td>
              </tr>
              <tr>
                  <th>{{__('admindash.plans.deletedcounter')}}</th>
                  <td>{{$plan->deleted_counter?$plan->deleted_counter:trans('admindash.constants.na')}}</td>
              </tr>
              <tr>
                  <th>{{__('admindash.plans.canseeviews')}}</th>
                  <td>{{$plan->can_see_views==0?trans('admindash.constants.notpermitted'):trans('admindash.constants.permitted')}}</td>
              </tr>
              <tr>
                  <th>{{__('admindash.plans.analytics_')}}</th>
                  <td>{{$plan->analytics==0?trans('admindash.constants.notpermitted'):trans('admindash.constants.permitted')}}</td>
              </tr>
              <tr>
                  <th>{{__('admindash.plans.badge_')}}</th>
                  <td>
                    @if($plan->badge)
                    <img src="{{url('storage/images/plans/'.$plan->badge)}}" width="100" height="100" alt="">
                    @else
                    {{__('admindash.plans.nobadge')}}
                    @endif
                  </td>
              </tr>
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <a href="{{route('plans.index')}}" class="btn btn-primary">{{__('admindash.actions.back')}}</a>
      </div>
    </div>

  </div>

</div>

@endsection


@push('scripts')
<script type="text/javascript">

</script>
@endpush
