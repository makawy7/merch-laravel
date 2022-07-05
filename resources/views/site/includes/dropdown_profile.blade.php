<div class="dropdown">
    <p data-target="#" href="#" data-toggle="dropdown" class="style dropdown-toggle">
    <i class="fa fa-user"></i>
    <strong>أهلا بك</strong> {{auth()->user()->name}}
     </p>
    <ul class="dropdown-menu account">
    <li><a href="{{route('myaccount')}}">الملف الشخصي</a></li>
    <li><a href="{{route('wishlist')}}">الأماني</a></li>
    <li><a href="{{route('myorders')}}">الطلبات</a></li>
    <li><a href="{{route('addresses')}}">عنوان الشحن</a></li>
    <form class="hide logout-form" action="{{route('logout')}}" method="post">
      @csrf
    </form>
    <li><a href="#" onclick="$('.logout-form').submit();">خروج</a></li>
</ul>
</div>
