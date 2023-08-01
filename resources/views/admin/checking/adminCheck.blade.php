<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel = "stylesheet" href = "/template/admin/dist/css/add.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="/template/admin/plugins/management/management.js"></script>
    <link rel = "stylesheet" href = "/template/admin/dist/css/add.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/template/admin/plugins/management/management.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style>
        .my-custom-scrollbar {
            position: relative;
            height: 150px;
            overflow: auto;
        }
        .table-wrapper-scroll-y {
            display: block;
        }
        th, .panel-heading{
            text-align: center;
        }
        b, td{
            color: black;
            font-size:16px;
        }
        .navContainer a:hover{
            text-decoration:none;
            color: white;
        }
    </style>
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
                        <ul class="navbar-nav mr-auto">
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
                        <div style="float:right">
                          <button onclick = "window.location.href ='/admin'" class="btn btn-sm text-center text-white pt-4" type="button">
                            <span><i class="fa fa-arrow-left fa-3x"></i></span>
                          </button>
                        </div>
                      </div>
                    </div>
                </nav>
            </div>
        <h1>CHECKING ADMIN</h1>

        @foreach ($check as $room) 
        <div class="panel-group" id="{{$room->roomName}}" name="searchRoom">
            <div class="panel panel-default">
            <div class="panel-heading">
                <a data-toggle="collapse" href="#{{$room->id}}">
                    <b>{{$room->roomName}}</b>
                </a>
            </div>
            <div id="{{$room->id}}" class="panel-collapse collapse text-center table-wrapper-scroll-y my-custom-scrollbar">
                <table class="table table-bordered text-center mb-0">
                <thead>
                    <tr>
                        <th class="col-6">Date-Time</th>
                        <th class="col-6">Number of People</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($room->checkingTime as $checking)
                    <tr>
                        <td>{{$checking->date}}</td>
                        <td>{{$checking->number}}</td>            
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
            </div>
        </div>
        @endforeach
        
        <form action="/admin/userManagement/checking/printPDF" method="get">
            @csrf
            <div class = "btn-print">
                <button class="btn-print-admin" type="submit">PRINT</button>
            </div>
        </form>

        
    </div>
</body>
</html>