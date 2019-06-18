<?php
namespace App\Service;

use App\InterfaceService\UserInterface;
use App\User; // model
/**
 *
 */
class UserService implements UserInterface
{

    public function getUserByID($id)
    {
        $user = User::find($id);
        return $user;
    }


}

