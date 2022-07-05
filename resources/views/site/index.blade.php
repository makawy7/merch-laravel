
@extends('site.layouts.layout')

@section('content')

<!-- ================ بداية slider ============= -->
  <div id="slider_row" class="">
    <div id="top_column" class="center_column col-xs-12 col-sm-12">
      <div class="container vertical">
        <div id="tm_vertical_menu_top" class="tmvm-contener clearfix col-lg-12">
          <div class="block-title">
            <div class="cat-title">جميع الأقسام والمناسبات</div>
            <div class="title-arrow"></div>
          </div>
          <ul class="tmvm-menu clearfix tmvmmenu-content">
            @if(function_exists('maincats') && count(maincats())>0)
                @foreach(maincats() as $maincat)
                  <li class="tm-haschild"><a href="#" title="{{$maincat->getName()}}">{{$maincat->getName()}}</a>
                    <div class="tmvm_menu_container">
                      <div class="tmvm_menu_inner" style="width:388px;">
                        <div class="tmvm_menu_col col2">
                          <ul>
                            @foreach($maincat->subcats as $subcat)
                              <li class="tm-hassubchild"><a href="{{route('show.subcat',$subcat->getslug())}}" title="{{$subcat->getName()}}">{{$subcat->getName()}}</a>
                                <ul>
                                  @foreach($subcat->types as $type)
                                    <li class=""><a href="{{route('show.type',$type->getslug())}}" title="{{$type->getName()}}">{{$type->getName()}}</a></li>
                                  @endforeach
                                </ul>
                              </li>
                            @endforeach
                            @foreach(ads(1) as $ad)
                             <li class="category-thumbnail">
                               <div><img src="{{url('storage/images/ads/'.$ad->image)}}" alt="{{$ad->gettitle()}}" title="{{$ad->gettitle()}}" class="imgm" /></div>
                             </li>
                           @endforeach
                          </ul>
                        </div>
                      </div>
                    </div>
                  </li>
                @endforeach
            @endif
          </ul>
        </div>
      </div>
      <div class="flexslider">
        <ul class="slides">
          @foreach(banners() as $banner)
          <li class="tmhomeslider-container" id="slide_1"> <a href="{{$banner->url}}"> <img src="{{url('storage/images/banners/'.$banner->image)}}" alt="{{$banner->gettitle()}}" title="{{$banner->gettitle()}}"/> </a> </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
<!-- ================ نهاية slider ============= -->
<!-- ================ بداية أحدث المنتجات ============= -->
<div class="columns-container">
  <div class="container">
    <div id="tmcategoryslider" class="block products_block clearfix">
      <ul id="tmcategory-tabs" class="nav nav-tabs clearfix">
        <li class="first_item active"> <a href="#tab_3" data-toggle="tab">أحدث المنتجات</a> </li>
      </ul>
      <div class="tab-content">
        <div id="tab_3" class="tab_content tab-pane">
          <div class="block_content row">
            <ul id="tm_3" class="tm-carousel product_list">
              @foreach($newestproducts as $product)
                @include('site.includes.productelement')
              @endforeach
            </ul>
          </div>
          <div class="customNavigation"> <a class="btn prev tmcategory_prev"></a> <a class="btn next tmcategory_next"></a> </div>
          <script>
          $(document).ready(function() {
            var owl3 = $("#tm_3");
            owl3.owlCarousel({
              items : 5, //10 items above 1000px browser width
              itemsDesktop : [1200,4],
              itemsDesktopSmall : [991,3],
              itemsTablet: [767,2],
              itemsMobile : [480,1]
            });
            $("#tab_3 .tmcategory_next").click(function(){
              owl3.trigger('owl.next');
            })
            $("#tab_3 .tmcategory_prev").click(function(){
              owl3.trigger('owl.prev');
            })
          });
      </script>
        </div>
      </div>
    </div>
    <script type="text/javascript">
$(document).ready(function() {
  $('#tmcategory-tabs li:first, #tmcategoryslider .tab-content div:first').addClass('active');
});
</script>
  </div>
</div>
<!-- ================ نهاية أحدث المنتجات ============= -->
<!-- ================ بداية  المنتجات الشائعة ============= -->
<div class="columns-container">
  <div class="container">
    <div id="tmcategoryslider" class="block products_block clearfix">
      <ul id="tmcategory-tabs" class="nav nav-tabs clearfix">
        <li class="first_item active"><a href="#" data-toggle="tab"> الأقسام المميزة</a> </li>
      </ul>
    </div>
    <div class="row">
      <div id="tmcmssubbannerblock" class="container">
        <div class="subbanner-cms">

          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="leftpart">
              <div class="subbanner4"><a href="{{scats()[0]->url}}"><img class="img-respo" src="{{url('storage/images/scats/'.scats()[0]->image)}}" /></a> </div>
              <a href="products.html">
              <h3 class="page-subheading">{{scats()[0]->gettitle()}}</h3>
              </a> </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 padding0">
            @php $counter=1; @endphp
            @foreach(scats() as $scat)
              @if($counter!=1)
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                  <div class="leftpart">
                    <div class="cms-box">
                      <div class="subbanner4"><a href="{{$scat->url}}"><img class="img-respo" src="{{url('storage/images/scats/'.$scat->image)}}" /></a> </div>
                      <a href="products.html">
                      <h3 class="page-subheading">{{$scat->gettitle()}}</h3>
                      </a> </div>
                  </div>
                </div>
              @endif
            @php $counter++; @endphp
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- ================ نهاية  المنتجات الشائعة ============= -->
<!-- ================ بداية  الأكثر مبيعا ============= -->
<div class="columns-container">
  <div class="container">
    <div id="tmcategoryslider2" class="block products_block clearfix">
      <ul id="tmcategory-tabs2" class="nav nav-tabs clearfix">
        <li class="first_item active"> <a href="#tab_4" data-toggle="tab">الأكثر مبيعا</a> </li>
      </ul>
      <div class="tab-content">
        <div id="tab_4" class="tab_content tab-pane">
          <div class="block_content row">
            <ul id="tm_4" class="tm-carousel product_list">
              @foreach($topsoldproducts as $product)
                @include('site.includes.productelement')
              @endforeach
            </ul>
          </div>
          <div class="customNavigation"> <a class="btn prev tmcategory_prev"></a> <a class="btn next tmcategory_next"></a> </div>
          <script>
          $(document).ready(function() {
            var owl3 = $("#tm_4");
            owl3.owlCarousel({
              items : 5, //10 items above 1000px browser width
              itemsDesktop : [1200,4],
              itemsDesktopSmall : [991,3],
              itemsTablet: [767,2],
              itemsMobile : [480,1]
            });
            $("#tab_4 .tmcategory_next").click(function(){
              owl3.trigger('owl.next');
            })
            $("#tab_4 .tmcategory_prev").click(function(){
              owl3.trigger('owl.prev');
            })
          });
      </script>
        </div>
      </div>
    </div>
    <script type="text/javascript">
$(document).ready(function() {
  $('#tmcategory-tabs2 li:first, #tmcategoryslider2 .tab-content div:first').addClass('active');
});
</script>
  </div>
</div>
<!-- ================ نهاية  الأكثر مبيعا ============= -->
<!-- ================ بداية  الأعلانات ============= -->
<div class="columns-container">
  <div class="container">
    <div id="tmcmsbannerblock1" class="container">
      <div class="fashion-cms">

        @php $counter=1 @endphp
        @foreach(ads(2) as $ad)
          <div class="subbanner-{{$counter==1?'one':'two'}}">
            <div class="inner-content2"><a href="{{$ad->url}}"><img class="img-respo" src="{{url('storage/images/ads/'.$ad->image)}}"/></a></div>
          </div>
        @php $counter=$counter+1 @endphp
        @endforeach
      </div>
    </div>
  </div>
</div>
<!-- ================ نهاية  الأعلانات ============= -->


@endsection
