<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar direction">





    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <li class="header">HEADER</li>
      <!-- Optionally, you can add icons to the links -->
      <li><a href="{{route('settings')}}"><i class="fa fa-gears"></i> <span>{{__('admindash.settings.settings')}}</span></a></li>
      <li class="treeview">
        <a href="#"><i class="fa fa-map-signs"></i> <span>{{__('admindash.mainpage.managemainpage')}}</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
          <li><a href="{{route('banners')}}">{{__('admindash.mainpage.banners')}}</a></li>
          <li><a href="{{route('scats')}}">{{__('admindash.mainpage.specialcat')}}</a></li>
          <li><a href="{{route('ads')}}">{{__('admindash.mainpage.bannerads')}}</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-users"></i> <span>{{__('admindash.account.accounts')}}</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li>
            <a href="#"><i class="fa fa-circle-o"></i> {{__('admindash.account.users')}} <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <li><a href="{{route('user.index')}}"></i> {{__('admindash.account.manage_users')}}</a></li>
              <li><a href="{{route('user.create')}}"></i> {{__('admindash.account.adduser')}}</a></li>
            </ul>
          </li>

          <li>
            <a href="#"><i class="fa fa-circle-o"></i> {{__('admindash.account.admins')}} <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <li><a href="{{route('admin.index')}}"></i> {{__('admindash.account.manage_admins')}}</a></li>
            </ul>
          </li>
          <!-- <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li> -->
        </ul>
      </li>
      <li class="treeview">
        <a href="#"><i class="fa fa-sitemap"></i> <span>{{__('admindash.maincat.maincats')}}</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
          <li><a href="{{route('maincat.index')}}">{{__('admindash.maincat.manage_maincats')}}</a></li>
          <li><a href="{{route('maincat.create')}}">{{__('admindash.maincat.addmaincat')}}</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#"><i class="fa fa-map-signs"></i> <span>{{__('admindash.subcat.subcats')}}</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
          <li><a href="{{route('subcat.index')}}">{{__('admindash.subcat.manage_subcats')}}</a></li>
          <li><a href="{{route('subcat.create')}}">{{__('admindash.subcat.addsubcat')}}</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#"><i class="fa  fa-clone"></i> <span>{{__('admindash.type.types')}}</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
          <li><a href="{{route('type.index')}}">{{__('admindash.type.manage_types')}}</a></li>
          <li><a href="{{route('type.create')}}">{{__('admindash.type.addtype')}}</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#"><i class="fa fa-tags"></i> <span>{{__('admindash.brand.brands')}}</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
          <li><a href="{{route('brand.index')}}">{{__('admindash.brand.manage_brands')}}</a></li>
          <li><a href="{{route('brand.create')}}">{{__('admindash.brand.addbrand')}}</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#"><i class="fa fa-cubes"></i> <span>{{__('admindash.product.products')}}</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
          <li><a href="{{route('product.index')}}">{{__('admindash.product.manage_products')}}</a></li>
          <li><a href="{{route('product.create')}}">{{__('admindash.product.addproduct')}}</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-globe"></i> <span>{{__('admindash.countriesandcities.countriesandcities')}}</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li>
            <a href="#"><i class="fa fa-circle-o"></i> {{__('admindash.countriesandcities.countries')}} <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <li><a href="{{route('countries')}}"></i> {{__('admindash.countriesandcities.manage_countries')}}</a></li>
              <li><a href="{{route('addcountry')}}"></i> {{__('admindash.countriesandcities.add_country')}}</a></li>
            </ul>
          </li>
          <li>
            <a href="#"><i class="fa fa-circle-o"></i> {{__('admindash.countriesandcities.cities')}} <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <li><a href="{{route('cities')}}"></i> {{__('admindash.countriesandcities.manage_cities')}}</a></li>
              <li><a href="{{route('addcity')}}"></i> {{__('admindash.countriesandcities.add_city')}}</a></li>
            </ul>
          </li>
          <!-- <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li> -->
        </ul>
      </li>
      <li class="treeview">
        <a href="#"><i class="fa fa-truck"></i> <span>{{__('admindash.shippingmethods.shippingmethods')}}</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
          <li><a href="{{route('shippingmethods')}}">{{__('admindash.shippingmethods.manage_shippingmethod')}}</a></li>
          <li><a href="{{route('addshippingmethod')}}">{{__('admindash.shippingmethods.add_shippingmethod')}}</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#"><i class="fa fa-usd"></i> <span>{{__('admindash.currencies.currencies')}}</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
          <li><a href="{{route('currencies')}}">{{__('admindash.currencies.manage_currency')}}</a></li>
          <li><a href="{{route('addcurrency')}}">{{__('admindash.currencies.add_currency')}}</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#"><i class="fa fa-credit-card"></i> <span>{{__('admindash.paymentmethods.paymentmethods')}}</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
          <li><a href="{{route('paymentmethods')}}">{{__('admindash.paymentmethods.managepaymentmethods')}}</a></li>
          <li><a href="{{route('addpaymentmethod')}}">{{__('admindash.paymentmethods.addpaymentmethod')}}</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#"><i class="fa fa-gg"></i> <span>{{__('admindash.statuses.statuses')}}</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
          <li><a href="{{route('statuses')}}">{{__('admindash.statuses.managestatuses')}}</a></li>
          <li><a href="{{route('addstatus')}}">{{__('admindash.statuses.addstatus')}}</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#"><i class="fa fa-shopping-cart"></i> <span>{{__('admindash.orders.orders')}}</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
          <li><a href="{{route('orders')}}">{{__('admindash.orders.manageorders')}}</a></li>
          <li><a href="{{route('deliveredorders')}}">{{__('admindash.orders.deliveredorders')}}</a></li>
        </ul>
      </li>
      <li><a href="{{route('adminmessages')}}"><i class="fa fa-envelope-o"></i> <span>رسائل المتجر</span><span class="label label-primary pull-left">{{unreadcount(null,0,'user')}}</span></a></li>
      <li class="treeview">
        <a href="#"><i class="fa fa-bullseye"></i> <span>{{__('admindash.plans.plans')}}</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
          <li><a href="{{route('plans.index')}}">{{__('admindash.plans.manageplans')}}</a></li>
          <li><a href="{{route('plans.create')}}">{{__('admindash.plans.addplan')}}</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#"><i class="fa fa-briefcase"></i> <span>{{__('admindash.subpayments.subpayments')}}</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
          <li><a href="{{route('subpaymentmethods.index')}}">{{__('admindash.subpayments.managesubpayments')}}</a></li>
          <li><a href="{{route('subpaymentmethods.create')}}">{{__('admindash.subpayments.addsubpayment')}}</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#"><i class="fa fa-user"></i> <span>{{__('admindash.subscriptions.subscriptions')}}</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
          <li><a href="{{route('subscriptions')}}">{{__('admindash.subscriptions.managesubscriptions')}}</a></li>
        </ul>
      </li>
      <li><a href="{{route('stores')}}"><i class="fa fa-building-o"></i> <span>{{__('admindash.stores.stores')}}</span></a></li>
      <li><a href="{{route('profits')}}"><i class="fa fa-money"></i> <span>{{__('admindash.profits.web_profits')}}</span></a></li>


      <li><a href="{{route('rewards')}}"><i class="fa fa-trophy"></i> <span>{{__('admindash.rewards.rewards')}}</span></a></li>
      <li><a href="{{route('contactus_messages')}}"><i class="fa fa-envelope-o"></i> <span>{{__('admindash.contactus.messages')}}</span></a></li>


    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>
