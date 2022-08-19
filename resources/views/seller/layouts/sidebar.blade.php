<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar direction">





    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <li class="header">HEADER</li>
      <!-- Optionally, you can add icons to the links -->
      @if(auth()->user()->id==auth()->user()->store->owner_id)
      <li><a href="{{route('storesettings')}}"><i class="fa fa-gears"></i> <span>{{__('sellerdash.storesettings')}}</span></a></li>
      @endif
      <li><a href="{{route('seller.product.index')}}"><i class="fa fa-cubes"></i> <span>{{__('sellerdash.product.manage_products')}}</span></a></li>
      <li><a href="{{route('seller.product.create')}}"><i class="fa fa-plus-square"></i> <span>{{__('sellerdash.product.addproduct')}}</span></a></li>
      <li><a href="{{route('storeprofits')}}"><i class="fa fa-money"></i> <span>ارباح المتجر</span></a></li>
      <li><a href="{{route('sellermessages')}}"><i class="fa fa-envelope-o"></i> <span>رسائل المتجر</span><span class="label label-primary pull-left">{{unreadcount(null,auth()->user()->store->id,'user')}}</span></a></li>
      <li><a href="{{route('index')}}"> <span>الصفحة الرئيسية</span></a></li>

      <!-- <li class="treeview">
        <a href="#"><i class="fa fa-cubes"></i> <span>{{__('admindash.product.products')}}</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
          <li><a href="{{route('product.index')}}">{{__('admindash.product.manage_products')}}</a></li>
          <li><a href="{{route('product.create')}}">{{__('admindash.product.addproduct')}}</a></li>
        </ul>
      </li> -->


    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>
