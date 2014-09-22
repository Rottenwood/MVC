<?php
namespace PetrAurora\Controller;

use PetrAurora\View;

class Controller {

    public $model;
    public $view;

    function __construct() {
        $this->view = new View\View();
    }

    function indexAction() {
    }
}