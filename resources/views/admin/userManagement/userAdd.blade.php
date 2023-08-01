<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel = "stylesheet" href = "/template/admin/dist/css/add.css">
    <script src="/template/admin/plugins/management/management.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script><script src="/template/admin/plugins/management/management.js"></script>
    <title>ADD USER</title>
</head>
<body>
    <div class ="container">
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
                      <button onclick = "window.location.href ='/admin/userManagement'" class="btn btn-sm text-center text-white hello" type="button">
                        <span><i class="fa fa-arrow-left fa-3x"></i></span>
                      </button>
                    </form>
                  </div>
                </div>
            </nav>
        </div>
        <!-- Tiêu đề h1 -->
        <h1>ADD USER</h1>
            @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif 

        <!-- Form Add User -->
        <div class="add-user-form">
            <form action="/admin/userManagement/userAdd" method="POST" >
                @if (Session::has('error'))
                    <div class="alert alert-danger">
                        {{ Session::get('error') }}
                    </div>
                @endif 
                @csrf
                <div class="form-group">
                    <label>User:</label>
                    <input type="text" name="name" required>
                </div>
                <div class="form-group">
                    <label>Password:</label>
                    <input type="password" name="password" required>
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" name="email" required>
                </div>
                <div class="form-group">
                    <label>Room ID:</label>
                    <input type="text" name="roomID" required>
                </div>
                <div class="form-group">
                    <button class = "btn-add" type="submit">ADD USER</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
