<?php

namespace App\Http\Controllers;

use App\Exports\LostExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportExcel;
use App\Models\AllEmployee;
use Illuminate\Support\Facades\Redirect;

class ImportExcelController extends Controller
{

    public function import_excel(Request $request)
    {

        Excel::import(new ImportExcel('student'), $request->file('excel_file_students'));

        return redirect()->back()->with('success', 'Student List Imported Successfully');
    }

    public function import_excel_employee(Request $request)
    {

        Excel::import(new ImportExcel('employee'), $request->file('excel_file_employees'));

        return redirect()->back()->with('success', 'Employee List Imported Successfully');
    }

    public function exportAllEmployees()
    {
        // Set a flash message in the session
        session()->flash('success', 'Employee List Exported Successfully!');

        // Return the Excel file download
        return Excel::download(new LostExport, 'all_employees.xlsx');
    }

}
