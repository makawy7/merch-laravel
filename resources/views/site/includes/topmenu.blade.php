<div class="block tm_links_block1" id="tm_toplink">
  <div class="cat-title"></div>
  <ul class="block_content list-block">
    <li><a href="{{route('bestselling')}}">الأكثر مبيعا</a></li>
    @if(auth()->user())
    <li><a href="{{route('wishlist')}}">المفضلة</a></li>
    @endif
    <li><a href="{{route('terms')}}">شروط وأحكام</a></li>
    <li><a href="{{route('returnpolicy')}}">سياسة الإسترجاع</a></li>
    <li><a href="{{route('privacypolicy')}}">سياسة الخصوصية</a></li>
    <li><a href="{{route('contactus')}}">إتصل بنا</a></li>
  </ul>

</div>
