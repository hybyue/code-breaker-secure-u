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

        .header-content {
            display: flex;
            align-items: center; /* Align items vertically in the center */
        }

        .header-table td {
        border: none;
        padding: 0;

    }

        .logo {
            width: 60px;
            height: 60px;
            margin-right: 10px; /* Adds spacing between the logo and text */
        }

        .text-container {
            display: inline-block;
        }

        .university-name {
            font-weight: bold;
            font-size: 26px;
            color: #ca0808;
            margin: 0;
        }

        .tagline {
            font-size: 10px;
            color: #ca0808;
            margin: 0;
        }

        .security-container {
            text-align: center;
        }

        .security-name {
            font-size: 12px;
            font-weight: bold;
            margin: 0;
            margin-top: 5px;
        }

        .header-table {
            width: 100%;
            margin-bottom: 20px;
        }

        .blue-line {
            width: 100%;
            height: 2px;
            background-color: blue;
            margin: 0;

        }
    </style>
</head>
<body>
    <table class="header-table">
        <tr>
            <td>
                <div class="header-content">
                    <!-- Left Logo with Urdaneta City University -->
                    <img src="{{ public_path('images/ucu-logo.png') }}" alt="UCU Logo" class="logo">
                    <div class="text-container">
                        <div class="university-name">Urdaneta City University</div>
                        <div class="tagline">Owned and operated by the City Government of Urdaneta</div>
                    </div>
                </div>
            </td>
            <td>
                <div class="security-container">
                    <!-- Security Logo -->
                    <img src="{{ public_path('images/smo.jpg') }}" alt="Security Logo" class="logo">
                    <div class="security-name">Security Management Office</div>
                </div>
            </td>
        </tr>
    </table>
    <div class="blue-line"></div>


        <p class="date bold-text text-start"> {{ $date }}</p>

        <p class="text-start"> {{ $title }}</p>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Visitor's Name</th>
                <th>Office/Depart.</th>
                <th>Duration</th>
                <th>Remarks</th>
            </tr>
        </thead>
        @php
        $abbreviations = [
                "Institute of Graduate and Advanced Studies" => "IGAS",
                "College of Law" => "COL",
                "College of Pharmacy" => "COP",
                "College of Human Sciences" => "CHS",
                "College of Teacher Education" => "CTE",
                "College of Business Management and Accountancy" => "CBMA",
                "College of Health Sciences" => "CHS",
                "College of Hospitality and Tourism Management" => "CHTM",
                "College of Engineering and Architecture" => "CEA",
                "College of Criminal Justice Education" => "CCJE",
                "College of Arts and Sciences" => "CAS",
                "College of Information and Technology Education" => "CITE",
                "Center for Student Leadership and Development" => "CSLD",
                "Center for Research and Development" => "CRD",
                "Office of the External Affairs and Linkages" => "OEAL",
                "Psychological Assessment and Counseling Center" => "PACC",
                "Institutional Planning and Development" => "IPD",
                "Disaster Risk Reduction and Management Office" => "DRRMO",
                "Center for Community Development and Extension Services" => "CCD",
                "School of Midwifery (CHS)" => "SOM",
                "Center for Training and Professional Development" => "CTPD",
                "Research Ethics Committee" => "REC",
                "University Registrar" => "Registrar",
                "Accounting Office" => "Accounting",
                "Human Capital Management Office" => "HCMO",
                "University Library" => "Library",
                "Technical Vocational Institute" => "TVI",
                "Security Management Office" => "SMO",
                "Events Management Office" => "EMO",
                "Records Management System" => "RMS",
                "NSTP Department" => "NSTP",
                "Management Information Systems" => "MIS",
                "Maintenance and General Services" => "MGS",
                "University Cashier" => "Cashier",
                "Gender and Development" => "GAD",
                "Audit Office" => "Audit",
                "Engineering Management & Auxiliary Services" => "EMAS",
                "Committee for Publication and Communication Affairs" => "CPCA",
                "University Chaplain" => "Chaplain",
                "University Clinic" => "Clinic",
                "University Nurse" => "Nurse",
            ];
            @endphp
        <tbody>
            @foreach($visitors as $visit)

            <tr>
                <td>{{ $visit->date }}</td>
                <td>{{ $visit->first_name }} @if($visit->middle_name){{ $visit->middle_name }}.@endif{{ $visit->last_name }}</td>
                <td> {{ $abbreviations[$visit->person_to_visit] ?? $visit->person_to_visit }}</td>
                <td>{{ \Carbon\Carbon::parse($visit->time_in)->format('H:i ') }} - {{ \Carbon\Carbon::parse($visit->time_out)->format('H:i ') }}</td>
                <td>{{$visit->remarks}} </td>
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

            <p>{{ ucfirst($user->position) }}, Security Management</p>
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
