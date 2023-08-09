{{-- 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/template/admin/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="/template/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="/template/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="/template/admin/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/template/admin/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="/template/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="/template/admin/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="/template/admin/plugins/summernote/summernote-bs4.min.css">
</head>
<body>
<div class="container">
  <!-- Preloader -->
  <img src ="/bg-main.png" height ="300" width = "100% ">
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/admin" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a class="nav-link">Welcome {{session('user-name')}}</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a class="nav-link" href ="/logout">Log Out</a>
        </li>
    </ul>
  </nav>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"></h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>USER</h3>
                <p>New Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add text-white"></i>
              </div>
              <a href="/admin/userManagement" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">  
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>CHECKING</h3>
                <p>Bounce Rate</p>
              </div>
              <div class="icon">
                <i class="ion ion-location text-white" ></i>
              </div>
              <a href="/admin/userManagement/adminCheck" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>ROOM</h3>
                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-home text-white"></i>
              </div>
              <a href="/admin/roomManagement" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>ANDY &#174;	2020-2024 <a>&#187; Where there's a will, there's a way &laquo;</a>.</strong>
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/template/admin/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/template/admin/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="/template/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="/template/admin/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="/template/admin/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="/template/admin/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="/template/admin/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="/template/admin/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="/template/admin/plugins/moment/moment.min.js"></script>
<script src="/template/admin/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/template/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="/template/admin/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="/template/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/template/admin/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/template/admin/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/template/admin/dist/js/pages/dashboard.js"></script>
</body>
</html> --}}

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin</title>
  <link rel = "stylesheet" href = "/template/admin/dist/css/add.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
   <!-- Font Awesome -->
   <link rel="stylesheet" href="/template/admin/plugins/fontawesome-free/css/all.min.css">
   <!-- Ionicons -->
   <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> <link rel = "stylesheet" href = "/template/admin/dist/css/add.css"> <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script><script src="/template/admin/plugins/management/management.js"></script> --}}
  <link rel="stylesheet" href="/template/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <link rel="stylesheet" href="/template/admin/dist/css/adminlte.min.css">

</head>
<body>
<div class="container">
  <img src ="/bg-main.png" height ="300" width = "100% ">
  <div class = "navContainer">
    <nav class="navbar navbar-expand-sm navbar-dark bg-white">
      <div class="container-fluid">
          <div class="collapse navbar-collapse" id="mynavbar">
          <ul class="navbar-nav me-auto">
              <li class="nav-item">
                  <a class="nav-link active" href="/admin">HOME</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link active">WELCOME {{session('user-name')}}</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link active" href ="/logout">Log Out</a>
              </li>
          </ul>
        </div>
      </div>
  </nav>
  </div>

  <!-- Content Wrapper. Contains page content -->
  {{-- <div class="content-wrapper"> --}}
    <!-- Content Header (Page header) -->
    {{-- <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-1">
          <div class="col-sm-6">
            <h1 class="m-0"></h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div> --}}
    <!-- /.content-header -->
<br><br><br>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>USER</h3>
                <p>New Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add text-white"></i>
              </div>
              <a href="/admin/userManagement" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">  
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>CHECKING</h3>
                <p>Bounce Rate</p>
              </div>
              <div class="icon">
                <i class="ion ion-location text-white" ></i>
              </div>
              <a href="/admin/userManagement/adminCheck" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>ROOM</h3>
                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-home text-white"></i>
              </div>
              <a href="/admin/roomManagement" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  {{-- </div> --}}
  <div class="container-fluid">
    <div class="row mb-1">
      <div class="col-sm-6">
        <h1 class="m-9"></h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
    <div class="row mb-1">
      <div class="col-sm-6">
        <h1 class="m-9"></h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>ANDY &#174;	2020-2024 <a>&#187; Where there's a will, there's a way &laquo;</a>.</strong>
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>

</body>

{{-- <script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="/template/admin/dist/js/adminlte.js"></script> --}}
</html>
