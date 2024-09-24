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

        return view('sub-admin.sticker.vehicle_sticker_list', compact('parkings'));
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

        return response()->json([
            'status' => 'success'
        ]);
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

    return redirect()->route('sub-admin.sticker.vehicle_sticker_list')->with('success', 'Parking updated successfully');
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

    return view('sub-admin.sticker.vehicle_sticker_list', compact('parkings'));
}


    public function parking_admin()
    {
        $parkings = Parking::paginate(10);

        return view('admin.vehicle_sticker.vehicle_sticker', compact('parkings'));
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

    return response()->json([
        'status' => 'success'
    ]);
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

    return redirect()->route('admin.vehicle_sticker.vehicle_sticker')->with('success', 'Sticker updated successfully');
}

public function destroy_vehicle(string $id)
{
    $parking = Parking::findOrFail($id);

    $parking->delete();

    return response()->json(['success' => true, 'tr' => 'tr_' . $id]);
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






}
