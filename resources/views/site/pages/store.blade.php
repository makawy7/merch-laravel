
@extends('site.layouts.layout2')

@section('content')

<div id="columns" class="container">
    <div class="row" id="columns_inner">
      <div id="left_column" class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
        @include('site.includes.menu')
        <div id="layered_block_left" class="block">
          <p class="title_block">الفهرس</p>
          <div class="block_content">
            <form action="#" id="layered_form">
              <div>
                <div class="layered_filter">
                  <div class="layered_subtitle_heading">
                  <span class="layered_subtitle">التصنيفات</span>
                  </div>
                  <ul class="col-lg-12 layered_filter_ul">
                    @foreach(maincats() as $maincat)
                      @foreach($maincat->subcats as $subcat)
                        <li class="nomargin hiddable col-lg-12">
                            <input type="radio" name="type" data-type="type" class="categories" value="{{$subcat->id}}">
                            <label> <a href="#" data-rel="nofollow">{{$subcat->getname()}}</a> </label>
                        </li>
                      @endforeach
                    @endforeach
                  </ul>
                </div>
                <div class="layered_price">
                  <div class="layered_subtitle_heading"> <span class="layered_subtitle">السعر</span>
                  </div>
                  <ul id="ul_layered_price_0" class="col-lg-12 layered_filter_ul">
                    <span id="layered_price_range">66.00ل.س - 572.00 ل.س</span>
                    <div class="layered_slider_container">
                      <div class="layered_slider ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="layered_price_slider" data-type="price" data-format="1" data-unit="$" aria-disabled="false">
                        <div class="ui-slider-range ui-widget-header ui-corner-all" style="left: 0%; width: 100%;"></div>
                        <a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 0%;"></a><a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 100%;"></a></div>
                    </div>
                  </ul>
                </div>
              </div>
              <input type="hidden" name="id_category_layered" value="3" />
            </form>
          </div>
        </div>
        @include('site.includes.myaccount')
      </div>
      <div id="center_column" class="center_column col-xs-12 col-sm-9 col-md-9 col-lg-9">
        <div class="breadcrumbdiv">
          <div class="breadcrumb container clearfix">

            <div class="breadcrumbs"> <a class="home" href="{{route('index')}}" title="Return to Home"><i class="icon-home"></i></a> <span class="navigation-pipe">&gt;</span>متجر "{{$store_name}}"</div>
          </div>
        </div>

        @include('site.includes.adproductspage')
        <div id="search_block_top" >
              <form method="get" class="storesearch" action="#" id="searchbox">
                <input class="search_query form-control" type="text" name="search" placeholder="ابحث في المتجر" value="" />
                <button id="searchsubmit" type="submit"  class="btn btn-default button-search"> </button>
              </form>
          </div>
        @include('site.includes.sort')
        <h2>متجر "{{$store_name}}"</h2>
        @if(auth()->user())
          <small> <a href="{{route('messages',$storeid)}}">مراسلة المتجر</a> </small>
        @endif


<div id="content">

        <ul class="product_list grid row">
          <div class="block_content row">
            @if(count($products)>0)
              @foreach($products as $product)
                @include('site.includes.productelement')
              @endforeach
            @else
              <h3 class="text-center">لا توجد منتجات</h3>
            @endif

          </div>
        </ul>
        <div class="content_sortPagiBar">
      <div class="bottom-pagination-content clearfix">

    <div id="pagination_bottom" class="pagination clearfix">

        {{ $products->links() }}

    </div>

      </div>
    </div>
</div>

        <div class="clear"></div>
      </div>
    </div>
    </div>



@endsection




@push('scripts')

<script type="text/javascript">

$(document).ready(function(){

  $('.categories').on('change',function(){

    var val=$('.sortby').find('option:selected').val();
    var cat=$('.categories:checked').val();
    var word=$('.storesearch input').val();

    if(cat==undefined){
      cat='';
    }
    if(val==undefined){
      val='';
    }
    if(word==undefined){
      word='';
    }

    $.ajax({
      url:`{!!request()->fullUrl()!!}?&sort=${val}&cat=${cat}&word=${word}&storeid={{$storeid}}`,
      method:'get',
      success:function(data){
        $('#content').html(data.html);
      },
      error:function(data){

      }
    });
  });

  $('.sortby').on('change',function(){
    var val=$(this).find('option:selected').val();
    var cat=$('.categories:checked').val();
    var word=$('.storesearch input').val();

    if(cat==undefined){
      cat='';
    }
    if(val==undefined){
      val='';
    }
    if(word==undefined){
      word='';
    }

    $.ajax({
      url:`{!!request()->fullUrl()!!}?&sort=${val}&cat=${cat}&word=${word}&storeid={{$storeid}}`,
      method:'get',
      success:function(data){
        $('#content').html(data.html);
      },
      error:function(data){

      }
    });

  });

  $('#searchsubmit').on('click',function(e){
    e.preventDefault();
    var val=$('.sortby').find('option:selected').val();
    var cat=$('.categories:checked').val();
    var word=$('.storesearch input').val();

    if(cat==undefined){
      cat='';
    }
    if(val==undefined){
      val='';
    }
    if(word==undefined){
      word='';
    }

    $.ajax({
      url:`{!!request()->fullUrl()!!}?&sort=${val}&cat=${cat}&word=${word}&storeid={{$storeid}}`,
      method:'get',
      success:function(data){
        $('#content').html(data.html);
      },
      error:function(data){

      }
    });

  });
}).ajaxStart(function () {
    $('#loading').removeClass('hide');
  })
  .ajaxStop(function () {
    $('#loading').addClass('hide');
  });

</script>


@endpush
