@if(auth()->user())
  <section id="informations_block_left_1" class="block informations_block_left">
    <p class="title_block"><a href="#">حسابى</a></p>
    <div class="block_content list-block">
      <ul>
        <li><a href="{{route('myaccount')}}">الملف الشخصي</a></li>
      <li><a href="{{route('wishlist')}}">منتجات اعجبتنى</a></li>
        <li><a href="{{route('myorders')}}">طلباتى</a></li>
        <li><a href="{{route('cart.index')}}">سلة المشتريات</a></li>
        <li><a href="{{route('addresses')}}">عناوين الشحن</a></li>
        <li><a href="{{route('account')}}">إعدادات الحساب</a></li>
        <li><a href="{{route('inbox')}}">الرسائل</a></li>
        <form class="hide logout-form" action="{{route('logout')}}" method="post">
          @csrf
        </form>
        <li><a href="#" onclick="$('.logout-form').submit();">خروج</a></li>
      </ul>
    </div>
  </section>
@endif
