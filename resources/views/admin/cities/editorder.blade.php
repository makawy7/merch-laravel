

@extends('admin.layouts.layout')


@section('content')
<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">تعديل ترتيب المدن</h3>
      </div>
      <!-- /.box-header -->

        <div class="box-body">
          <form class="" action="{{route('updatecitiesorder')}}" method="post">
            @csrf
            <table class="table direction table-bordered table-striped">
              <tbody>
                  <tr>
                    <td>المدينة</td>
                    <td>الترتيب</td>
                  </tr>
                  @foreach($countries as $country)
                  <tr>
                    <th colspan="2" class="text-center">{{$country->getname()}}</th>
                  </tr>
                    @foreach($country->cities as $city)
                      <tr>
                        <td>{{$city->getname()}}</td>
                        <td> <input type="number" min="0" name="orders[]" value="{{$city->order}}"> </td>
                      </tr>
                    @endforeach
                  @endforeach
              </tbody>
            </table>

        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn btn-primary">{{__('admindash.actions.submit')}}</button>
          <a href="{{route('cities')}}" class="btn btn-default">{{__('admindash.actions.back')}}</a>
        </div>
      </form>



    </div>
    <!-- /.box -->

  </div>

</div>

@endsection


@push('scripts')
<script type="text/javascript">

$(document).ready(function(){
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('des');
    CKEDITOR.replace('des_ar');
    CKEDITOR.replace('head_des');
    CKEDITOR.replace('head_des_ar');
});

</script>

@endpush
