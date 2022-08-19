

@extends('admin.layouts.layout')


@section('content')
<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">تعديل ترتيب طرق الدفع</h3>
      </div>
      <!-- /.box-header -->

        <div class="box-body">
          <form class="" action="{{route('updatepaymentmethodsorder')}}" method="post">
            @csrf
            <table class="table direction table-bordered table-striped">
              <tbody>
                  <tr>
                    <td>طريقة الدفع</td>
                    <td>الترتيب</td>
                  </tr>
                  @foreach($paymentmethods as $paymentmethod)
                  <tr>
                    <td>{{$paymentmethod->getname()}}</td>
                    <td> <input type="number" min="0" name="orders[]" value="{{$paymentmethod->order}}"> </td>
                  </tr>
                  @endforeach
              </tbody>
            </table>

        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn btn-primary">{{__('admindash.actions.submit')}}</button>
          <a href="{{route('paymentmethods')}}" class="btn btn-default">{{__('admindash.actions.back')}}</a>
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
