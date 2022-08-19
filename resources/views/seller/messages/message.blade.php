

@extends('seller.layouts.layout')


@section('content')


<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <div class="box box-primary">
            <div class="box-header ui-sortable-handle">
              <h3 class="box-title">عرض المحادثة</h3>
              <i class="fa fa-comments-o"></i>

            </div>
            <div class="slimScrollDiv" ><div class="box-body chat" id="chat-box" >
              @foreach($messages as $message)
                <!-- chat item -->
                <div class="item">
                  <img style="visibility:hidden" src="{{url('des/admin/rtl')}}/dist/img/user4-128x128.jpg" alt="user image" class="online">

                  <p class="message">
                    <a href="#" class="name">
                      <small class="text-muted pull-left"><i class="fa fa-clock-o"></i> {{$message->since()}}</small>
                      {{$message->source=='store'?auth()->user()->store->getname():user($message->from)->name}}
                    </a>
                    {!! $message->body !!}
                  </p>
                  <p>
                    @if($message->type=='image')
                        <img src="{{url('storage/messages/'.$message->file)}}" style="width:100px" alt="">
                    @endif
                  </p>
                  @if($message->file && $message->type!='image')
                        <div class="attachment">
                          <a href="{{url('storage/messages/'.$message->file)}}" class="filename">
                            {{$message->file}}
                          </a>
                        </div>
                  @endif

                  <!-- /.attachment -->
                </div>
              @endforeach
              <!-- /.item -->
              <!-- chat item -->

            </div><div class="slimScrollBar" style="background: rgb(0, 0, 0); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 184.911px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
            <!-- /.chat -->
            <div class="box-footer">
              <form id="sendmessageform" action="{{route('sellersend',$user)}}" method="post">
                @csrf
                <div class="input-group">
                  <input class="form-control" name="body" placeholder="">
                  <div class="input-group-btn">
                    <button type="button" onclick="$('#sendmessageform').submit();" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                  </div>
                </div>

              </form>
            </div>
          </div>

  </div>

</div>

@endsection
