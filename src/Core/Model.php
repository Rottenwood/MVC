<?php
namespace PetrAurora\Model;
use PetrAurora\MySqlService;
use PetrAurora\Parameters;

/**
 * Author: Rottenwood
 * Date Created: 22.09.14 19:02
 */
class Model {

    public $mySqlService;

    public function __construct() {
        $this->mySqlService = new MySqlService(); // TODO: Рефакторинг
        $this->mysqli = new \mysqli(Parameters::$hostname, Parameters::$username, Parameters::$password, Parameters::$database);
    }

}
