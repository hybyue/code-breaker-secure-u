<?php

namespace App\Imports;

use App\Models\AllEmployee;
use App\Models\Student;
use Illuminate\Support\Collection;

use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportExcel implements ToModel
{

    /**
    * @param Collection $collection
    */
    private $num = 0;
    private $type;

    public function __construct($type)
    {
        $this->type = $type;
    }

    public function model(array $row)
    {
        $this->num++;
        if ($this->num > 1) {
            if ($this->type === 'student') {
                $count = Student::where('student_no', '=', $row[0])->count();
                if (empty($count)) {
                    $student = new Student();
                    $student->student_no = $row[0];
                    $student->first_name = $row[1];
                    $student->middle_name = $row[2];
                    $student->last_name = $row[3];
                    $student->course = $row[4];
                    $student->save();
                }
            } elseif ($this->type === 'employee') {
                $count = AllEmployee::where('employee_id', '=', $row[0])->count();
                if (empty($count)) {
                    $employee = new AllEmployee();
                    $employee->employee_id = $row[0];
                    $employee->first_name = $row[1];
                    $employee->middle_name = $row[2];
                    $employee->last_name = $row[3];
                    $employee->designation = $row[4];
                    $employee->department = $row[5];
                    $employee->status = $row[6];
                    $employee->position = $row[7];
                    $employee->save();
                }
            }
        }
    }
}
