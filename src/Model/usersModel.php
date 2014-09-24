<?php
namespace PetrAurora\Model;

use PetrAurora\MySqlService;

class usersModel extends Model {

    public function getAllUsers() {
        $mySqlService = new MySqlService();
        $result = $mySqlService->getUsers();

        return $result;
    }
}
