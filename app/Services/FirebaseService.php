<?php

namespace App\Services;

use App\Models\User;
use Kreait\Firebase\Database;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Log;

class FirebaseService
{
    protected $database;
    protected $usersRef;
    protected $activityRef;

    protected $staffRef;
    public function __construct(Database $database)
    {
        $this->database = $database;
        $this->usersRef = $this->database->getReference('ADMIN_CRED');
        $this->staffRef = $this->database->getReference('Staffs');
        $this->activityRef = $this->database->getReference('ActivityLogs');
    }

    public function syncUser(User $user)
    {
        $rawAttributes = $user->getAttributes();
        // Log::info('User Type Debug', [
        //     'raw_type' => $rawAttributes['type'],
        //     'model_type' => $user->type,
        //     'user_id' => $user->id,
        //     'casts' => $user->getCasts()
        // ]);
        if($rawAttributes['type'] == 1){
            $this->usersRef->getChild($user->name)->update($rawAttributes);
        }else{
            $this->staffRef->getChild($user->name)->update($rawAttributes);
        }
        $this->staffRef->getChild($user->name)->update($rawAttributes);
    }

    public function deleteUser(User $user)
    {
        if($user->type == 1){
            $this->usersRef->getChild($user->name)->remove();
        }else{
            $this->staffRef->getChild($user->name)->remove();
        }
    }

    public function syncActivityLogs(Activity $activity)
    {
        // $rawAttributes = $activity->getAttributes();
        $this->activityRef->getChild($activity->id)->update($activity->toArray());
    }

    public function deleteActivityLogs(Activity $activity)
    {
        $this->activityRef->getChild($activity->id)->remove();
    }
}