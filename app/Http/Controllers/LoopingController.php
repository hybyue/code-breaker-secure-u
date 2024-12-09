<?php

namespace App\Http\Controllers;

use App\Models\Looping;
use App\Models\AllEmployee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class LoopingController extends Controller
{
    public function index(Request $request)
    {
        // Store filters in session if provided in the request
        if ($request->filled('start_date') || $request->filled('end_date') ||
            $request->filled('employee_type')) {
            session(['looping_filter' => [
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'employee_type' => $request->employee_type,
            ]]);
        }

        // Get filter data from session or request
        $filterData = session('looping_filter', [
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'employee_type' => $request->employee_type,
        ]);


                    // Apply filters using session data
            $query = Looping::query();
            // Apply filters
            if (!empty($filterData['start_date'])) {
                    $query->whereDate('date', '>=', $filterData['start_date']);
                }

                if (!empty($filterData['end_date'])) {
                    $query->whereDate('date', '<=', $filterData['end_date']);
                }

                if (!empty($filterData['employee_type'])) {
                    $query->where('employee_type', $filterData['employee_type']);
                }



        // Remove the redundant where clause and just get the results
        $latestLoopings = Looping::select('looping.*')
            ->join(DB::raw('(SELECT MAX(id) as id FROM looping GROUP BY name, department, employee_type) as latest'),
                'looping.id', '=', 'latest.id')
            ->where(function ($subQuery) use ($filterData) {
                if (!empty($filterData['start_date'])) {
                    $subQuery->whereDate('looping.date', '>=', $filterData['start_date']);
                }
                if (!empty($filterData['end_date'])) {
                    $subQuery->whereDate('looping.date', '<=', $filterData['end_date']);
                }
                if (!empty($filterData['employee_type'])) {
                    $subQuery->where('looping.employee_type', $filterData['employee_type']);
                }
            })
            ->latest()
            ->get();

        // Get all loopings for the modal details
        $allLoopings = $query->get();

        return view('sub-admin.looping.loopings', compact('latestLoopings', 'allLoopings', 'filterData'));
    }

    public function index_admin(Request $request)
    {
        // Store filters in session if provided in the request
        if ($request->filled('start_date') || $request->filled('end_date') ||
            $request->filled('employee_type')) {
            session(['looping_filter' => [
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'employee_type' => $request->employee_type,
            ]]);
        }

        // Get filter data from session or request
        $filterData = session('looping_filter', [
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'employee_type' => $request->employee_type,
        ]);


                    // Apply filters using session data
            $query = Looping::query();
            // Apply filters
            if (!empty($filterData['start_date'])) {
                    $query->whereDate('date', '>=', $filterData['start_date']);
                }

                if (!empty($filterData['end_date'])) {
                    $query->whereDate('date', '<=', $filterData['end_date']);
                }

                if (!empty($filterData['employee_type'])) {
                    $query->where('employee_type', $filterData['employee_type']);
                }



        // Remove the redundant where clause and just get the results
        $latestLoopings = Looping::select('looping.*')
            ->join(DB::raw('(SELECT MAX(id) as id FROM looping GROUP BY name, department, employee_type) as latest'),
                'looping.id', '=', 'latest.id')
            ->where(function ($subQuery) use ($filterData) {
                if (!empty($filterData['start_date'])) {
                    $subQuery->whereDate('looping.date', '>=', $filterData['start_date']);
                }
                if (!empty($filterData['end_date'])) {
                    $subQuery->whereDate('looping.date', '<=', $filterData['end_date']);
                }
                if (!empty($filterData['employee_type'])) {
                    $subQuery->where('looping.employee_type', $filterData['employee_type']);
                }
            })
            ->latest()
            ->get();

        $allLoopings = $query->get();

        return view('admin.looping.loopings', compact('latestLoopings', 'allLoopings', 'filterData'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'employee_type' => 'required|string|max:255',
            'date' => 'required|date',

            'time_out' => 'required',
            'time_in' => 'nullable',
            'remarks' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            Looping::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'department' => $request->department,
                'employee_type' => $request->employee_type,
                'date' => $request->date,

                'time_out' => Carbon::parse($request->time_out)->format('H:i'),
                'time_in' => $request->time_in ? Carbon::parse($request->time_in)->format('H:i') : null,
                'remarks' => $request->remarks,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Looping record created successfully'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'employee_type' => 'required|string|max:255',
            'date' => 'required|date',
            'time_in' => 'required',
            'time_out' => 'required',
            'remarks' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $looping = Looping::findOrFail($id);

            $looping->update([
                'name' => $request->name,
                'department' => $request->department,
                'employee_type' => $request->employee_type,
                'date' => $request->date,
                'time_in' => Carbon::parse($request->time_in)->format('H:i:s'),
                'time_out' => Carbon::parse($request->time_out)->format('H:i:s'),
                'remarks' => $request->remarks,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Looping record updated successfully'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function clearLoopingFilter()
    {
        session()->forget('looping_filter');
        return redirect()->route('sub-admin.looping.loopings');
    }
    public function clearLoopingFilterAdmin()
    {
        session()->forget('looping_filter');
        return redirect()->route('admin.looping.loopings');
    }


    public function searchLooping(Request $request)
    {
        try {
            $query = AllEmployee::query();

            // Check if search term is ID or name
            if ($request->filled('search')) {
                $searchTerm = $request->search;
                $query->where(function($q) use ($searchTerm) {
                    $q->where('employee_id', 'like', '%' . $searchTerm . '%')
                      ->orWhere('first_name', 'like', '%' . $searchTerm . '%')
                      ->orWhere('middle_name', 'like', '%' . $searchTerm . '%')
                      ->orWhere('last_name', 'like', '%' . $searchTerm . '%');
                });
            }

            // Select specific fields including middle_name and department
            $employees = $query->select([
                'employee_id',
                'first_name',
                'middle_name',
                'last_name',
                'department',
                'designation',
                'status'
            ])->limit(7)->get();

            if ($employees->count() > 0) {
                return response()->json([
                    'success' => true,
                    'employees' => $employees
                ]);
            } else {
                return response()->json(['success' => false]);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
