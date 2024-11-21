<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lost;
use App\Models\PassSlip;
use App\Models\Violation;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class PdfController extends Controller
{
    public function generate_passSlip(Request $request)
{
    $query = PassSlip::query();

    if ($request->filled('start_date') && $request->filled('end_date')) {
        $query->whereDate('date', '>=', $request->start_date)
              ->whereDate('date', '<=', $request->end_date);
    }

    if ($request->filled('employee_type')) {
        $query->where('employee_type', $request->employee_type);
    }

    $passSlips = $query->latest()->get();
    $user = Auth::user();

    $data = [
        'title' => 'Reports for Pass Slip',
        'date' => now()->format('F d, Y'),
        'passSlips' => $passSlips,
        'user' => $user,
        'employee_type' => $request->employee_type ?? 'All',
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
    ];


    $pdf = Pdf::loadView('pdf.generate-pass', $data);

    return $pdf->stream();
}


    public function generate_visitor(Request $request)
    {
        $query = Visitor::query();

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereDate('created_at', '>=', $request->start_date)
                  ->whereDate('created_at', '<=', $request->end_date);
        }

        $visitors = $query->latest()->get();
        $user = Auth::user();
        $data = [
            'title' => 'Reports for Visitors',
            'date' => now()->format('F d, Y'),
            'visitors' => $visitors,
            'user' => $user,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ];

        $pdf = Pdf::loadView('pdf.generate-visitor', $data);

        return $pdf->stream();

    }

    public function generate_lost(Request $request)
    {
        $query = Lost::query();

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereDate('created_at', '>=', $request->start_date)
                  ->whereDate('created_at', '<=', $request->end_date);
        }

        $lost_found = $query->latest()->get();
        $user = Auth::user();
        $data = [
            'title' => 'Reports for Lost Found',
            'date' => now()->format('F d, Y'),
            'lost_found' => $lost_found,
            'user' => $user
        ];

        $pdf = Pdf::loadView('pdf.generate-lost', $data);

        return $pdf->stream('report-losts.pdf');

    }

    public function generate_violation(Request $request)
    {
        $query = Violation::query();

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereDate('created_at', '>=', $request->start_date)
                  ->whereDate('created_at', '<=', $request->end_date);
        }

        $violations = $query->latest()->get();
        $user = Auth::user();
        $data = [
            'title' => 'Reports for Violation',
            'date' => now()->format('F d, Y'),
            'violations' => $violations,
            'user' => $user
        ];

        $pdf = Pdf::loadView('pdf.generate-violation', $data);

        return $pdf->stream();

    }


    public function generateLoopingEmployee(Request $request)
    {
        $query = PassSlip::query();

        // Apply date filter
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereDate('date', '>=', $request->start_date)
                  ->whereDate('date', '<=', $request->end_date);
        }

        if ($request->filled('employee_type')) {
            $query->where('employee_type', $request->employee_type);
        }

        if ($request->filled('violation_filter')) {
            if ($request->violation_filter == '1') {
                $query->whereRaw('TIMESTAMPDIFF(HOUR, time_out, IFNULL(time_in, NOW())) >= 3');
            } elseif ($request->violation_filter == '0') {
                $query->whereRaw('TIMESTAMPDIFF(HOUR, time_out, IFNULL(time_in, NOW())) < 3');
            }
        }

        $passSlips = $query->latest()->get();
        $user = Auth::user();

        // Prepare data for PDF
        $data = [
            'passSlips' => $passSlips,
            'title' => 'Filtered Pass Slip Report',
            'date' => now()->format('F d, Y'),
            'user' => $user,
            'employee_type' => $request->employee_type ?? 'All',
            'violation_filter' => $request->violation_filter ?? 'All',
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ];

        // Select the correct view based on employee type and violation filter
        if ($request->employee_type === 'Teaching') {
            $view = ($request->violation_filter == 1) ? 'pdf.pdf-teaching' : 'pdf.pdf-teaching';
        } else {
            $view = ($request->violation_filter == 1) ? 'pdf.pdf-non-teaching' : 'pdf.pdf-non-teaching';
        }

        // Generate PDF
        $pdf = Pdf::loadView($view, $data);

        return $pdf->stream();
    }


//     public function previewPassSlip(Request $request)
// {
//     $query = PassSlip::query();

//     // Apply filters
//     if ($request->filled('start_date')) {
//         $query->whereDate('created_at', '>=', $request->start_date);
//     }

//     if ($request->filled('end_date')) {
//         $query->whereDate('created_at', '<=', $request->end_date);
//     }

//     if ($request->filled('employee_type')) {
//         $query->where('employee_type', $request->employee_type);
//     }

//     $passSlips = $query->get();
//     $user = Auth::user();

//     $data = [
//         'title' => 'Reports for Pass Slip',
//         'date' => now()->format('F d, Y'),
//         'passSlips' => $passSlips,
//         'user' => $user,
//         'employeeType' => $request->employee_type ?? 'All',
//         'startDate' => $request->start_date,
//         'endDate' => $request->end_date,
//     ];

//     $pdf = Pdf::loadView('pdf.generate-pass', $data);

//     return $pdf->stream();
// }

}

