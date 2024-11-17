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


        <p class="date bold-text text-start"> {{ $date }}</p>

        <p class="text-start"> {{ $title }}</p>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Visitor's Name</th>
                <th>Person to Visit/Depart.</th>
                <th>Duration</th>
            </tr>
        </thead>
        <tbody>
            @foreach($visitors as $visit)
            <tr>
                <td>{{ \Carbon\Carbon::parse($visit->date)->format('F d, Y') }}</td>
                <td>{{ $visit->first_name }} {{ $visit->middle_name }}. {{ $visit->last_name }}</td>
                <td>{{$visit->person_to_visit}}</td>
                <td>{{ \Carbon\Carbon::parse($visit->time_in)->format('g:i A') }} - {{ \Carbon\Carbon::parse($visit->time_out)->format('g:i A') }}</td>
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
