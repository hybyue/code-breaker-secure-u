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
        <p class="date bold-text text-start"> {{ $date }}</p>

        <p class="text-start"> {{ $title }}</p>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Types of Object</th>
                <th>Finder's Name</th>
                <th>Location Found</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($lost_found as $item)
                <tr class="text-center">
                    <td>{{ $item->object_type }}</td>
                    <td>{{ $item->first_name }} @if($item->middle_name){{ $item->middle_name }}.@endif {{ $item->last_name }}</td>
                    <td>
                       {{ $item->location }}
                    </td>
                    <td>
                        @if($item->is_claimed == 1)
                            <span class="text-success">Claimed</span>
                        @elseif($item->is_transferred == 1)
                            <span class="text-danger">Transferred</span>
                        @else
                            <span class="text-warning">Pending</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">No Data available in table</td>
                </tr>
                @endforelse
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
