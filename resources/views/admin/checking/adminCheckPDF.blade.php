<!DOCTYPE html>
<html>
<head>
    <!-- Các thẻ head của trang -->
</head>
<body>
    <h1>Checking Time List</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Number</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->date }}</td>
                <td>{{ $item->number }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
