<?php

namespace App\Observers;

use App\Services\FirebaseService;
use Spatie\Activitylog\Models\Activity;

class ActivityLogsObserver
{
    protected $firebaseService;

    public function __construct(FirebaseService $firebaseService)
    {
        $this->firebaseService = $firebaseService;
    }

    /**
     * Handle the User "created" event.
     */
    public function created(Activity $activity): void
    {
        $this->firebaseService->syncActivityLogs($activity);user: 
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(Activity $activity): void
    {
        $this->firebaseService->syncActivityLogs($activity);
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(Activity $activity): void
    {
        $this->firebaseService->deleteActivityLogs($activity);
    }
}

