<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body{
            text-align: center;
            font-family: 'Times New Roman', Times, serif;
            margin-left: 1.5cm;
            margin-right: 1.5cm;
        }
        p{
          text-align: left;
        }
        table{
            border-collapse: collapse;
        }
        th, td{
            border: 1px solid black;
            padding:4px;
        }
        #center{
            text-align:center;
        }
    </style>
</head>
<body>
  <div class="container">
    <h2>Checking Time List</h2>
    @foreach($data as $item)
    <p><b>Room:</b> {{ $item->roomName }}</p>
    <p><b>Time:</b> {{ now('Asia/Taipei') }}</p>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th style="width:70px">No.</th>
          <th style="width:200px">Date</th>
          <th style="width:150px">People count</th>
          <th style="width:150px">Note</th>
        </tr>
      </thead>
      <tbody>
      
        @foreach($item->checkingTime as $check)
          <tr>
            <td id="center">{{ $loop->iteration }}</td>
            <td id="center">{{ $check->date }}</td>
            <td id="center">{{ $check->number }}</td>
            <td></td>
          </tr>
        @endforeach
      @endforeach
      </tbody>
    </table>
  </div>
</body>
</html>

