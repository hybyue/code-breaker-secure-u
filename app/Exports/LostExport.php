<?php

namespace App\Exports;

use App\Models\AllEmployee;
use App\Models\Lost;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Facades\Excel;

class LostExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return AllEmployee::all();
    }

    public function view(): View
    {
        // Pass the data to the Blade view
        $all_employee = \App\Models\AllEmployee::all();

        return view('exports.all_employee_export', compact('all_employee'));
    }
}
