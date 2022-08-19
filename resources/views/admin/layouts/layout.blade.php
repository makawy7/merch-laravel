@include('admin.layouts.header')
@include('admin.layouts.topbar')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      {{isset($title)?$title:''}}
    </h1>

  </section>
  <!-- Main content -->
  <section class="content">
    @include('admin.layouts.messages')
    @yield('content')

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@include('admin.layouts.sidebar')
@include('admin.layouts.footer')
