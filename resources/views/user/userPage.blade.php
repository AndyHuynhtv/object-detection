<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel = "stylesheet" href = "/template/admin/dist/css/add.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script><script src="/template/admin/plugins/management/management.js"></script>
    <title>USER MANAGEMENT</title>
</head>
<body>
    <div class = "container">
     <!-- Thanh navbar -->
        <img src ="/bg-main.png" height ="300" width = "100% ">
        <div class = "navContainer">
            <nav class="navbar navbar-expand-sm bg-white navbar-dark">
                <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <a class="nav-link active" href="/user">HOME</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active">Welcome {{session('user-name')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href ="/logout">Log Out</a>
                    </li>
                </ul>
                </div>
            </nav>
        </div>
            <h1>CHECKING USER</h1>

            <!-- Bảng "CHECKING" -->
        <div class = 'tableContainer'>
            <table class="table tablle-hover">
                <!-- Dòng đầu tiên - RoomID -->
                <thead>
                    <tr class="room-id-row">
                        <th colspan="2">RoomID</th>
                    </tr>
                    <tr class="room-id-row">
                        <th>Date-time</th>
                        <th>Number of people</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                    <tr>
                        {{-- <td>{{ $item->id }}</td> --}}
                        <td>{{ $item->date }}</td>
                        <td>{{ $item->number }}</td>
                    </tr>
                    @endforeach
                </tbody>
               
                <!-- Thêm các hàng khác nếu cần -->
                <!-- Dòng thứ 2 - Date-time và Number of people -->
                <tr>
                    <td colspan ="2">
                        <form action="/user/printPDF" method="get">
                            @csrf
                            <div class = "btn-print">
                                <button class="btn-print-admin" type="submit">PRINT</button>
                            </div>
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
