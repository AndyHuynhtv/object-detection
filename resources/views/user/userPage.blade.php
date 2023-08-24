<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/template/admin/dist/css/add.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/template/admin/plugins/management/management.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <title>USER MANAGEMENT</title>
</head>
<body>
    <div class = "container pb-5">
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
<!-- title-->       
        <h1 style="padding:15px">CHECKING USER</h1>

        @if(session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
        @endif
<!-- Chart-->
        <div class="row">
          <div class="col-3 pb-2">
            <div class="col-6">
              <select class="form-control form-control-sm" id="filterDay" name="filterDay" onchange="filterChart()">
                <option value="today">Today</option>
                <option value="7days">Last 7 Days</option>
              </select>
            </div>
          </div>
          <!--<div class="col-2"><input type="date" class="form-control form-control-sm" id="dateStart"></div>
          <div class="col-2"></div>-->
          <div id="chartContainer">
            <canvas id="myChart" style="max-height:330px; width:100%; border: 1px solid black; border-radius: 5px;"></canvas>
          </div>
        </div>
      @foreach ($data as $room)
        <div class="row">
          <div class="col-md-6">
            <form action="/user/printPDF" method="get">
              @csrf
              <input type="hidden" name="roomID" value="{{ $room->roomID }}">
              <div class = "btn-print">
                <button class="btn-print-admin" type="submit">PRINT</button>
              </div>
            </form>
          </div>
          <div class="col-md-6">      
            <form action="" method="">
            @csrf
              <div class = "btn-print" style="padding-bottom:15px">
                <button class="btn-print-admin" type="submit" onclick="callApi()">CHECK</button>
              </div>
            </form>
          </div>
        </div>
<!-- Checking list-->

        <table class="checking-table">
        <!-- Dòng đầu tiên - RoomID -->
          <thead>
            <tr class="room-id-row">
              <th colspan="2">{{$room->roomName}}</th>
            </tr>
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
    </div>

<script>
// --------- Gọi api để bắt đầu lấy dữ liệu
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
    .then(response => response.json())
    .then(data => {
        alert(data);
    })
    .catch(error => {
        console.error(error);
        alert('Không thể điều khiển nhận dạng YOLO');
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
    let url = 'http://127.0.0.1:8000/user/checking/checkingAdd';
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
              image_path: image_path
          })
    })
}

    var selectedDay = 'today';
    var labels = [];
    var datasets = [];
    var today = new Date();

// Khởi tạo
document.addEventListener("DOMContentLoaded", function() {
    lineChart();
})
// Khi lọc
function filterChart(){
    document.getElementById("chartContainer").innerHTML = '';
    document.getElementById("chartContainer").innerHTML = 
            '<canvas id="myChart" style="max-height:330px; width:100%; border: 1px solid black; border-radius: 5px;"></canvas>';
    var ctx = document.getElementById("myChart").getContext("2d");

    selectedDay = document.getElementById('filterDay').value;
    labels = [];
    datasets = [];
    lineChart();
}


function lineChart(){
    var data = <?php echo json_encode($dataCheck); ?>;
    for (var roomID in data) {
      var room = data[roomID];
      var data = [];

      for (var i = 0; i < room.dataPoints.length; i++) {
        var timestamp = formatDate(today);
        let tsToday = Date.parse(timestamp); // timestamp ngày hiện tại
        let ts3days = Date.parse(timestamp) - (259200000); // timestamp 3 ngày (3*24*60*60*1000)
        //alert(ts3days);

        if(selectedDay == 'today' && room.dataPoints[i].day == formatDate(today)){
          data.push({
            x: date,
            y: room.dataPoints[i].y
          });
          var date = new Date(room.dataPoints[i].label);
          formattedLabel = date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }) 
                          + ' ' + (date.getMonth() + 1) 
                          + '-' + date.getDate();
          labels.push(formattedLabel);
        }
        else if(selectedDay == '7days' && (ts3days < Date.parse(room.dataPoints[i].day)) && (Date.parse(room.dataPoints[i].day) < tsToday)){
          data.push({
            x: date,
            y: room.dataPoints[i].y
          });
          var date = new Date(room.dataPoints[i].label);
          formattedLabel = date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }) 
                          + ' ' + (date.getMonth() + 1) 
                          + '-' + date.getDate();
          labels.push(formattedLabel);
        }
      }

      datasets.push({
        label: room.name,
        data: data,
        borderColor: '#00aba9',
        borderWidth: 2,
        fill: false
      });
    }

    var lineChart = new Chart('myChart', {
      type: 'line',
      data: {
        labels: labels,
        datasets: datasets
      },
      options: {
        scales: {
          x: {
            type: 'time',
            time: {
              unit: 'day',
              displayFormats: {
                day: 'MMM D'
              }
            }
          },
          y: {
            beginAtZero: true
          }
        }
      }
    });
}

function formatDate(date) {
    var year = date.getFullYear();
    var month = String(date.getMonth() + 1).padStart(2, '0');
    var day = String(date.getDate()).padStart(2, '0');

    return year + '-' + month + '-' + day;
}
</script>

<!-- ChartJS -->

<script src="/template/admin/plugins/chart.js/Chart.min.js"></script>
</body>
</html>
