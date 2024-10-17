<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Violation;

class AdminComposer
{
    public function compose(View $view)
    {
        // Subquery to group by student_no and count occurrences
        $subquery = Violation::select('student_no')
            ->groupBy('student_no')
            ->havingRaw('COUNT(student_no) = 3');

        // Main query to select students based on the subquery
        $students = Violation::select('student_no')
            ->whereIn('student_no', $subquery)
            ->get();

        // Debugging statement to check if this method is hit and output the students
        // dd($students);

        $view->with('students', $students);
    }
}
