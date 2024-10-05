<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::with('causer')->latest()->get();

        return view('admin.activity', compact('activities'));
    }
}
