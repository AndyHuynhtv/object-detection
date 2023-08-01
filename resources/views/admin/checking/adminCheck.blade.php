<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel = "stylesheet" href = "/template/admin/dist/css/add.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="/template/admin/plugins/management/management.js"></script>
    <link rel = "stylesheet" href = "/template/admin/dist/css/add.css"> <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script><script src="/template/admin/plugins/management/management.js"></script>
    <title>CHECKING</title>
</head>
<body>
     <div class = "container">
            <!-- Thanh navbar -->
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
                        <form class="d-flex">
                          <button onclick = "window.location.href ='/admin'" class="btn btn-sm text-center text-white hello" type="button">
                            <span><i class="fa fa-arrow-left fa-3x"></i></span>
                          </button>
                        </form>
                      </div>
                    </div>
                </nav>
            </div>
        <h1>CHECKING ADMIN</h1>
        <table class="checking-table">
            <tr class="room-id-row">
                <th colspan="2">RoomID</th>
            </tr>
            <tr class="room-id-row">
                <th>Date-time</th>
                <th>Number of people</th>
            </tr>
        </table>
        <table class="checking-table">
            <tr class="room-id-row">
                <th colspan="2">RoomID</th>
            </tr>
            <tr class="room-id-row">
                <th>Date-time</th>
                <th>Number of people</th>
            </tr>
        </table>
        
        <form action="/admin/userManagement/checking/printPDF" method="post">
            @csrf
            <div class = "btn-print">
                <button class="btn-print-admin" type="submit">PRINT</button>
            </div>
        </form>

        
     </div>
</body>
</html>