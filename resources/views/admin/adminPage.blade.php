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
</html>
