<?php

namespace App\Observers;

use App\Models\User;
use App\Services\FirebaseService;
class UserObserver
{
    protected $firebaseService;

    public function __construct(FirebaseService $firebaseService)
    {
        $this->firebaseService = $firebaseService;
    }

    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        $this->firebaseService->syncUser($user);
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        $this->firebaseService->syncUser($user);
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        $this->firebaseService->deleteUser($user);
    }

}
