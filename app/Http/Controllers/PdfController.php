<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lost;
use App\Models\PassSlip;
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
        $query->whereDate('created_at', '>=', $request->start_date)
              ->whereDate('created_at', '<=', $request->end_date);
    }

    if ($request->filled('employee_type')) {
        $query->where('employee_type', $request->employee_type);
    }

    $passSlips = $query->get();
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

    return $pdf->stream('report-pass-slip.pdf');
}


    public function generate_visitor(Request $request)
    {
        $query = Visitor::query();

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereDate('created_at', '>=', $request->start_date)
                  ->whereDate('created_at', '<=', $request->end_date);
        }

        $visitors = $query->get();
        $user = Auth::user();
        $data = [
            'title' => 'Reports for Visitors',
            'date' => now()->format('F d, Y'),
            'visitors' => $visitors,
            'user' => $user
        ];

        $pdf = Pdf::loadView('pdf.generate-visitor', $data);

        return $pdf->stream('report-visitors.pdf');

    }

    public function generate_lost(Request $request)
    {
        $query = Lost::query();

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereDate('created_at', '>=', $request->start_date)
                  ->whereDate('created_at', '<=', $request->end_date);
        }

        $lost_found = $query->get();
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
}