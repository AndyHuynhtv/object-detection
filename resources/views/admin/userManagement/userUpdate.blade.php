<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel = "stylesheet" href = "/template/admin/dist/css/add.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel = "stylesheet" href = "/template/admin/dist/css/add.css"> <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script><script src="/template/admin/plugins/management/management.js"></script>
    <title>UPDATE USER INFO</title>
</head>
<body>
    <div class = "container">    
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
        <h1>UPDATE USER</h1>
        <div class = "fmUpdUsContainer">
            <form action="/admin/userManagement/userUpdate/{{ $user->id }}" method="post">
                @csrf
                <div class="mb-3 mt-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" value="{{ $user->password }}" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control"  id="email" name="email" value="{{ $user->email }}" required>
                </div> 
                <div class="mb-3">
                    <label for="roomID" class="form-label">Room ID:</label>
                    <input type="text" class="form-control"  id="roomID" name="roomID" value="{{ $user->roomID }}" required>
                </div> 
                <div class="mb-3">
                    <label for="role" class="form-label">Role:</label>
                    <input type="text" class="form-control"  id="role" name="role" value="{{ $user->role }}" required>
                </div> 
                <div class = "mb-3 d-grid justify-content-center">
                     {{-- <input type="submit" value="Update"> --}}
                     <button class ="btn-update-form" type = "submit">UPDATE</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
