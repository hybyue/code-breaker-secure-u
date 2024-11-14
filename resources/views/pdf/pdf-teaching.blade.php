<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teaching Personnel Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            font-size: 12px;
        }
        .header {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
        }
        .header .university-name {
            font-weight: bold;
            font-size: 16px;
        }
        .header .office-name {
            font-size: 10px;
            font-weight: bold;
        }
        .date, .recipient {
            font-size: 12px;
        }
        .date {
            margin-top: 3.5rem;
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
            color: #ca0808;
            text-align: center;
            font-size: 12px;
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

        .bold-text {
            font-weight: bold;
        }
        .guard-text {
            margin-top: 3rem;
        }
        .text-danger {
            color: #d11e1e;
        }
        .signature p {
            margin: 0;
            font-size: 11px;
        }

    </style>
</head>
<body>
    <div class="header">
        <div class="university-name"></div>
        <div class="office-name"></div>
    </div>

    <div class="date bold-text">{{ $date }}</div>
    <div class="recipient">
        <p><span class="bold-text">DR. JOSEPHINE S. LAMBINICIO</span> <br>OIC, VP for Administrative Affairs</p>
        <p>Madam:</p>
        <p>We would like to submit our report through your good office the names of @if(!empty($employee_type))<strong>{{ $employee_type }} Personnel </strong>@endif  who went <strong>OUT</strong>  and <strong>IN</strong>  of this University without Pass Slip @if(!empty($start_date) && !empty($end_date)) as of
            <strong>{{ \Carbon\Carbon::parse($start_date)->format('F d, Y') }} to {{ \Carbon\Carbon::parse($end_date)->format('F d, Y') }}</strong>
            @endif</p>    </div>

    <table>
        <thead>
            <tr>
                <th>NAME</th>
                <th>DEPARTMENT</th>
                <th>DATE</th>
                <th>OUT</th>
                <th>IN</th>
                <th>REMARKS</th>
            </tr>
        </thead>
        <tbody>
            @foreach($passSlips as $passSlip)
            <tr>
                <td>{{ $passSlip->first_name }} @if($passSlip->middle_name){{ $passSlip->middle_name }}.@endif {{ $passSlip->last_name }}</td>
                <td>{{ $passSlip->department }}</td>
                <td>{{ \Carbon\Carbon::parse($passSlip->date)->format('F d, Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($passSlip->time_out)->format('H:i') }}</td>
                <td class="text-danger">{{ \Carbon\Carbon::parse($passSlip->time_in)->format('H:i') }}</td>
                <td></td>
            </tr>
            @endforeach

        </tbody>
    </table>

    <div class="guard-text text-start">
        <p>Guard on duty:
        </p>

    </div>

    <div class="signature-section">
        <div class="signature">
            <p>Prepared by:</p>
            <br>
            <p>@if(!empty($user))
                <strong>{{ strtoupper($user->first_name) }} @if($user->middle_name){{ strtoupper($user->middle_name) }}.@endif {{ strtoupper($user->last_name) }}</strong>
                @endif</p>

            <p class="text-margin">Secretary, Security Management</p>
            <span class="line"></span>
        </div>
        <div class="signature">
            <p>Noted:</p>
            <br>

            <p class="bold-text">MANNY R. CALICA</p>
            <p class="text-margin">Head, Security Management</p>
            <span class="line"></span>
        </div>

    </div>
</body>
</html>