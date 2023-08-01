<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel = "stylesheet" href = "/template/admin/dist/css/add.css">
    <!-- Thêm thẻ meta để chứa CSRF token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <title>USER MANAGEMENT</title>
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
                  <button onclick = "window.location.href ='/admin'" class="btn btn-sm text-center text-white hello" type="button">
                    <span><i class="fa fa-arrow-left fa-3x"></i></span>
                  </button>
                </form>
              </div>
            </div>
        </nav>
    </div>
    <h1>USER MANAGEMENT</h1>
    @if (Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif 
    <div class = "tableContainer">
        <table class ="table table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Password</th>
                    <th>Email</th>
                    <th>RoomID</th>
                    <th>Role</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class = "colName">{{ $user->name }}</td>
                        <td>{{ $user->password }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->roomID }}</td>
                        <td>{{$user->role}}</td>
                        <td><button onclick="window.location.href='/admin/userManagement/userUpdate/{{$user->id}}'" class = "btn-update"><span class="icon icon-update"><i class="fas fa-pen"></i></span></button> </td>
                        <td>
                            <form method="POST" action="/admin/userManagement/userDelete/{{ $user->id }}">
                                @csrf
                                @method('DELETE')    
                                <button type="submit" class="btn-delete">
                                    <span class="icon icon-delete"><i class="fas fa-trash"></i></span>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach 
            </tbody>
            
                <td colspan="7" style="text-align: center;">
                    <button onclick = "window.location.href ='/admin/userManagement/userAdd'" class="btn-add-user">ADD USER</button>
                </td>
        </table>
    </div>
</div>
</body>
<script>
    const deleteButtons = document.querySelectorAll('.btn-delete');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const roomId = this.getAttribute('data-id');
            const confirmDelete = confirm('Bạn có muốn xóa phòng này?');
            if (confirmDelete) {
                // Chuyển hướng đến action xóa trong controller
                window.location.href = `/admin/deleteRoom/${roomId}`;
            }
        });
    });
</script>
</html>
