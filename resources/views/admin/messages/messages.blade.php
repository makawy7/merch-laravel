

@extends('admin.layouts.layout')


@section('content')
@include('admin.datatable.includes.deletemodal')

<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">رسائل المتجر</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="col-md-12">
            <div class="box box-primary">

              <!-- /.box-header -->
              <div class="box-body no-padding">

                <div class="table-responsive mailbox-messages">
                  <table class="table table-hover table-striped">
                    <tbody>
                      @foreach($messages as $message)
                        <tr>
                            <td><div class="icheckbox_flat-blue" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div></td>
                            <td class="mailbox-star">
                              @if(unreadcount($message->from,0,$message->source)==0)
                                <span class="label label-default pull-left" style="font-size:14px">{{$message->total}}</span>
                              @else
                                <span class="label label-success pull-left" style="font-size:14px">{{unreadcount($message->from,0,$message->source)}}</span>
                              @endif
                            </td>
                            <td class="mailbox-name">{{user($message->from)->name}}</td>
                            <td class="mailbox-subject"><a href="{{route('adminmessage',$message->from)}}">{{$message->body}}
                            </a></td>
                            <td class="mailbox-date">{{since($message->created_at)}}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                  <!-- /.table -->
                </div>
                <!-- /.mail-box-messages -->
              </div>

            </div>
            <!-- /. box -->
          </div>
      </div>
      <!-- /.box-body -->
    </div>

  </div>

</div>

@endsection
