<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Parking;
use App\Models\Violation;
use Illuminate\Http\Request;
use App\Models\Visitor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    public function parking_sub()
    {
        $parkings = Parking::orderBy('created_at', 'desc')->paginate(10);

        return view('sub-admin.vehicle_sticker_list', compact('parkings'));
    }


    public function store_parks(Request $request)
    {
        $request->validate([
            'sticker_id' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'course' => 'required|string|max:255',
            'date_registered' => 'required|date',
            'expiration_date' => 'required|date',
            'license_no' => 'required|string|max:18',
            'dl_codes' => 'required|string|max:255',
            'license_exp_date' => 'required|date',
            'license_photo' => 'nullable|file',
            'plate_no' => 'required|string|max:255',
            'cr_no' => 'required|string|max:255',
            'cr_date_register' => 'required|date',
            'vehicle_type' => 'required|string|max:255',
            'vehicle_image' => 'nullable|file',
        ]);

        $data = [
            'user_id' => Auth::id(),
            'sticker_id' => $request->sticker_id,
            'license_no' => $request->license_no,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'date_registered' => $request->date_registered,
            'expiration_date' => $request->expiration_date,
            'license_exp_date' => $request->license_exp_date,
            'dl_codes' => $request->dl_codes,
            'plate_no' => $request->plate_no,
            'cr_no' => $request->cr_no,
            'cr_date_register' => $request->cr_date_register,
            'vehicle_type' => $request->vehicle_type,
            'course' => $request->course,
        ];

        if ($request->hasFile('vehicle_image')) {
            $fileName = time() . '_' . $request->file('vehicle_image')->getClientOriginalName();
            $path = $request->file('vehicle_image')->storeAs('vehicle_images', $fileName, 'public');
            $data['vehicle_image'] = '/storage/' . $path;
        }

        if ($request->hasFile('license_photo')) {
            $fileName = time() . '_' . $request->file('license_photo')->getClientOriginalName();
            $path = $request->file('license_photo')->storeAs('license_photos', $fileName, 'public');
            $data['license_photo'] = '/storage/' . $path;
        }

        Parking::create($data);

        return redirect()->route('sub-admin.vehicle_sticker_list')->with('success', 'Vehicle details added successfully.');
    }



    public function updateVehicle(Request $request, string $id)
{
    $parking = Parking::findOrFail($id);

    if ($request->hasFile('vehicle_image')) {
        if ($parking->vehicle_image && file_exists(public_path($parking->vehicle_image))) {
            unlink(public_path($parking->vehicle_image));
        }
        $fileName = time() . '_' . $request->file('vehicle_image')->getClientOriginalName();
        $path = $request->file('vehicle_image')->storeAs('vehicle_images', $fileName, 'public');
        $parking->vehicle_image = '/storage/' . $path;
    }

    if ($request->hasFile('license_photo')) {
        if ($parking->license_photo && file_exists(public_path($parking->license_photo))) {
            unlink(public_path($parking->license_photo));
        }
        $fileName = time() . '_' . $request->file('license_photo')->getClientOriginalName();
        $path = $request->file('license_photo')->storeAs('license_photos', $fileName, 'public');
        $parking->license_photo = '/storage/' . $path;
    }


        $parking->sticker_id = $request->input('sticker_id');
        $parking->license_no = $request->input('license_no');
        $parking->first_name = $request->input('first_name');
        $parking->middle_name = $request->input('middle_name');
        $parking->last_name = $request->input('last_name');
        $parking->date_registered = $request->input('date_registered');
        $parking->expiration_date = $request->input('expiration_date');
        $parking->license_exp_date = $request->input('license_exp_date');
        $parking->dl_codes = $request->input('dl_codes');
        $parking->plate_no = $request->input('plate_no');
        $parking->cr_no = $request->input('cr_no');
        $parking->cr_date_register = $request->input('cr_date_register');
        $parking->vehicle_type = $request->input('vehicle_type');
        $parking->course = $request->input('course');


    $parking->save();

    return redirect()->route('sub-admin.vehicle_sticker_list')->with('success', 'Parking updated successfully');
}


public function filterParking(Request $request)
{
      $start_date = $request->start_date;
      $end_date = $request->end_date;

      if ($start_date && $end_date) {
        $parkings = Parking::whereDate('created_at', '>=', $start_date)
                            ->whereDate('created_at', '<=', $end_date)
                            ->paginate(10);
    } else {
        $parkings = Parking::orderBy('created_at')->paginate(10);
    }

    return view('sub-admin.vehicle_sticker_list', compact('parkings'));
}


    public function parking_admin()
    {
        $parkings = Parking::paginate(10);

        return view('admin.vehicle_sticker', compact('parkings'));
    }

    public function store_park(Request $request)
{
    $request->validate([
        'sticker_id' => 'required|string|max:255',
        'first_name' => 'required|string|max:255',
        'middle_name' => 'nullable|string|max:255',
        'last_name' => 'required|string|max:255',
        'course' => 'required|string|max:255',
        'date_registered' => 'required|date',
        'expiration_date' => 'required|date',
        'license_no' => 'required|string|max:18',
        'dl_codes' => 'required|string|max:255',
        'license_exp_date' => 'required|date',
        'license_photo' => 'nullable|file',
        'plate_no' => 'required|string|max:255',
        'cr_no' => 'required|string|max:255',
        'cr_date_register' => 'required|date',
        'vehicle_type' => 'required|string|max:255',
        'vehicle_image' => 'nullable|file',
    ]);

    $data = [
        'user_id' => Auth::id(),
        'sticker_id' => $request->sticker_id,
        'license_no' => $request->license_no,
        'first_name' => $request->first_name,
        'middle_name' => $request->middle_name,
        'last_name' => $request->last_name,
        'date_registered' => $request->date_registered,
        'expiration_date' => $request->expiration_date,
        'license_exp_date' => $request->license_exp_date,
        'dl_codes' => $request->dl_codes,
        'plate_no' => $request->plate_no,
        'cr_no' => $request->cr_no,
        'cr_date_register' => $request->cr_date_register,
        'vehicle_type' => $request->vehicle_type,
        'course' => $request->course,
    ];

    if ($request->hasFile('vehicle_image')) {
        $fileName = time() . '_' . $request->file('vehicle_image')->getClientOriginalName();
        $path = $request->file('vehicle_image')->storeAs('vehicle_images', $fileName, 'public');
        $data['vehicle_image'] = '/storage/' . $path;
    }

    if ($request->hasFile('license_photo')) {
        $fileName = time() . '_' . $request->file('license_photo')->getClientOriginalName();
        $path = $request->file('license_photo')->storeAs('license_photos', $fileName, 'public');
        $data['license_photo'] = '/storage/' . $path;
    }

    Parking::create($data);

    return redirect()->route('admin.vehicle_sticker')->with('success', 'Vehicle details added successfully.');
}


public function updateVehicleAdmin(Request $request, string $id)
{
    $parking = Parking::findOrFail($id);

    if ($request->hasFile('vehicle_image')) {
        if ($parking->vehicle_image && file_exists(public_path($parking->vehicle_image))) {
            unlink(public_path($parking->vehicle_image));
        }
        $fileName = time() . '_' . $request->file('vehicle_image')->getClientOriginalName();
        $path = $request->file('vehicle_image')->storeAs('vehicle_images', $fileName, 'public');
        $parking->vehicle_image = '/storage/' . $path;
    }

    if ($request->hasFile('license_photo')) {
        if ($parking->license_photo && file_exists(public_path($parking->license_photo))) {
            unlink(public_path($parking->license_photo));
        }
        $fileName = time() . '_' . $request->file('license_photo')->getClientOriginalName();
        $path = $request->file('license_photo')->storeAs('license_photos', $fileName, 'public');
        $parking->license_photo = '/storage/' . $path;
    }


        $parking->sticker_id = $request->input('sticker_id');
        $parking->license_no = $request->input('license_no');
        $parking->first_name = $request->input('first_name');
        $parking->middle_name = $request->input('middle_name');
        $parking->last_name = $request->input('last_name');
        $parking->date_registered = $request->input('date_registered');
        $parking->expiration_date = $request->input('expiration_date');
        $parking->license_exp_date = $request->input('license_exp_date');
        $parking->dl_codes = $request->input('dl_codes');
        $parking->plate_no = $request->input('plate_no');
        $parking->cr_no = $request->input('cr_no');
        $parking->cr_date_register = $request->input('cr_date_register');
        $parking->vehicle_type = $request->input('vehicle_type');
        $parking->course = $request->input('course');


    $parking->save();

    return redirect()->route('admin.vehicle_sticker')->with('success', 'Sticker updated successfully');
}

public function destroy_vehicle(string $id)
{
    $parkings = Parking::findOrFail($id);

    $parkings->delete();

    return redirect()->route('admin.vehicle_sticker')->with('success', 'Sticker List deleted successfully');
}

public function filterVehicleAdmin(Request $request)
{
    $query = Parking::query();

    if ($request->filled('start_date') && $request->filled('end_date')) {
        $query->whereDate('created_at', '>=', $request->start_date)
              ->whereDate('created_at', '<=', $request->end_date);
    }

    $parkings = $query->orderBy('created_at', 'desc')->paginate(10);

    return view('admin.vehicle_sticker', compact('parkings'));
}




public function index(Request $request)
{
    return $this->filterVisitorAdmin($request);
}

public function filterVisitorAdmin(Request $request)
{
    $query = Visitor::select('visitors.*')
        ->join(DB::raw('(SELECT MAX(id) as id FROM visitors GROUP BY last_name, first_name, middle_name, date) as latest'), 'visitors.id', '=', 'latest.id');

    if ($request->filled('start_date') && $request->filled('end_date')) {
        $query->whereDate('visitors.created_at', '>=', $request->start_date)
              ->whereDate('visitors.created_at', '<=', $request->end_date);
    }

    $latestVisitors = $query->paginate(10);

    $allVisitors = Visitor::query();

    if ($request->filled('start_date') && $request->filled('end_date')) {
        $allVisitors->whereDate('created_at', '>=', $request->start_date)
                    ->whereDate('created_at', '<=', $request->end_date);
    }

    $allVisitors = $allVisitors->get();

    return view('admin.visitor_admin', compact('latestVisitors', 'allVisitors'));
}



public function store(Request $request)
{
    $request->validate([
        'first_name' => 'required|string|max:255',
        'middle_name' => 'nullable|string|max:255',
        'last_name' => 'required|string|max:255',
        'person_to_visit' => 'required|string|max:255',
        'purpose' => 'required|string|max:255',
        'id_type' => 'required|string|max:255',
    ]);

    $visitor = new Visitor();
    $visitor->fill([
        'first_name' => $request->get('first_name'),
        'middle_name' => $request->get('middle_name'),
        'last_name' => $request->get('last_name'),
        'person_to_visit' => $request->get('person_to_visit'),
        'purpose' => $request->get('purpose'),
        'id_type' => $request->get('id_type'),
        'date' => now()->format('Y-m-d H:i:s'),
        'time_in' => now()->format('H:i:s'),
        'user_id' => Auth::id(),
    ]);

    $visitor->save();

    return back()->with('success', 'Visitor added successfully.');
}


public function edit(string $id)
{
    $visitors = Visitor::findOrFail($id);

    return view('employee.edit', compact('visitors'));
}

/**
 * Update the specified resource in storage.
 */
public function update(Request $request)
{
    $request->validate([
        'entries.*.id' => 'required|exists:visitors,id',
        'entries.*.first_name' => 'required|string|max:255',
        'entries.*.middle_name' => 'nullable|string|max:255',
        'entries.*.last_name' => 'required|string|max:255',
        'entries.*.person_to_visit' => 'required|string|max:255',
        'entries.*.purpose' => 'required|string|max:255',
        'entries.*.id_type' => 'required|string|max:255',
    ]);

    foreach ($request->entries as $entry) {
        $visitor = Visitor::findOrFail($entry['id']);
        $visitor->update([
            'first_name' => $entry['first_name'],
            'middle_name' => $entry['middle_name'],
            'last_name' => $entry['last_name'],
            'person_to_visit' => $entry['person_to_visit'],
            'purpose' => $entry['purpose'],
            'id_type' => $entry['id_type'],
        ]);
    }

    return redirect()->back()->with('success', 'Visitor entries updated successfully.');
}


/**
 * Remove the specified resource from storage.
 */
public function destroy(string $id)
{
    $visitors = Visitor::findOrFail($id);

    $visitors->delete();

    return redirect()->route('admin.visitor_admin')->with('success', 'product deleted successfully');
}

public function checkoutAdmin($id)
{
    $visitor = Visitor::findOrFail($id);
    $visitor->time_out = now()->format('H:i:s');
    $visitor->save();

    return redirect()->route('admin.visitor_admin')->with('success', 'Time out recorded successfully.');
}

public function searchVisitors(Request $request)
{
    $query = $request->get('query');
    $visitors = Visitor::where('last_name', 'like', "%{$query}%")
                        ->orWhere('first_name', 'like', "%{$query}%")
                        ->orWhere('middle_name', 'like', "%{$query}%")
                        ->get();
    return response()->json($visitors);
}


//SUB-ADMIN VIITOR REQUEST
public function new_visitor(Request $request)
{
    return $this->filterVisitor($request);
}

public function filterVisitor(Request $request)
{
    $query = Visitor::query();

    if ($request->filled('start_date') && $request->filled('end_date')) {
        $query->whereDate('created_at', '>=', $request->start_date)
              ->whereDate('created_at', '<=', $request->end_date);
    }

    $latestVisitors = Visitor::select('visitors.*')
        ->join(DB::raw('(SELECT MAX(id) as id FROM visitors GROUP BY last_name, first_name, middle_name, date) as latest'), 'visitors.id', '=', 'latest.id')
        ->where(function ($subQuery) use ($request) {
            if ($request->filled('start_date') && $request->filled('end_date')) {
                $subQuery->whereDate('visitors.created_at', '>=', $request->start_date)
                         ->whereDate('visitors.created_at', '<=', $request->end_date);
            }
        })
        ->orderBy('visitors.created_at', 'desc')
        ->paginate(10);

    $allVisitors = $query->get();

    return view('sub-admin.visitor', compact('latestVisitors', 'allVisitors'));
}



public function store_visit(Request $request)
{
        $request->validate([
        'first_name' => 'required|string|max:255',
        'middle_name' => 'nullable|string|max:255',
        'last_name' => 'required|string|max:255',
        'person_to_visit' => 'required|string|max:255',
        'purpose' => 'required|string|max:255',
        'id_type' => 'required|string|max:255',
    ]);

    $visitor = new Visitor();
    $visitor->first_name = $request->first_name;
    $visitor->middle_name = $request->middle_name;
    $visitor->last_name = $request->last_name;
    $visitor->person_to_visit = $request->person_to_visit;
    $visitor->purpose = $request->purpose;
    $visitor->id_type = $request->id_type;
    $visitor->date = now()->format('Y-m-d H:i:s');
    $visitor->time_in = now()->format('H:i:s');
    $visitor->user_id = Auth::id();

    $visitor->save();

    return redirect()->route('sub-admin.visitor');
}

public function checkout($id)
{
    $visitor = Visitor::findOrFail($id);
    $visitor->time_out = now()->format('H:i:s');
    $visitor->save();

    return redirect()->route('sub-admin.visitor')->with('success', 'Time out recorded successfully.');
}

public function searchVisitor(Request $request)
{
    $query = $request->get('query');
    $visitors = Visitor::where('last_name', 'like', "%{$query}%")
                        ->orWhere('first_name', 'like', "%{$query}%")
                        ->orWhere('middle_name', 'like', "%{$query}%")
                        ->get();
    return response()->json($visitors);
}

//TODO: Fix error not showing modal
public function updateVisitorSub(Request $request, string $id)
{
    $visitors = Visitor::findOrFail($id);

    $visitors->update($request->all());

    return redirect()->route('sub-admin.visitor')->with('success', 'visitor updated successfully');
}

public function violationView(Request $request)
{
    // Initial query for violations
    $query = Violation::query();

    // Apply date filters if provided
    if ($request->filled('start_date') && $request->filled('end_date')) {
        $query->whereDate('created_at', '>=', $request->start_date)
              ->whereDate('created_at', '<=', $request->end_date);
    }

    // Select latest violation per student
    $violations = Violation::select('violations.*')
        ->join(DB::raw('(SELECT MAX(id) as id FROM violations GROUP BY student_no) as latest'), 'violations.id', '=', 'latest.id')
        ->where(function ($subQuery) use ($request) {
            if ($request->filled('start_date') && $request->filled('end_date')) {
                $subQuery->whereDate('violations.created_at', '>=', $request->start_date)
                         ->whereDate('violations.created_at', '<=', $request->end_date);
            }
        })
        ->orderBy('violations.created_at', 'desc')
        ->paginate(10);

    // Get all violations grouped by student_no
    $allViolations = $query->get()->groupBy('student_no');

    // Pass both variables to the view
    return view('admin.violation', compact('violations', 'allViolations'));
}



public function store_violation(Request $request)
{
    $request->validate([
        'student_no' => 'required|string|max:255',
        'first_name' => 'required|string|max:255',
        'middle_initial' => 'nullable|string|max:255',
        'last_name' => 'required|string|max:255',
        'course' => 'required|string|max:255',
        'violation_type' => 'required|string|max:255',
        'date' => 'required|date',
    ]);

    $data = [
        'user_id' => Auth::id(),
        'student_no' => $request->student_no,
        'first_name' => $request->first_name,
        'middle_initial' => $request->middle_initial,
        'last_name' => $request->last_name,
        'course' => $request->course,
        'violation_type' => $request->violation_type,
        'date' => $request->date,
    ];



    Violation::create($data);

    return redirect()->route('admin.violation')->with('success', 'Vehicle details added successfully.');
}

}

