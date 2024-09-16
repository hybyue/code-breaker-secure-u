<?php

namespace App\Livewire;

use App\Models\Employee;
use App\Models\Event;
use App\Models\PassSlip;
use Carbon\Carbon;
use Livewire\Component;

class DashboardCounters extends Component
{

    public $totalRegular;
    public $totalTrainee;
    public $todaysEvents;
    public $totalTeaching;
    public $totalNon;

    public function mount()
    {
        $this->updateCounts();
    }

    public function updateCounts()
    {
        $this->totalRegular = Employee::where('employment_type', 'Full-Time')->count();
        $this->totalTrainee = Employee::where('employment_type', 'Part-Time')->count();
        $this->todaysEvents = Event::whereDate('date_start', Carbon::today())->count();
        $this->totalTeaching = PassSlip::where('employee_type', 'Teaching')->count();
        $this->totalNon = PassSlip::where('employee_type', 'Non-Teaching')->count();
    }
    public function render()
    {
        return view('livewire.dashboard-counters');
    }
}
