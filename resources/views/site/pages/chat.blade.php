
@extends('site.layouts.layout2')

@section('content')
<!-- === بداية محتوى الصفحة العمود الايمن والايسر ... ملحوظة ترتيب محتوى الصفحات مختلفة عن محتوى الصفحة الرئيسية ====== -->
<div id="columns" class="container">
  <div class="row" id="columns_inner">
    <!-- ================ بداية يمين الصفحة ============= -->
    <div id="left_column" class="col-xs-12 col-sm-3 col-md-3 col-lg-3">

      @include('site.includes.menu')
      @include('site.includes.myaccount')
    </div>
    <!-- ================ نهاية يمين الصفحة ============= -->

    <!-- ================ بداية وسط الصفحة ============= -->
    <div id="center_column" class="center_column col-xs-12 col-sm-9 col-md-9 col-lg-9">


<section id="tm-tabcontent" class="tm-tabcontent">

          <ul id="idTab5" class="tm_productinner tab-pane">
            <li>
              <div>
                <div id="new_comment_form">
                  <form id="chat" action="{{route('sendmessage',$store_id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <h2 class="page-subheading"><i class="fa fa-comments-o fa-2x"></i>مراسلة متجر "{{$store_id==0?setting()->getname():store($store_id)->getname()}}"</h2>
                    <div class="row">

                      <div class="new_comment_form_content">
                      @foreach($messages as $message)
                        <ul id="criterions_list">
                        <div class="articleContent">
                          <span class="tm_details">

                          </span>

                        </div>
                                <li>
                                  <label>{{$message->source=='store'?($message->from==0?setting()->getname():store($message->from)->getname()):auth()->user()->name}}</label>
                                  <div class="clearfix"></div>
                                    <span class="blog_date pa">
                                      <span class="day_date">{{$message->since()}}</span>
                                    </span>

                                </li>
                              </ul>

                        <div id="short_description_block">
                          <div id="short_description_content" class="padding10">
                            <p>
                              {!! $message->body !!}
                            </p>
                            <p>
                              @if($message->type=='image')
                                  <img src="{{url('storage/messages/'.$message->file)}}" style="width:100px" alt="">
                              @endif
                            </p>
                            @if($message->file && $message->type!='image')
                                  <small> <a href="{{url('storage/messages/'.$message->file)}}">{{$message->file}}</a> </small>
                            @endif
                            <div class="post-info">
                              @if($message->readat())
                                <span>
                                  <span class="tm_articleSection"><i id="read" class="fa fa-check"></i></span>
                                  <span class="tm_dateCreated">{{$message->readat()}} </span>
                                </span>
                              @endif
                            </div>
                          </div>
                        </div>
                        <hr>
                      @endforeach


                        <label for="content"> رسالتك :</label>
                        <textarea id="content" name="Message" rows="5" cols="50"></textarea>
                        <div id="new_comment_form_footer">
                          <input id="id_product_comment_send" name="id_product" type="hidden" value='5' />
                          <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 padding-right padding-left">
                          <div class="uploader" id="uniform-fileUpload"><input name="fileUpload" id="fileUpload" class="form-control" type="file">
                          <span class=" btn btn-sm btn-default" ><i class="fa fa-paperclip"></i> أرفق ملفات</span>
                          </div>
                          </div>
                         <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                          <button id="submitNewMessage" name="submitMessage" onclick="$('#chat').submit();" type="submit" class="btn-info btn button button-small"> <span>إرسال</span> </button>
                         </div>
                          <div class="clearfix"></div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </li>
          </ul>
      </section>
        </div>
       <!-- ================ نهاية وسط الصفحة ============= -->

  </div>
</div>

<!-- ==== نهاية محتوى الصفحة العمود الايمن والايسر ... ملحوظة ترتيب محتوى الصفحات مختلفة عن محتوى الصفحة الرئيسية === -->

@endsection
