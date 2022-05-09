<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Wonbet | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('public/adminThemes')}}/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('public/adminThemes')}}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('public/adminThemes')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('public/adminThemes')}}/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('public/adminThemes')}}/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('public/adminThemes')}}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('public/adminThemes')}}/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('public/adminThemes')}}/plugins/summernote/summernote-bs4.min.css">


  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('public/adminThemes')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('public/adminThemes')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('public/adminThemes')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{asset('public/adminThemes')}}/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{asset('public/adminThemes')}}/plugins/toastr/toastr.min.css">

  <!-- Custome style -->
  <link rel="stylesheet" href="{{asset('public/adminThemes')}}/dist/css/custome_style.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{asset('public/adminThemes')}}/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-indigo elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="{{asset('public/statics/logo2.png')}}" alt="Wonbet Logo" class="brand-image img-circle elevation-3" style="opacity: .8;height:50px;width:35px;">
        <span class="brand-text font-weight-light">WONBET</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="{{asset('public/adminThemes')}}/dist/img/user8-128x128.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">{{Auth::user()->name}}</a>
          </div>
        </div>

        <!-- SidebarSearch Form -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <!-- <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.html" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>
            </ul>
          </li> -->
            <li class="nav-item">
              <a href="{{url('/dashboard')}}" class="nav-link {{Request::segment(1)=='dashboard' ? 'active' : ''}}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <!-- Sub Admin Start -->
            @if(Auth::user()->userRole==config('services.userRole.SUPERADMIN'))
            <li class="nav-item {{Request::segment(1)=='inSubAdmin' ? 'menu-open' : ''}}">
              <a href="#" class="nav-link {{Request::segment(1)=='inSubAdmin' ? 'active' : ''}}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Sub Admin
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{url('/inSubAdmin')}}" class="nav-link {{Request::segment(1)=='inSubAdmin' ? 'active' : ''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>All Sub Admin's</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('/inSubAdmin/create')}}" class="nav-link {{(Request::segment(1)=='inSubAdmin' && Request::segment(2)=='create') ? 'active' : ''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Create Sub Admin</p>
                  </a>
                </li>
              </ul>
            </li>
            @endif
            <!-- Sub Admin End -->

            <!-- Master Start -->
            @if(in_array(Auth::user()->userRole,[config('services.userRole.SUPERADMIN'),config('services.userRole.SUBADMIN')]))
            <li class="nav-item {{Request::segment(1)=='inMasters' ? 'menu-open' : ''}}">
              <a href="#" class="nav-link {{Request::segment(1)=='inMasters' ? 'active' : ''}}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Masters
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{url('/inMasters')}}" class="nav-link {{Request::segment(1)=='inMasters' ? 'active' : ''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>All Masters</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('/inMasters/create')}}" class="nav-link {{(Request::segment(1)=='inMasters' && Request::segment(2)=='create') ? 'active' : ''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Create Master</p>
                  </a>
                </li>
              </ul>
            </li>
            @endif
            <!-- Master End -->

            <!-- Super Agent Start -->
            @if(in_array(Auth::user()->userRole,[config('services.userRole.SUPERADMIN'),config('services.userRole.SUBADMIN'),config('services.userRole.MASTER')]))
            <li class="nav-item {{Request::segment(1)=='inSuperAgent' ? 'menu-open' : ''}}">
              <a href="#" class="nav-link {{Request::segment(1)=='inSuperAgent' ? 'active' : ''}}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Super Agent
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{url('/inSuperAgent')}}" class="nav-link {{Request::segment(1)=='inSuperAgent' ? 'active' : ''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>All Super Agent's</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('/inSuperAgent/create')}}" class="nav-link {{(Request::segment(1)=='inSuperAgent' && Request::segment(2)=='create') ? 'active' : ''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Create Super Agent</p>
                  </a>
                </li>
              </ul>
            </li>
            @endif
            <!-- Super Agent End -->

            <!-- Agent Start -->
            @if(in_array(Auth::user()->userRole,[config('services.userRole.SUPERADMIN'),config('services.userRole.SUBADMIN'),config('services.userRole.MASTER'),config('services.userRole.SUPERAGENT')]))
            <li class="nav-item {{Request::segment(1)=='inAgent' ? 'menu-open' : ''}}">
              <a href="#" class="nav-link {{Request::segment(1)=='inAgent' ? 'active' : ''}}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Agent
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{url('/inAgent')}}" class="nav-link {{(Request::segment(1)=='inAgent' && Request::segment(2)=='') ? 'active' : ''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>All Agent's</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('/inAgent/create')}}" class="nav-link {{(Request::segment(1)=='inAgent' && Request::segment(2)=='create') ? 'active' : ''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Create Agent</p>
                  </a>
                </li>
              </ul>
            </li>
            @endif
            <!-- Agent End -->

            <!-- Client Start -->
            <li class="nav-item {{Request::segment(1)=='inClient' ? 'menu-open' : ''}}">
              <a href="#" class="nav-link {{Request::segment(1)=='inClient' ? 'active' : ''}}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Client
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{url('/inClient')}}" class="nav-link {{(Request::segment(1)=='inClient' && Request::segment(2)=='') ? 'active' : ''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>All Client's</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('/inClient/create')}}" class="nav-link {{(Request::segment(1)=='inClient' && Request::segment(2)=='create') ? 'active' : ''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Create Client</p>
                  </a>
                </li>
              </ul>
            </li>
            <!-- Client End -->

            <li class="nav-item">
              <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();$('#formLogout').submit();">
                <i class="nav-icon fas fa-power-off"></i>
                <p>Logout</p>
              </a>
              <form method="POST" action="{{ route('logout') }}" id="formLogout">
                @csrf
              </form>
            </li>

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) --><br>
          @yield('content')
          <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- <footer class="main-footer">
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.1.0
      </div>
    </footer> -->

    <!-- Control Sidebar -->
    <!-- <aside class="control-sidebar control-sidebar-dark"> -->
    <!-- Control sidebar content goes here -->
    <!-- </aside> -->
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="{{asset('public/adminThemes')}}/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{asset('public/adminThemes')}}/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('public/adminThemes')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="{{asset('public/adminThemes')}}/plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="{{asset('public/adminThemes')}}/plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="{{asset('public/adminThemes')}}/plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="{{asset('public/adminThemes')}}/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="{{asset('public/adminThemes')}}/plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="{{asset('public/adminThemes')}}/plugins/moment/moment.min.js"></script>
  <script src="{{asset('public/adminThemes')}}/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="{{asset('public/adminThemes')}}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="{{asset('public/adminThemes')}}/plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="{{asset('public/adminThemes')}}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('public/adminThemes')}}/dist/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{asset('public/adminThemes')}}/dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{asset('public/adminThemes')}}/dist/js/pages/dashboard.js"></script>

  <!-- DataTables  & Plugins -->
  <script src="{{asset('public/adminThemes')}}/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="{{asset('public/adminThemes')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="{{asset('public/adminThemes')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="{{asset('public/adminThemes')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="{{asset('public/adminThemes')}}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="{{asset('public/adminThemes')}}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="{{asset('public/adminThemes')}}/plugins/jszip/jszip.min.js"></script>
  <script src="{{asset('public/adminThemes')}}/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="{{asset('public/adminThemes')}}/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="{{asset('public/adminThemes')}}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="{{asset('public/adminThemes')}}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="{{asset('public/adminThemes')}}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


  <!-- SweetAlert2 -->
  <script src="{{asset('public/adminThemes')}}/plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- Toastr -->
  <script src="{{asset('public/adminThemes')}}/plugins/toastr/toastr.min.js"></script>

  <!-- jquery-validation -->
  <script src="{{asset('public/adminThemes')}}/plugins/jquery-validation/jquery.validate.min.js"></script>
  <script src="{{asset('public/adminThemes')}}/plugins/jquery-validation/additional-methods.min.js"></script>

  @if(Session::has('msgOK'))
  <script type="text/javascript">
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    Toast.fire({
      icon: 'success',
      title: "{{Session::get('msgOK')}}"
    });
    //toastr.success("{{-- Session::get('msgOK')--}}");
  </script>
  @endif

  @if(Session::has('msgERR'))
  <script type="text/javascript">
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    Toast.fire({
      icon: 'error',
      title: "{{Session::get('msgErr')}}"
    });
    // toastr.error("{{-- Session::get('msgErr')--}}");
  </script>
  @endif



  @yield('javascript')

</body>

</html>