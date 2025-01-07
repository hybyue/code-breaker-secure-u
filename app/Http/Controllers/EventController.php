<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AllEmployee;
use App\Models\Employee;
use App\Models\Event;
use App\Models\Lost;
use App\Models\PassSlip;
use App\Models\Student;
use App\Models\Violation;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date_start' => 'required|date',
            'date_end' => 'nullable|date',
        ]);

        $event = new Event();
        $event->title = $request->title;
        $event->description = $request->description;
        $event->date_start = $request->date_start;
        $event->date_end = $request->date_end;
        $event->user_id = Auth::id();
        $event->save();

        return redirect()->back()->with('success', 'Event added successfully.');
    }

    public function index()
    {
        $events = Event::orderBy('created_at', 'desc')->get();
        return view('sub-admin.event.events', compact('events'));
    }

    public function showEvent()
    {
        // Total counts
        // $totalVisitors = Visitor::count();
        $totalPassSlips = PassSlip::count();
        $totalViolation = Violation::count();

        $todayVisitors = Visitor::withoutGlobalScopes()->whereDate('created_at', now()->toDateString())->count();
        $totalVisitors = Visitor::count();

        // Today's counts
        // $todayVisitors = Visitor::whereDate('created_at', Carbon::today())->count();
        $todayPassSlips = PassSlip::whereDate('created_at', Carbon::today())->count();

        $totalLost = Lost::count();

        $sevenDayOldItems = Lost::whereDate('created_at', '<=', now()->subDays(7)->toDateString())
        ->where('is_claimed', '!=', 1)
        ->where('is_transferred', '!=', 1)
        ->count();

         // Count late pass slips
        $latePassSlips = PassSlip::whereNull('time_in')
        ->whereRaw('TIMESTAMPDIFF(MINUTE, time_out, NOW()) > validity_hours * 60')
        ->count();


        $events = Event::all();
        $todayEvents = Event::whereDate('date_start', Carbon::today())->get();
        $upcomingEvents = Event::whereDate('date_start', '>', Carbon::today())->get();

        return view('sub-admin.dashboard', compact('totalVisitors', 'totalPassSlips', 'todayVisitors', 'todayPassSlips', 'events', 'todayEvents', 'upcomingEvents', 'totalViolation', 'sevenDayOldItems', 'totalLost', 'latePassSlips'));
    }

    public function updateEvents(Request $request, string $id)
{
    $events = Event::findOrFail($id);

    $events->update($request->all());

    return redirect()->route('sub-admin.event.events')->with('success', 'Lost and Found updated successfully');
}


    public function store_adminEvent(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date_start' => 'required|date',
            'date_end' => 'nullable|date',
        ]);

        $event = new Event();
        $event->title = $request->title;
        $event->description = $request->description;
        $event->date_start = $request->date_start;
        $event->date_end = $request->date_end;
        $event->user_id = Auth::id();
        $event->save();

        return response()->json([
            'status' => 'success'
        ]);
          }

    public function eventAdmin()
    {
        $events = Event::latest()->get();
        return view('admin.events.event_admin', compact('events'));
    }

    public function showEvents(Request $request)
    {
        $totalEmployee = Employee::count();
        $totalEvents = Event::count();
        $totalEmployees = AllEmployee::count();
        $totalStudent = Student::count();
        $totalVisitor = Visitor::count();
        $totalViolation = Violation::count();
        $totalLostFound = Lost::count();
        $totalPassSlip = PassSlip::count();


        // Today's counts
        $totalRegular = Employee::where('employment_type', 'Full-Time')->count();
        $totalTrainee = Employee::where('employment_type', 'Part-Time')->count();

        $totalTeaching = PassSlip::where('employee_type', 'Teaching')->count();
        $totalNon = PassSlip::where('employee_type', 'Non-Teaching')->count();

        $todaysEvents = Event::whereDate('date_start', Carbon::today())->count();

        $events = Event::all();
        $todayEvents = Event::whereDate('date_start', Carbon::today())->get();
        $upcomingEvents = Event::whereDate('date_start', '>', Carbon::today())->get();


        $sevenDayOldItems = Lost::whereDate('created_at', '<=', now()->subDays(7)->toDateString())
        ->where('is_claimed', '!=', 1)
        ->where('is_transferred', '!=', 1)
        ->count();

          // Count late pass slips
          $latePassSlips = PassSlip::whereNull('time_in')
          ->whereRaw('TIMESTAMPDIFF(MINUTE, time_out, NOW()) > validity_hours * 60')
          ->count();



        return view('admin.dashboard', compact('todayEvents', 'upcomingEvents', 'events', 'totalEmployee', 'totalEvents', 'totalRegular', 'todaysEvents', 'totalTrainee', 'totalTeaching', 'totalNon', 'totalEmployees', 'totalStudent', 'totalVisitor', 'totalViolation', 'totalLostFound', 'totalPassSlip','sevenDayOldItems', 'latePassSlips'));
    }
    public function updateEventsAdmin(Request $request, $id)
    {

     $event = Event::find($id);

         // Validate the incoming data
    $request->validate([
        'up_title' => 'required|string|max:255',
        'up_description' => 'required|string',
        'up_date_start' => 'required|date',
        'up_date_end' => 'nullable|date|after_or_equal:up_date_start',
    ]);
    // Update the event
    $event->title = $request->input('up_title');
    $event->description = $request->input('up_description');
    $event->date_start = $request->input('up_date_start');
    $event->date_end = $request->input('up_date_end');

    // Save the changes to the database
    $event->save();
        return response()->json([
            'status' => 'success'
        ]);

          }


    public function destroy_events(string $id)
    {
        $events = Event::findOrFail($id);

        $events->delete();

        return response()->json(['success' => true, 'tr' => 'tr_' . $id]);
    }


}
