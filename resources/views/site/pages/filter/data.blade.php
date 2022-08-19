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
