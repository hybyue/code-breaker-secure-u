<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
        if ($request->filled('start_date') || $request->filled('end_date')) {
            session(['activity_filter' => [
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]]);
        }

        $query = Activity::with('causer');

        $filterData = session('activity_filter', [
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        if (!empty($filterData['start_date'])) {
            $query->whereDate('created_at', '>=', $filterData['start_date']);
        }

        if (!empty($filterData['end_date'])) {
            $query->whereDate('created_at', '<=', $filterData['end_date']);
        }

        $activities = $query->latest()->get();

        return view('admin.activity', compact('activities'));
    }

    public function clearFilter()
    {
        session()->forget('activity_filter');
        return redirect()->route('admin.activity');
    }
}
