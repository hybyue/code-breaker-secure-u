<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;



class HomeController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
      return view('sub-admin.dashboard');
    }

    public function adminHome()
    {
        return view('admin.dashboard');
    }

}
