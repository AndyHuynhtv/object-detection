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
        </div> <!-- navContainer -->

        <h1 style="padding:10px 0px 20px 0px">CHECKING ADMIN</h1>

        <div class="row">
          <div class="row pb-3" style="padding-left:15px">
            <div class="col-3">
              <select class="form-control form-control-sm" id="filterRoom" name="filterRoom" onchange="filter_Room()">
                @foreach($check as $room)
                  <option value="{{ $room->id }}">{{ $room->roomName }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-2">
              <select class="form-control form-control-sm" id="filterDay" name="filterDay" onchange="filter_Day()">
                <option value="today">Today</option>
                <option value="3days">Last 3 Days</option>
                <option value="week">Last Week</option>
              </select>
            </div>
            <div class="col-1">
                <button onclick="filterChart()" style='font-size:19px' class="btn btn-primary py-1 px-4" ><i class='fas fa-filter'></i></button>
            </div>
          </div>
          
          <div id="chartContainer">
            <canvas id="myChart" style="max-height:330px; border: 1px solid black; border-radius: 5px;"></canvas>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <form action="/admin/userManagement/admin/userManagement/checking/printPDF" method="get">
                @csrf
                <div class = "btn-print" style="padding-bottom:15px">
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

        <br>
        
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
            </div> <!-- panel panel-default -->
          </div><!-- panel-group --> 
        @endforeach
        
    </div>

<script> 
    function callApi() {
        fetch('http://127.0.0.1:5000/get_number', {  
            method: 'GET'
        })
            .then(response => response.json())
            .then(data_get => {
                if (data_get) {
                    saveData(data_get.number);
                    alert(data_get.number);
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
        
    function saveData(data_get){
      alert("chăm");
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
              body: JSON.stringify({ number: data_get })
        })
    }

    var selectedDay = document.getElementById('filterDay').value;
    var selectedRoom = document.getElementById('filterRoom').value;
    var labelsX = [];
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
    selectedRoom = document.getElementById('filterRoom').value;
    labelsX = [];
    datasets = [];
    lineChart();
}


function lineChart(){
    var datacheck = <?php echo json_encode($data); ?>;
    for (var roomID in datacheck) {
      var room = datacheck[roomID];
      var data = [];

      for (var i = 0; i < room.dataPoints.length; i++) {
        var timestamp = formatDate(today);
        let tsToday = Date.parse(timestamp); // timestamp ngày hiện tại
        let ts3days = Date.parse(timestamp) - (259200000); // timestamp 3 ngày (3*24*60*60*1000)
        let tsweek = Date.parse(timestamp) - (604800000);

        if(selectedDay == 'today' && (room.dataPoints[i].day == formatDate(today)) && (room.id == selectedRoom)){
          data.push({
            x: date,
            y: room.dataPoints[i].y
          });
          var date = new Date(room.dataPoints[i].label);
          formattedLabel = date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }) 
                          + ' ' + (date.getMonth() + 1) 
                          + '-' + date.getDate();
          labelsX.push(formattedLabel);
        }
        else if((selectedDay == '3days') && (room.id == selectedRoom) &&
                  (ts3days < Date.parse(room.dataPoints[i].day)) && (Date.parse(room.dataPoints[i].day) < tsToday)){
          data.push({
            x: date,
            y: room.dataPoints[i].y
          });
          var date = new Date(room.dataPoints[i].label);
          formattedLabel = date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }) 
                          + ' ' + (date.getMonth() + 1) 
                          + '-' + date.getDate();
          labelsX.push(formattedLabel);
        }
        else if((selectedDay == 'week') && (room.id == selectedRoom) &&
                  (tsweek < Date.parse(room.dataPoints[i].day)) && (Date.parse(room.dataPoints[i].day) < tsToday)){
          data.push({
            x: date,
            y: room.dataPoints[i].y
          });
          var date = new Date(room.dataPoints[i].label);
          formattedLabel = date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }) 
                          + ' ' + (date.getMonth() + 1) 
                          + '-' + date.getDate();
          labelsX.push(formattedLabel);
        }
      }
      if (room.id == selectedRoom){
        datasets.push({
        label: room.name,
        data: data,
        borderColor: '#00aba9',
        borderWidth: 2,
        fill: false
      });}
    }

    var lineChart = new Chart('myChart', {
      type: 'line',
      data: {
        labels: labelsX,
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