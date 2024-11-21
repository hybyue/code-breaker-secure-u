<?php

namespace App\Observers;

use App\Models\Student;
use App\Services\FirebaseService;
class StudentObserver
{
    protected $firebaseService;

    public function __construct(FirebaseService $firebaseService)
    {
        $this->firebaseService = $firebaseService;
    }

    /**
     * Handle the User "created" event.
     */
    public function created(Student $student): void
    {
        $this->firebaseService->syncStudent($student);
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(Student $student): void
    {
        $this->firebaseService->syncStudent($student);
    }
}