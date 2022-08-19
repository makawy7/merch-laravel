<!-- Main Header -->
<header class="main-header">

  <!-- Logo -->
  <a href="{{route('admindash')}}" class="logo">
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
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-envelope-o"></i>
            <span class="label label-success">{{count(unreadcontactus())}}</span>
          </a>
          <ul class="dropdown-menu">
            <li class="header">
              @if(count(unreadcontactus())>0)
              {{__('admindash.contactus.youhave',['number'=>count(unreadcontactus())])}}
              @else
              {{__('admindash.contactus.nomessages')}}
              @endif
            </li>
            <li>
              <!-- inner menu: contains the messages -->
              <ul class="menu">
                @foreach(unreadcontactus() as $message)
                <li><!-- start message -->
                  <a href="{{route('contactus_messages')}}">
                    <!-- Message title and timestamp -->
                    <h4>
                      {{$message->title}}
                      <small><i class="fa fa-clock-o"></i>{{__('admindash.contactus.since',['number'=>$message->minago()])}}</small>
                    </h4>
                    <!-- The message -->
                    <p>{{$message->body}}</p>
                  </a>
                </li>
                <!-- end message -->
                @endforeach
              </ul>
              <!-- /.menu -->
            </li>
            <li class="footer"><a href="{{route('contactus_messages')}}">{{__('admindash.contactus.showall')}}</a></li>
          </ul>
        </li>
        <!-- /.messages-menu -->

        <!-- Notifications Menu -->
        <!-- <li class="dropdown notifications-menu"> -->
          <!-- Menu toggle button -->
          <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-bell-o"></i>
            <span class="label label-warning">10</span>
          </a>
          <ul class="dropdown-menu">
            <li class="header">You have 10 notifications</li>
            <li> -->
              <!-- Inner Menu: contains the notifications -->
              <!-- <ul class="menu">
                <li> -->
                  <!-- start notification -->
                  <!-- <a href="#">
                    <i class="fa fa-users text-aqua"></i> 5 new members joined today
                  </a>
                </li> -->
                <!-- end notification -->
              <!-- </ul>
            </li>
            <li class="footer"><a href="#">View all</a></li>
          </ul>
        </li> -->
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

            <!-- hidden-xs hides the username on small devices so only the image appears. -->
            <span class="hidden-xs">{{auth()->user()->name}}</span>
          </a>
          <ul class="dropdown-menu">
            <!-- The user image in the menu -->


            <!-- Menu Footer-->
            <li class="user-footer">
              <form class="logoutform" action="{{route('logout')}}" method="post">
                @csrf
              </form>
              <a href="#" onclick="$('.logoutform').submit();" class="btn btn-default btn-flat">Sign out</a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
