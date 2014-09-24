<?php
namespace PetrAurora\Model;

use PetrAurora\Parameters;

/**
 * Родительская модель
 */
class Model {

    public $mySqlService;

    public function __construct() {
        $this->mysqli = new \mysqli(Parameters::$hostname, Parameters::$username, Parameters::$password, Parameters::$database);
    }

}
