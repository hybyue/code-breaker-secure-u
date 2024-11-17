<?php

namespace App\Services;

use App\Models\User;
use Kreait\Firebase\Database;

class FirebaseService
{
    protected $database;
    protected $usersRef;

    protected $staffRef;
    public function __construct(Database $database)
    {
        $this->database = $database;
        $this->usersRef = $this->database->getReference('ADMIN_CRED');
        $this->staffRef = $this->database->getReference('Staffs');
    }

    public function syncUser(User $user)
    {
        $rawAttributes = $user->getAttributes();

        if($rawAttributes['type'] == 1){
            $this->usersRef->getChild($user->id_number)->update($rawAttributes);
        }else{
            $this->staffRef->getChild($user->id_number)->update($rawAttributes);
        }
    }

    public function deleteUser(User $user)
    {
        if($user->type == 1){
            $this->usersRef->getChild($user->id_number)->remove();
        }else{
            $this->staffRef->getChild($user->id_number)->remove();
        }
    }
}