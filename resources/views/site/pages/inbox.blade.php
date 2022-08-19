
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

    <div id="center_column" class="center_column col-xs-12 col-sm-9 col-md-9 col-lg-9">
      <h2>صندوق الرسائل</h2>
    <div id="smartblogcat" class="block">
      @if(count($messages))
        @foreach($messages as $message)

            <div itemtype="#" itemscope="" class="sdsarticleCat clearfix">
              <div id="smartblogpost-6">
                <!-- <div class="articleContent">
                    <span class="tm_details">
                        <span class="ofline_only tm_author">1</span>
                        </span>
                  <a href="#" class="imageFeaturedLink">
                        <img alt="user" src="images/ads2.jpg" class="imageFeatured">
                        </a>
                </div> -->
                        <p class="sdstitle_block">
                          <span class="tm_details">
                            @if(unreadcount($message->from,$message->to,$message->source)==0)
                              <span class="ofline_only tm_author">{{$message->total}}</span>
                            @else
                              <span class="online_only tm_author">{{unreadcount($message->from,$message->to,$message->source)}}</span>
                            @endif
                              </span>
                          <a href="{{route('messages',$message->from)}}"></i> {{$message->from==0?setting()->getname():store($message->from)->getname()}}</a>
                        </p>
                        <span class="blog_date">
                          <span class="day_date"> {{since($message->created_at)}}</span>
                        </span>
                        <div class="sdsarticle-des">
                          <span itemprop="description" class="clearfix">
                            <div id="lipsum">
                              <a href="{{route('messages',$message->from)}}"> {{$message->body}} </a>
                            </div>
                          </span>
                        </div>
                        <div class="sdsreadMore">
                          <span class="more">
                            <a href="#" class="r_more button-medium">
                                حذف
                            </a>
                          </span>
                        </div>
              </div>
            </div>
        @endforeach
      @else
        لا توجد رسائل
      @endif
    </div>

    </div>

   </div>
   </div>
@endsection
