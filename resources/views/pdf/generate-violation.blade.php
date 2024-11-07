<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid black;
            padding: 5px;
            font-size: 12px;
        }
        th {
            text-align: center;
            font-size: 12px;
        }

        p {
            margin: 0;
            padding: 0;
        }
        .date {
            margin-top: 5rem;
        }
        .guard-text {
            margin-top: 3rem;
            font-size: 11px;
        }
        .bold-text {
            font-weight: bold;
        }
        .signature-section {
            margin-top: 20px;
            width: 100%;
            position: relative;
        }
        .signature {
            text-align: left;
            display: inline-block;
            width: 30%;
        }
        .signature:first-child {
            float: left;
        }
        .signature:last-child {
            float: right;
        }
        .signature .line {
            margin-top: -14.8px;
            display: inline-block;
            border-bottom: 2px solid black;
            width: 145px;
        }
        .signature p {
            margin: 0;
            font-size: 11px;
        }
    </style>
</head>
<body>

    <div>
        <p class="bold-text text-start"> {{ $title }}</p>
        <p class="date text-start"> {{ $date }}</p>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Course</th>
                <th>Violation</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($violations as $violate)
            <tr>
                <td>{{$violate->last_name}}, {{$violate->first_name}} @if($violate->middle_initial){{$violate->middle_initial}}.@endif
                </td>
                <td>{{$violate->course}}</td>
                <td>{{$violate->violation_type}}</td>
                <td>{{$violate->date}}</td>
                <td>{{$violate->violation_count}} violation(s)</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="guard-text text-start">
        <p>Guard on duty:</p>
    </div>

    <div class="signature-section">
        <div class="signature">
            <p>Prepared by:</p>
            <br>
            <p>@if(!empty($user))
                <strong>{{ strtoupper($user->first_name) }} @if($user->middle_name){{ strtoupper($user->middle_name) }}.@endif {{ strtoupper($user->last_name) }}</strong>
                @endif</p>
            <p>Secretary, Security Management</p>
            <span class="line"></span>
        </div>
        <div class="signature">
            <p>Noted:</p>
            <br>
            <p class="bold-text">MANNY R. CALICA</p>
            <p>Head, Security Management</p>
            <span class="line"></span>
        </div>
    </div>
</body>
</html>
