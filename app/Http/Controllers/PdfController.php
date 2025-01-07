<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Looping;
use App\Models\Lost;
use App\Models\PassSlip;
use App\Models\Violation;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class PdfController extends Controller
{
    private function filterByUserType($query)
    {
        $user = Auth::user();

        // If user is not admin (type = 1), filter by user_id
        if ($user->type == 'user') {
            $query->where('user_id', $user->id);
        }

        return $query;
    }
    public function generate_passSlip(Request $request)
    {
        $user = Auth::user();


        // Initialize query for PassSlip
        $query = PassSlip::query();
        $this->filterByUserType($query);



        // Apply date range filter if provided
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereDate('date', '>=', $request->start_date)
                  ->whereDate('date', '<=', $request->end_date);
        }

        // Apply employee type filter if provided
        if ($request->filled('employee_type')) {
            $query->where('employee_type', $request->employee_type);
        }


        // Get the filtered pass slips
        $passSlips = $query->latest()->get();

        // Prepare the data for the PDF
        $data = [
            'title' => 'Reports for Pass Slip',
            'date' => now()->format('F d, Y'),
            'passSlips' => $passSlips,
            'user' => $user,
            'employee_type' => $request->employee_type ?? 'All',
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ];

        // Generate the PDF using the data
        $pdf = Pdf::loadView('pdf.generate-pass', $data);

        // Return the PDF stream
        return $pdf->stream();
    }

    public function generate_visitor(Request $request)
    {
        $user = Auth::user();

        $query = Visitor::query();
        $this->filterByUserType($query);
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereDate('created_at', '>=', $request->start_date)
                  ->whereDate('created_at', '<=', $request->end_date);
        }


        $visitors = $query->latest()->get();
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
        $this->filterByUserType($query);

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
        $this->filterByUserType($query);

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereDate('created_at', '>=', $request->start_date)
                  ->whereDate('created_at', '<=', $request->end_date);
        }

        // Group data by name and course
             // Group data by name and course
    $violations = $query->orderBy('last_name')
            ->orderBy('first_name')
            ->orderBy('course')
            ->latest()
            ->get()
            ->groupBy(function ($item) {
                return $item->last_name . ', ' . $item->first_name . ' ' . ($item->middle_initial ?? '');
            })
            ->map(function ($groupedByName) {
                return $groupedByName->groupBy('course');
            });


        $user = Auth::user();
        $data = [
            'title' => 'Reports for Students Violation',
            'date' => now()->format('F d, Y'),
            'violations' => $violations,
            'user' => $user
        ];

        $pdf = Pdf::loadView('pdf.generate-violation', $data);

        return $pdf->stream();
    }


    public function generateLoopingEmployee(Request $request)
    {
        $query = Looping::query();
        $this->filterByUserType($query);

        // Apply date filter
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereDate('date', '>=', $request->start_date)
                  ->whereDate('date', '<=', $request->end_date);
        }

        if ($request->filled('employee_type')) {
            $query->where('employee_type', $request->employee_type);
        }


        $looping = $query->latest()->get();
        $user = Auth::user();

        // Prepare data for PDF
        $data = [
            'looping' => $looping,
            'title' => 'Filtered Looping Report',
            'date' => now()->format('F d, Y'),
            'user' => $user,
            'employee_type' => $request->employee_type ?? 'All',
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ];

        // Select the correct view based on employee type and violation filter
        if ($request->employee_type === 'Teaching') {
            $view = 'pdf.pdf-teaching';
        } else {
            $view = 'pdf.pdf-non-teaching';
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

