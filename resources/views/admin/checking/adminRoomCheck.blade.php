<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/template/admin/dist/css/add.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/template/admin/plugins/management/management.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>  
  
    <style>
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
        .my-custom-scrollbar {
            position: relative;
            height: 250px;
            overflow: auto;
        }

    </style>
    <title>CHECKING</title>
</head>
<body>
    <div class = "container pb-5">
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
                <button onclick = "window.location.href ='/admin/userManagement/adminCheck'" class="btn btn-sm text-center text-white pt-4" type="button">
                  <span><i class="fa fa-arrow-left fa-3x"></i></span>
                </button>
              </div>
            </div>
          </div>
        </nav>
      </div> <!-- navContainer -->
      @foreach ($checking as $room)
        <h1 style="padding:5px">{{ $room->roomName }}</h1>
        <input type="hidden" id="roomID" value="{{ $room->roomID }}">

        @if(session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
        @endif
        
        <div class="row">
          <div class="col-md-12">      
            <form action="" method="">
                @csrf
                <div class = "btn-print" style="padding-bottom:15px">
                    <button class="btn-print-admin" type="submit" onclick="startYOLO()">CHECK</button>
                </div>
            </form>
          </div>
        </div>

        <table class="checking-table">
        <!-- Dòng đầu tiên - RoomID -->
          <thead>
            <tr class="room-id-row">
              <th>Date-time</th>
              <th>Number of people</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($room->checkingTime as $checking)
              <tr>
                <td>{{ $checking->date }}</td>
                <td>{{ $checking->number }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
            
      @endforeach
    </div><!-- Container -->

<script>
  function startYOLO() {
    const url = 'http://127.0.0.1:5000/start_yolo';
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch(url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token,
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        },
        body: JSON.stringify({ start_detection: 1 })
    })
    .then(response => {
        return response.json();
    })
    .then(data => {
      if (data) {
        callApi();
      }
    })
    .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
    });
  }

// ------- Nhận dữ liệu từ api
function callApi() {
  fetch('http://127.0.0.1:5000/data_web', {  
    method: 'GET'
  })
  .then(response => response.json())
  .then(data_get => {
    if (data_get) {
      saveData(data_get.number, data_get.image_path);
    }
    else {
      alert('No data available.');
    }
  })
  .catch(error => {
    alert('Failed to receive data from the API.');
      console.error(error);
  });            
}

// ------- Gửi dữ liệu sang controller để lưu vào db   
function saveData(number, image_path){
    let room_id = document.getElementById("roomID").value;
    let url = 'http://127.0.0.1:8000/admin/userManagement/checking/checkingAdd';
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    fetch(url, {
          headers: {
              "Content-Type": "application/json",
              "Accept": "application/json, text-plain, */*",
              "X-Requested-With": "XMLHttpRequest",
              "X-CSRF-TOKEN": token
              },
          method: 'post',
          credentials: "same-origin",
          body: JSON.stringify({
              number: number,
              image_path: image_path,
              room_id: room_id
          })
    })
}
</script>

</body>
</html>