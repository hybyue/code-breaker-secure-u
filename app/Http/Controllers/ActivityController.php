<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::with('causer')->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.activity', compact('activities'));
    }
}
