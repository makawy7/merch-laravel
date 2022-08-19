<!-- Main Header -->
<header class="main-header">

  <!-- Logo -->
  <a href="{{route('sellerindex')}}" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>A</b>LT</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>Admin</b>LTE</span>
  </a>

  <!-- Header Navbar -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- Messages: style can be found in dropdown.less-->
        <li class="dropdown messages-menu">
          <!-- Menu toggle button -->
          <a href="{{route('sellermessages')}}" >
            <i class="fa fa-envelope-o"></i>
            @if(unreadcount(null,auth()->user()->store->id,'user')!=0)
            <span class="label label-success">{{unreadcount(null,auth()->user()->store->id,'user')}}</span>
            @endif
          </a>

        </li>
        <!-- /.messages-menu -->


        <!-- Tasks Menu -->
        <li class="dropdown">
          <!-- Menu Toggle Button -->
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-language"></i>
          </a>
          <ul class="dropdown-menu">
            <li class="dropdown-item"> <a href="{{route('lang','ar')}}">عربي</a> </li>
            <li class="dropdown-item"> <a href="{{route('lang','en')}}">English</a> </li>
          </ul>
        </li>
        <!-- User Account Menu -->
        <li class="dropdown user user-menu">
          <!-- Menu Toggle Button -->
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <!-- The user image in the navbar-->

            <!-- hidden-xs hides the username on small devices so only the image appears. -->
            <span class="hidden-xs">{{auth()->user()->name}}</span>
          </a>

        </li>
      </ul>
    </div>
  </nav>
</header>
