<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Employee ID </th>
                <th>First Name</th>
                <th>Middle Initial</th>
                <th>Last Name</th>
                <th>Designation</th>
                <th>Department</th>
                <th>Status</th>
                <th>Position</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($all_employee as $item)
                <tr>
                    <td>{{$item->employee_id}}</td>
                    <td> {{$item->first_name}}</td>
                    <td> {{$item->middle_name}}</td>
                    <td> {{$item->last_name}}</td>
                    <td>{{$item->designation}}</td>
                    <td>{{$item->department}}</td>
                    <td>{{$item->status}}</td>
                    <td>{{$item->position}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
